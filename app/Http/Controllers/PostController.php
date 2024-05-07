<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{

    public function index()
    {
        return Post::latest()->get();
    }

    public function store(StorePostRequest $request)
    {
        return Post::create([
            'user_id' => 1,
            'title' => $request->title,
            'body' => $request->body
        ]); 
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return response()->json('post updated successfully', 200);
    }
    
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json('post deleted successfully', 200);
    }
}
