<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DataTables;


class PostController extends Controller
{
    public function index(){
        // dd($posts);
        // $posts = Post::all();
        $posts = Post::paginate(9);

        return view('posts.index',compact('posts'));
    }


    public function create(){

        $users = User::all();
        // dd(request()->all());

        return view('posts.create',compact('users'));
    }


    public function store(PostRequest $request){
        // dd(request());
        // dd($request->isDirty());
        // Post::create(request()->all());
        // dd(Post::where('id', $request->id)->exists());
        // dd(Post::latest('id')->first()->id);

        Post::create([
            'title' => request()->title,
            'description' => request()->description,
            'user_id'=> request()->user_id,
            'slug'=> Str::slug(request()->title),
        ]);


        

        // 'slug' => SlugService::createSlug(Post::class, 'slug', $request->title)

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
        // dd($update);

        Validator::make(request()->all(), [
            'title' =>['required',Rule::unique('posts')->ignore($update)], //ignore unique title on this id on update
            'description'=>['required','min:10'],
            'user_id'=>['required'],
        ])->validate();


        if(Post::where('id', $update)->exists()){ //if the inserted id exists on the database > proceed
            Post::where('id', $update)->first()->update([
                'title' => request()->title,
                'description' => request()->description,
                'user_id'=> request()->user_id,
                'slug'=> Str::slug(request()->title),
        ]);
    }
    else{
        return abort(404);
    }

        return redirect('/posts');
    }


    public function destroy($delete)
    {
        // dd($delete);
        Post::destroy($delete);

        return redirect('/posts');
    }
}
