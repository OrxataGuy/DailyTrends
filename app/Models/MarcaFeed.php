<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Goutte\Client;

class MarcaFeed extends Feed
{
    use HasFactory;

    public static function feed (Client $scrapper)
    {
        $endpoints =  $scrapper->request('GET', "https://www.marca.com")
        ->filter('article>div>div>header>a')->each(function ($node) {
            $endpoint =  $node->attr('href');
            if (str_contains($endpoint, "https://www.marca.com"))
                return $endpoint;
            return "";
        });

        $publisher = "MARCA.COM";

        foreach($endpoints as $url)
        {
            $source = $url;
            if(!Feed::where('source', '=', $source)->first())
            {
                $crawler = $scrapper->request('GET', $url);
                $title = self::getText($crawler->filter('h1'));
                $summary = self::getText($crawler->filter('.ue-c-article__standfirst'));
                $image = self::getSource($crawler->filter('picture>img'));
                $body = self::getHtml($crawler->filter('.ue-c-article__body'));

                if($body && !Feed::where('source', '=', $source)->first())
                {
                    Feed::create([
                        'title' => $title,
                        'body' => "<h2>$summary</h2>$body",
                        'image' => $image,
                        'source' => $source,
                        'publisher' => $publisher
                    ]);
                }
            }
        }
        return Feed::where('publisher', '=', $publisher)->where('updated_at', '>', now()->subDay(1)->toDateTimeString())->get();
    }
}
