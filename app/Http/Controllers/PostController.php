<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();   
        // return response()->json(['data' => $posts]);
        return PostDetailResource::collection($posts->loadMissing('writer:id,username'));
    }
    public function show($id)
    {
        $posts = Post::with('writer:id,username')->findOrFail($id);
        return new PostDetailResource($posts);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required||max:255',
            'content' => 'required',
        ]);

        $request['author'] = auth()->user()->id;
        $posts = Post::create($request->all());
        return new PostDetailResource($posts->loadMissing('writer:id,username'));

    }

    public function update(Request $request, $id)
    {
    }
}
 