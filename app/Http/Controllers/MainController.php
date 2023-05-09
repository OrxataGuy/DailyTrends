<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use App\Models\Feed;
use App\Models\Publisher;

class MainController extends Controller
{
    protected $scrapper;

    public function __construct(Client $scrapper) {
        $this->scrapper = $scrapper;
    }
    public function index() {
        return view('pages.index');
    }

    public function post(string $publisher, int $id) {
        return view('pages.post');
    }

    public function tests() {

        Publisher::find(7)->loadFeed($this->scrapper);
    }
}
