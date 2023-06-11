<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = auth()->user()->profiles;
 
        return response()->json([
            'success' => true,
            'data' => $profiles
        ]);
    }

    public function show($id)
    {
        $profile = auth()->user()->profiles()->find($id);
 
        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $profile->toArray()
        ], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required',
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
        ]);
 
        $profile = new Profile();
        $profile->phone_number = $request->phone_number;
        $profile->image = $request->image;
        $profile->username = $request->username;
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->dob = $request->dob;
 
        if (auth()->user()->profiles()->save($profile))
            return response()->json([
                'success' => true,
                'data' => $profile->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Profile not added'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $profile = auth()->user()->profiles()->find($id);
 
        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found'
            ], 400);
        }

        $updated = $profile->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true,
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Profile can not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $profile = auth()->user()->profiles()->find($id);
 
        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile not found'
            ], 400);
        }
 
        if ($profile->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Profile can not be deleted'
            ], 500);
        }
    }
}
