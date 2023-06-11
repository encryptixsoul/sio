<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostComment;

class PostCommentController extends Controller
{
    public function index()
    {
        $post_comments = PostComment::all();

        return response()->json([
            'success' => true,
            'data' => $post_comments
        ]);
    }

    public function show($id)
    {
        $post_comment = PostComment::find($id);

        return response()->json([
            'success' => true,
            'data' => $post_comment
        ]);
    }

    public function store(Request $request)
    {   
        $data = $request->all();

        $this->validate($request, [
            'post_id' => 'required',
            'profile_id' => 'required',
            'comment' => 'required',
        ]);

        $post_comment = PostComment::create($data);

        if ($post_comment)
            return response()->json([
                'success' => true,
                'data' => $post_comment->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post Like not added'
            ], 500);
    }

    
    public function update(Request $request, $id)
    {
        $post_comment = PostComment::find($id);

        if (!$post_comment) {
            return response()->json([
                'success' => false,
                'message' => 'Post Like not found'
            ], 400);
        }

        $updated = $post_comment->fill($request->all())->save();
 
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
        $post_comment = PostComment::find($id);
 
        if (!$post_comment) {
            return response()->json([
                'success' => false,
                'message' => 'Post Like not found'
            ], 400);
        }
 
        if ($post_comment->delete()) {
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
