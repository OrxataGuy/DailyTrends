<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'image', 'source', 'publisher', 'publisher_id', 'deleted'];
    protected $table = 'feeds';

    public static function resolveFeed(Publisher $publisher) : Feed
    {
        switch($publisher->name)
        {
            case 'AS': return new AsFeed;
            case 'ElMundo': return new ElMundoFeed;
            case 'ElPais': return new ElPaisFeed;
            case 'Levante': return new LevanteFeed;
            case 'Marca': return new MarcaFeed;
            case 'VPlaza': return new ValenciaPlazaFeed;
            default: return new DailyTrendsFeed;
        }
    }

    public function getNext() : Feed
    {
        $feed = Feed::find(Feed::where('id', '>', $this->id)->where('deleted', 0)->min('id'));
        if($feed) return $feed;
        return $this;
    }

    public function getPrevious() : Feed
    {
        $feed = Feed::find(Feed::where('id', '<', $this->id)->where('deleted', 0)->max('id'));
        if($feed) return $feed;
        return $this;
    }

    public function getRelated($number=1)
    {
        $feed = Feed::where('id', '<>', $this->id)->where('deleted', 0)->where('publisher_id', '=', $this->publisher_id)->inRandomOrder()->take($number)->get();
        if($feed) return $feed;
        return $this;
    }

    protected static function getText(mixed $filter, $alt="") : string
    {
        if($filter->getNode(0)) return mb_convert_encoding($filter->text(), "UTF-8", mb_detect_encoding($filter->text()));
        return $alt;
    }

    protected static function getSource(mixed $filter, $node=0) : string
    {
        if($filter->getNode($node)) return $filter->getNode($node)->getAttribute('src');
        return "";
    }

    protected static function getHtml(mixed $filter) : string
    {
        if($filter->getNode(0)) return mb_convert_encoding($filter->html(), "UTF-8", mb_detect_encoding($filter->html()));
        return "";
    }

    public function publisher() {
        return $this->belongsTo(Publisher::class);
    }

}
