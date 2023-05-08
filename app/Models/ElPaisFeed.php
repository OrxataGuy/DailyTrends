<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Goutte\Client;

class ElPaisFeed extends Feed
{
    use HasFactory;

    public static function feed (Client $scrapper)
    {
        $endpoints =  $scrapper->request('GET', "https://elpais.com")
        ->filter('article>header>h2>a')->each(function ($node) {
            $endpoint = $node->attr('href');
            if (str_contains($endpoint, "https://elpais.com")) return $endpoint;
            return "";
        });

        $publisher = "ELPAIS.COM";
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
                        'publisher' => $publisher
                    ]);
                }
            }
        }

        return Feed::where('publisher', '=', $publisher)->where('updated_at', '>', now()->subDay(1)->toDateTimeString())->get();
    }
}
