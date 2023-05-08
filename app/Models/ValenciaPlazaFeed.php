<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Goutte\Client;

class ValenciaPlazaFeed extends Feed
{
    use HasFactory;

    public static function feed (Client $scrapper)
    {
        $endpoints =  $scrapper->request('GET', "https://valenciaplaza.com")
        ->filter('article>div>h2>a')->each(function ($node) {
            $endpoint = $node->attr('href');
            if (!str_contains($endpoint, "https://")) return "https://valenciaplaza.com$endpoint";
            return "";
        });

        $publisher = "VALENCIAPLAZA";

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
                        'image' => "https://valenciaplaza.com$image",
                        'source' => $source,
                        'publisher' => $publisher
                    ]);
                }
            }
        }

        return Feed::where('publisher', '=', $publisher)->where('updated_at', '>', now()->subDay(1)->toDateTimeString())->get();
    }
}
