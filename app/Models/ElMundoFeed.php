<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Goutte\Client;

class ElMundoFeed extends Feed
{
    use HasFactory;

    public function getFeed (Client $scrapper, Publisher $publisher)
    {
        $endpoints =  $scrapper->request('GET', $publisher->site)
        ->filter('article>div>div>header>a')->each(function ($node) use ($publisher)  {
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
                $summary = self::getText($crawler->filter('.ue-c-article__standfirst'));
                $image = self::getSource($crawler->filter('picture>img'));
                if (!$image) $image = self::getSource($crawler->filter('img'), 1);
                $body = self::getHtml($crawler->filter('.ue-c-article__body'));

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
