<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Video as VideoResource;
use Mockery\Undefined;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check for sorting parameter
        if (isset($_GET['sortBy'])) {
            switch ($_GET['sortBy']) {
                case 'name':
                    return VideoResource::collection(Video::orderBy('title')->get()); // Return all the videos in the library ordered by title
                    break;

                case 'like count':
                    return VideoResource::collection(Video::orderBy('totalLikes', 'DESC')->get()); // Return all the videos in the library ordered by total likes
                    break;

                case 'updated time':
                    return VideoResource::collection(Video::orderBy('updated_at', 'DESC')->get()); // Return all the videos in the library ordered by update time
                    break;

                default:
                    return VideoResource::collection(Video::all()); // Return all the videos in the library
                    break;
            }
        } else {
            return VideoResource::collection(Video::all()); // Return all the videos in the library
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation with custom response
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'url' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()->all()], 400); // Returns validation error as JSON
        } else {
            // Assign and save to DB
            $video = Video::create([
                'title' => $request->title,
                'url' => $request->url,
                'description' => $request->description,
                'thumbnailUrl' => $request->thumbnailUrl,
            ]);

            return new VideoResource($video); //  Returns new created video
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
        if (Video::find($id)) {
            return new VideoResource(Video::find($id)); // Returns a specific video by id from DB
        } else {
            return response()->json(['error' => 'Video does not exist.'], 404); // Returns error when video doesn't exist
        }
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
        // Validation with custom response
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'url' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()->all()], 400); // Returns validation error as JSON
        } else if (Video::find($id)) {
            // Update and save to DB
            Video::find($id)->update([
                'title' => $request->title,
                'url' => $request->url,
                'description' => $request->description,
                'thumbnailUrl' => $request->thumbnailUrl
            ]);
            return new VideoResource(Video::find($id)); //  Returns new updated video

        } else {
            return response()->json(['error' => 'Video does not exist.'], 404); // Returns error when video doesn't exist
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Video::destroy($id)) {
            return response()->json(['success' => true, 'message' => 'Video deleted successfully.'], 200); // Returns success on video delete
        } else {
            return response()->json(['error' => 'Video does not exist.'], 404); // Returns error when video doesn't exist
        }
    }
}