<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Goutte\Client;

class DailyTrendsFeed extends Feed
{
    use HasFactory;

    public function loadFeed (Client $scrapper, Publisher $publisher)
    {
        // do nothing
    }
}
