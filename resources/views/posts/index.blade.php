@extends('layouts.app')
@section('title')Posts @endsection
@section('content')

      <div class="text-center mt-4">
        <a type="button" class="btn btn-success" href="{{route('post.create')}}">Create</a>
      </div>
      
      <div class="container mt-3">
        <table class="table text-center">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">Slug</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              {{-- @dd($posts[0]->title) --}}
                @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->title}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->slug}}</td>
                    <td>
                      <div class="d-flex justify-content-center ">
                        <a href="{{route('post.show',$post->id)}}" type="button" class="btn btn-info">View</a>
                        <a href="{{route('post.show',$post->id.'/edit')}}" type="button" class="btn btn-primary">Edit</a>

                        <form action="{{route('post.destroy',$post['id'])}}" method="POST">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                      </div>
                    </td>
                </tr>
                @endforeach

            </tbody>
          </table>
          {!! $posts->links() !!}
      </div>

      @endsection
