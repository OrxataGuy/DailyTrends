<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use \Illuminate\Contracts\View\View;
use App\Models\Feed;



class FeedController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create() : View
    {
        return view();
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
