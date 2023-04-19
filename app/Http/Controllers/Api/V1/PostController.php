<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PostResource;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{  
    //show all the posts
    public function index()
    {
        return PostResource::collection(Post::all());
        //we can also use this 
        //return PostResource::collection(Post::paginate(10));
    }

    //show a single post
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    //store a new post
    public function store(storePostRequest $request)
    {
        Post::create($request->validated()); 
        // check if image is a file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        }
        return response()->json([
            'message' => 'Post created successfully'
        ]); 
        
    }

    //update a post
    public function update(storePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return response()->json([
            'message' => 'Post updated successfully'
         ]); 
    }

    //delete a post
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'message' => 'Post deleted successfully'
        ]); 
    }
   

}

//http://127.0.0.1:8000/api/V1/posts my api url
