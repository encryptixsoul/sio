<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostLike;

class PostLikeController extends Controller
{
    public function index()
    {
        $post_likes = PostLike::all();

        return response()->json([
            'success' => true,
            'data' => $post_likes
        ]);
    }

    public function show($id)
    {
        $post_like = PostLike::find($id);

        return response()->json([
            'success' => true,
            'data' => $post_like
        ]);
    }

    public function store(Request $request)
    {   
        $data = $request->all();

        $this->validate($request, [
            'post_id' => 'required',
            'profile_id' => 'required',
        ]);

        $post_like = PostLike::create($data);

        if ($post_like)
            return response()->json([
                'success' => true,
                'data' => $post_like->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post Like not added'
            ], 500);
    }

    
    public function update(Request $request, $id)
    {
        $post_like = PostLike::find($id);

        if (!$post_like) {
            return response()->json([
                'success' => false,
                'message' => 'Post Like not found'
            ], 400);
        }

        $updated = $post_like->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true,
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post Like can not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $post_like = PostLike::find($id);
 
        if (!$post_like) {
            return response()->json([
                'success' => false,
                'message' => 'Post Like not found'
            ], 400);
        }
 
        if ($post_like->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Like can not be deleted'
            ], 500);
        }
    }
}
