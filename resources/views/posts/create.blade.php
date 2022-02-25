@extends('layouts.app')
@section('title')Create @endsection

@section('content')
      <div class="container mt-5 col-5">
        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>


          <div class="form-floating">
            <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Description</label>
          </div>

          <div class="mt-1">
            <label for="formFile" class="form-label">Choose A photo</label>
            <input class="form-control" type="file" id="formFile">
          </div>
          
          <select name="user_id" class="form-select form-select-md mb-3 mt-3" aria-label=".form-select-md example">
          @foreach ($users as $user)
          <option value="{{$user->id}}">{{$user->name}}</option>
          @endforeach
          </select>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      @endsection