<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Goutte\Client;

class DailyTrendsFeed extends Feed
{
    use HasFactory;

    public function getFeed (Client $scrapper, Publisher $publisher)
    {
        return Feed::where('publisher_id', '=', $publisher->id)->where('updated_at', '>', now()->subDay(1)->toDateTimeString())->get();
    }
}
