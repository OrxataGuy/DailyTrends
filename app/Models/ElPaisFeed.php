<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Goutte\Client;

class ElPaisFeed extends Feed
{
    use HasFactory;

    public function getFeed (Client $scrapper, Publisher $publisher)
    {
        $endpoints =  $scrapper->request('GET', $publisher->site)
        ->filter('article>header>h2>a')->each(function ($node) use ($publisher)  {
            $endpoint = $node->attr('href');
            if (str_contains($endpoint, $publisher->site)) return $endpoint;
            return "";
        });

        foreach($endpoints as $url)
        {
            $source = $url;

            if(!Feed::where('source', '=', $source)->exists())
            {
                $crawler = $scrapper->request('GET', $url);
                $title = self::getText($crawler->filter('h1'));
                $summary = self::getText($crawler->filter('h2'));
                $image = self::getSource($crawler->filter('figure>img'));
                if (!$image) $image = self::getSource($crawler->filter('img'), 1);
                $body = self::getHtml($crawler->filter('.clearfix'));

                if($body && $source)
                {
                    Feed::create([
                        'title' => $title,
                        'body' => "<h2>$summary</h2>$body",
                        'image' => $image,
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
