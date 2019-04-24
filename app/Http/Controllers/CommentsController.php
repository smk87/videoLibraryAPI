<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Comment as CommentResource;
use App\User;
use App\Video;
use App\Comment;

class CommentsController extends Controller
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
        // Validation with custom response
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'comment' => 'required'
        ]);
        if ($validator->fails() || !User::find($request->user)) {
            return response()->json(['errors' => ($validator->messages()->all() ? $validator->messages()->all() : 'User does not exist.')], 400); // Returns validation error as JSON
        } else if (Video::find($id)) {
            // Comment on the video
            $comment = Comment::create([
                'user_id' => $request->user,
                'video_id' => $id,
                'comment' => $request->comment
            ]);
            return new CommentResource($comment);
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