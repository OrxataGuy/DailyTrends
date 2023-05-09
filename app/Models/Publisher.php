<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Goutte\Client;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = ['site', 'name', 'enabled'];

    public function lastNews(Client $scrapper) {
        return $this->feeds()->count() > 0 ?
            $this->feeds()->where('updated_at', '>', now()->subDay(1)->toDateTimeString())->get() :
            Feed::resolveFeed($this)->getFeed($scrapper, $this);
    }

    public function feeds() {
        return $this->hasMany(Feed::class);
    }
}
