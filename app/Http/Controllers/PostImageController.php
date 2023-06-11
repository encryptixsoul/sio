<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostImage;

class PostImageController extends Controller
{
    public function index()
    {
        $post_images = PostImage::all();

        return response()->json([
            'success' => true,
            'data' => $post_images
        ]);
    }

    public function show($id)
    {
        $post_image = PostImage::find($id);

        return response()->json([
            'success' => true,
            'data' => $post_image
        ]);
    }

    public function store(Request $request)
    {   
        $data = $request->all();

        $this->validate($request, [
            'post_id' => 'required',
            'image' => 'required',
        ]);

        $post_image = PostImage::create($data);

        if ($post_image)
            return response()->json([
                'success' => true,
                'data' => $post_image->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post Image not added'
            ], 500);
    }

    
    public function update(Request $request, $id)
    {
        $post_image = PostImage::find($id);

        if (!$post_image) {
            return response()->json([
                'success' => false,
                'message' => 'Post Image not found'
            ], 400);
        }

        $updated = $post_image->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true,
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Post Image can not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $post_image = PostImage::find($id);
 
        if (!$post_image) {
            return response()->json([
                'success' => false,
                'message' => 'Post Image not found'
            ], 400);
        }
 
        if ($post_image->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Image can not be deleted'
            ], 500);
        }
    }
}
