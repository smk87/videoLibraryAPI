<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Like;
use App\Http\Resources\Like as LikeResource;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if (Video::find($id)) {
            $like = Like::where([['video_id', '=', $id], ['user_id', '=', $request->user]])->get();
            if (count($like) == 0) {
                $like = Like::firstorCreate([
                    'video_id' => $id
                ], [
                    'user_id' => $request->user,
                    'video_id' => $id,
                    'like' => true
                ]);
                return new LikeResource($like);
            } else {
                // Change like to true or false
                return "Unliked.";
            }
        } else {
            return response()->json(['error' => 'Video does not exist.'], 404); // Returns error when video doesn't exist
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}