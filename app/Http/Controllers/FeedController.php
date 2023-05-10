<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Contracts\View\View;
use App\Models\Feed;
use App\Models\Publisher;



class FeedController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $publisher = Publisher::find(2);

        $feed = Feed::create([
            'title' => "Escriba el título de su artículo",
            'body' => "",
            'image' => "",
            'source' => env('app_url'),
            'publisher' => $publisher->name,
            'publisher_id' => $publisher->id,
            'deleted' => 1
        ]);

        return redirect()->route('article.edit', ['article' => $feed->id]);
    }


    public function list() : JsonResponse
    {
        $feeds = Feed::whereHas('publisher', function($publisher) {
            $publisher->where('enabled', 1);
        })
        ->where('deleted', 0)
        ->inRandomOrder()
        ->get();
        return response()->json(array(
            'status' => 200,
            'value' => $feeds
        ));
    }

    public function listPublisher($id) : JsonResponse
    {
        $feeds = Feed::where('publisher_id', $id)
        ->where('deleted', 0)
        ->inRandomOrder()
        ->get();
        return response()->json(array(
            'status' => 200,
            'value' => $feeds
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : JsonResponse
    {
        return response()->json(array(
            'status' => 200
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) : JsonResponse
    {
        return response()->json(array(
            'status' => 200
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) : View
    {
        $post = Feed::find($id);
        return view('pages.writer', ['post' =>  $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) : JsonResponse
    {
        $post = Feed::find($id);
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->image = $request->get('image');
        $post->deleted = 0;
        $post->save();
        return response()->json(array(
            'status' => 200
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) : JsonResponse
    {
        $feed = Feed::find($id);
        $feed->deleted = 1;
        $feed->save();
        return response()->json(array(
            'status' => 200
        ));
    }
}
