<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileFollower;

class ProfileFollowerController extends Controller
{
    public function index()
    {
        $followers = ProfileFollower::all();

        return response()->json([
            'success' => true,
            'data' => $followers
        ]);
    }

    public function show($id)
    {
        $follower = ProfileFollower::find($id);

        return response()->json([
            'success' => true,
            'data' => $follower
        ]);
    }

    public function store(Request $request)
    {   
        $data = $request->all();

        $this->validate($request, [
            'profile_id' => 'required',
            'follower_id' => 'required',
        ]);

        $follower = ProfileFollower::create($data);

        if ($follower)
            return response()->json([
                'success' => true,
                'data' => $follower->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Profile not added'
            ], 500);
    }

    
    public function update(Request $request, $id)
    {
        $follower = ProfileFollower::find($id);

        if (!$follower) {
            return response()->json([
                'success' => false,
                'message' => 'Follower not found'
            ], 400);
        }

        $updated = $follower->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true,
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Follower can not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $follower = ProfileFollower::find($id);
 
        if (!$follower) {
            return response()->json([
                'success' => false,
                'message' => 'Follower not found'
            ], 400);
        }
 
        if ($follower->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Follower can not be deleted'
            ], 500);
        }
    }
}
