<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\Like;
use App\Http\Resources\Like as LikeResource;
use App\User;
use Illuminate\Support\Facades\Validator;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();

        if (count($videos) != 0) {
            $allLikes = [];
            foreach ($videos as $video) {
                $likeList =  ['id' => $video->id, 'title' => $video->title, 'url' => $video->url, 'totalLike' => $video->totalLikes];
                array_push($allLikes, $likeList); // Pushing all the video's like data into one array
            }
            return response()->json($allLikes, 200); // Return all video's total like count
        } else {
            return response()->json(['error' => 'No video exist.'], 404); // Returns error when no video exist
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // Validation with custom response
        $validator = Validator::make($request->all(), [
            'user' => 'required'
        ]);
        if ($validator->fails() || !User::find($request->user)) {
            return response()->json(['error' => ($validator->messages()->all() ? 'The user field is required.' : 'User does not exist.')], 400); // Returns validation error as JSON
        } else if (Video::find($id)) {
            $like = Like::where([['video_id', '=', $id], ['user_id', '=', $request->user]])->get();
            if (count($like) == 0) {
                // Like the video
                $like = Like::create([
                    'user_id' => $request->user,
                    'video_id' => $id,
                    'like' => true
                ]);
                $video = Video::find($id);
                $video->timestamps = false;
                $video->increment('totalLikes'); // Increase the like counter for this video
                $video->save(); // Save to DB

                return new LikeResource($like);
            } else {
                // Change like to true or false
                if ($like[0]->like) {
                    Like::find($like[0]->id)->update([
                        'like' => false // Unlike the video
                    ]);
                    $video = Video::find($id);
                    $video->timestamps = false;
                    $video->decrement('totalLikes'); // Decrease the like counter for this video
                    $video->save(); // Save to DB

                    return response()->json(['like' => false, 'messages' => 'You have unliked the video.'], 200);
                } else {
                    Like::find($like[0]->id)->update([
                        'like' => true // Like the video again
                    ]);
                    $video = Video::find($id);
                    $video->timestamps = false;
                    $video->increment('totalLikes'); // Increase the like counter for this video
                    $video->save(); // Save to DB

                    return response()->json(['like' => true, 'messages' => 'You have liked the video.'], 200);
                }
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
        $likeCount = 0;
        $video = Video::find($id);

        if ($video) {
            foreach ($video->likes as $i) {
                if ($i->like) {
                    $likeCount += 1;
                }
            }
            return response()->json(['id' => $video->id, 'title' => $video->title, 'url' => $video->url, 'totalLike' => $likeCount], 200); // Return total like count of a video
        } else {
            return response()->json(['error' => 'Video does not exist.'], 404); // Returns error when video doesn't exist
        }
    }
}