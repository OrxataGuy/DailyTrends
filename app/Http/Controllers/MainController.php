<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Contracts\View\View;
use App\Models\Publisher;
use App\Models\Feed;

class MainController extends Controller
{
    protected $scrapper;

    public function __construct(Client $scrapper) {
        $this->scrapper = $scrapper;
    }
    public function index() {
        return view('pages.index');
    }

    public function post(int $id) {
        $post = Feed::find($id);
        return view('pages.post', ['post' => $post]);
    }

    public function tests() {
        Publisher::find(7)->loadFeed($this->scrapper);
    }

    public function togglePublisher(Request $request) : JsonResponse
    {
        $publisher = Publisher::find($request->get('id'));
        $publisher->enabled = $publisher->enabled == 1 ? 0 : 1;
        $publisher->save();
        if($publisher->enabled == 1) $publisher->loadFeed($this->scrapper);
        return response()->json(array(
            'status' => 200
        ));
    }

    public function upload(Request $request) : JsonResponse
    {
        $filename = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $filename);

        // save uploaded image filename here to your database

        return response()->json(array(
            'status' => 200,
            'value' => $filename
        ));
    }
}
