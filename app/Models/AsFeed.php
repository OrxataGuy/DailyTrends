<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Goutte\Client;

class AsFeed extends Feed
{
    use HasFactory;

    public function loadFeed (Client $scrapper, Publisher $publisher)
    {
        $endpoints =  $scrapper->request('GET', $publisher->site.'/noticias/ultima-hora')
        ->filter('article>div>div>div>h2>a')->each(function ($node) use ($publisher) {
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
                $image = self::getSource($crawler->filter('.mm__img'));
                if (!$image) $image = self::getSource($crawler->filter('img'), 1);
                $body = self::getHtml($crawler->filter('.art__bo'));

                if($body && $source)
                {
                    try
                    {
                        Feed::create([
                            'title' => $title,
                            'body' => "<h2>$summary</h2>$body",
                            'image' => $image,
                            'source' => $source,
                            'publisher' => $publisher->name,
                            'publisher_id' => $publisher->id
                        ]);
                    } catch (\Exception $e) {
                        DB::rollBack();
                        error_log("No he podido poner esta noticia de $publisher->name porque es demasiado grande: $source");
                    }
                }
            }
        }
    }
}
