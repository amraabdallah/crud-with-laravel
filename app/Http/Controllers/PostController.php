<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index(){
        // dd($posts);
        // $posts = Post::all();
        $posts = Post::paginate(6);

        return view('posts.index',compact('posts'));
    }


    public function create(){

        // dd(request()->all());
        $users = User::all();


        return view('posts.create',compact('users'));
    }


    public function store(){

        // dd(request()->all());

        Post::create(request()->all());

        return redirect('/posts');
    }


    public function show($postId){
        $postinfo = Post::find($postId);
        $postinfo->formatteDdate=Carbon::createFromFormat('Y-m-d H:i:s', $postinfo->created_at)->format('l jS \\of F Y h:i:s A');
        
        // dd($postinfo);
        return view('posts.show',compact('postinfo'));
    }


    public function edit($edit){
        $post = Post::find($edit);
        $users = User::all();
        
        // dd($data);
        return view('posts.edit',compact('post','users'));
    }


    public function update($update){
        // dd(request()->all());
        Post::where('id', $update)->first()->update(request()->all());

        return redirect('/posts');
    }


    public function destroy($delete)
    {
        // dd($delete);
        Post::destroy($delete);

        return redirect('/posts');
    }
}
