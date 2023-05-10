<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Goutte\Client;

class ValenciaPlazaFeed extends Feed
{
    use HasFactory;

    public function loadFeed (Client $scrapper, Publisher $publisher)
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
                $date = self::getText($crawler->filter('.noticia__fecha'));
                $string_date = intval(now()->format('d')).now()->format('/m/Y');
                if($body && $source && str_contains($date, $string_date))
                {
                    try
                    {
                        Feed::create([
                            'title' => $title,
                            'body' => $body,
                            'image' => $publisher->site.$image,
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
