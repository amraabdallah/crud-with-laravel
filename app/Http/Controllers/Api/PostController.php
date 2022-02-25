<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use App\Http\Resources\PostResource;

class PostController extends Controller //>>>>>>>>>>>>>>>>>API CONTROLLER<<<<<<<<<<<<<<<<<<<<<<<<<
{
    public function index(){
        // $posts = Post::all();
        $posts = Post::with('user')->get();

        return PostResource::collection($posts);
    }

    public function show($postId){
        $postinfo = Post::find($postId);
        return new PostResource($postinfo);
    }

    public function store(){

        Post::create([
            'title' => request()->title,
            'description' => request()->description,
            'user_id'=> request()->user_id,
            'slug'=> Str::slug(request()->title),
        ]);

        $insertedData = Post::latest('id')->first();
        return $insertedData;
    }

    


}
