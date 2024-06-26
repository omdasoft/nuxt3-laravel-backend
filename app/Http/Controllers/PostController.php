<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{

    public function index()
    {
        return Post::with('user:id,name')->latest()->get();
    }

    public function store(StorePostRequest $request)
    {
        return Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body
        ]); 
    }

    public function show(Post $post)
    {
        return $post->load('user:id,name');
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $post);
        return $post->load('user:id,name');
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        Gate::authorize('update', $post);
        $post->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return response()->json('post updated successfully', 200);
    }
    
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        $post->delete();
        return response()->json('post deleted successfully', 200);
    }
}
