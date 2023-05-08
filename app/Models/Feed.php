<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'image', 'source', 'publisher', ];

    protected static function getText(mixed $filter, $ifnull="") : string
    {
        if($filter->getNode(0)) return $filter->text();
        return $ifnull;
    }

    protected static function getSource(mixed $filter) : string
    {
        if($filter->getNode(0)) return $filter->attr('src');
        return "";
    }

    protected static function getHtml(mixed $filter) : string
    {
        if($filter->getNode(0)) return $filter->html();
        return "";
    }

}
