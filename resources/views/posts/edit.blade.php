@extends('layouts.app')
@section('title')Edit @endsection

@section('content')
<div class="container mt-5 col-5">
    <form method="POST" action="{{route('post.update',$post)}}">
      
      @csrf
      @method('put')

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Title</label>
        <input type="text" class="form-control" value="{{$post->title}}" name="title" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>

      <div class="form-floating">
        <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{$post->description}} </textarea>
        <label for="floatingTextarea2">Description</label>
      </div>

      <select class="form-select form-select-md mb-3 mt-3" name="user_id" aria-label=".form-select-md example">
        @foreach ($users as $user)
        <option value="{{$user->id}}"> {{$user->name}}</option>
        @endforeach
      </select>

      <div class="text-center">
        <button type="submit" class="btn btn-primary" href="{{route('post.edit',$post)}}">Update</button>
      </div>
    </form>
  </div>

@endsection