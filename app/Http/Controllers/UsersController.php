<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use Validator;
use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::all()); // Returns all the users from DB
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
            'name' => 'required',
            'email' => 'required|email|unique:users'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()->all()], 400); // Returns validation error as JSON
        } else {
            // Assign and save to DB
            $user = User::create([
                'name' => $request->name,
                'photoUrl' => $request->photoUrl,
                'email' => $request->email
            ]);

            return new UserResource($user); //  Returns new created user
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
        if (User::find($id)) {
            return new UserResource(User::find($id)); // Returns a specific user by id from DB
        } else {
            return response()->json(['error' => 'User does not exist.'], 404); // Returns error when user doesn't exist
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
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)]
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()->all()], 400); // Returns validation error as JSON
        } else if (User::find($id)) {
            // Update and save to DB
            User::find($id)->update([
                'name' => $request->name,
                'photoUrl' => $request->photoUrl,
                'email' => $request->email
            ]);

            return new UserResource(User::find($id)); //  Returns new updated user
        } else {
            return response()->json(['error' => 'User does not exist.'], 404); // Returns error when user doesn't exist
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
        if (User::destroy($id)) {
            return response()->json(['success' => true, 'message' => 'User deleted successfully.'], 200); // Returns success on user delete
        } else {
            return response()->json(['error' => 'User does not exist.'], 404); // Returns error when user doesn't exist
        }
    }
}