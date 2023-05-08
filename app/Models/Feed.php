<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'image', 'source', 'publisher', ];

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

}
