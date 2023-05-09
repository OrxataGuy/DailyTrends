<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Goutte\Client;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = ['site', 'name', 'enabled'];

    public function loadFeed(Client $scrapper)
    {
        Feed::resolveFeed($this)->loadFeed($scrapper, $this);
    }

    public function feeds() {
        return $this->hasMany(Feed::class);
    }
}
