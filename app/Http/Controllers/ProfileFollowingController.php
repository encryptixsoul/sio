<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileFollowing;

class ProfileFollowingController extends Controller
{
    public function index()
    {
        $followings = ProfileFollowing::all();

        return response()->json([
            'success' => true,
            'data' => $followings
        ]);
    }

    public function show($id)
    {
        $following = ProfileFollowing::find($id);

        return response()->json([
            'success' => true,
            'data' => $following
        ]);
    }

    public function store(Request $request)
    {   
        $data = $request->all();

        $this->validate($request, [
            'profile_id' => 'required',
            'following_id' => 'required',
        ]);

        $following = ProfileFollowing::create($data);

        if ($following)
            return response()->json([
                'success' => true,
                'data' => $following->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Following not added'
            ], 500);
    }

    
    public function update(Request $request, $id)
    {
        $following = ProfileFollowing::find($id);

        if (!$following) {
            return response()->json([
                'success' => false,
                'message' => 'Following not found'
            ], 400);
        }

        $updated = $following->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true,
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Following can not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $following = ProfileFollowing::find($id);
 
        if (!$following) {
            return response()->json([
                'success' => false,
                'message' => 'Following not found'
            ], 400);
        }
 
        if ($following->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Following can not be deleted'
            ], 500);
        }
    }
}
