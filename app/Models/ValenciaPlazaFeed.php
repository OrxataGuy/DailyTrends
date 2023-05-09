<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Goutte\Client;

class ValenciaPlazaFeed extends Feed
{
    use HasFactory;

    public function getFeed (Client $scrapper, Publisher $publisher)
    {
        $endpoints =  $scrapper->request('GET', $publisher->site)
        ->filter('article>div>h2>a')->each(function ($node) use ($publisher) {
            $endpoint = $node->attr('href');
            if (!str_contains($endpoint, "https://")) return $publisher->site.$endpoint;
            return "";
        });

        foreach($endpoints as $url)
        {
            $source = $url;
            if(!Feed::where('source', '=', $source)->exists())
            {
                $crawler = $scrapper->request('GET', $url);
                $title = self::getText($crawler->filter('h1'));
                $image = self::getSource($crawler->filter('.image'));
                if (!$image) $image = self::getSource($crawler->filter('img'), 1);
                $body = self::getHtml($crawler->filter('.html-content'));

                if($body && $source)
                {
                    Feed::create([
                        'title' => $title,
                        'body' => $body,
                        'image' => $publisher->site.$image,
                        'source' => $source,
                        'publisher' => $publisher->name,
                        'publisher_id' => $publisher->id
                    ]);
                }
            }
        }

        return $publisher->lastNews($scrapper);
    }
}
