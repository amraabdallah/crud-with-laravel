@extends('layouts.app')
@section('title')Users @endsection
@section('content')

      <div class="text-center mt-4">
        <a type="button" class="btn btn-success" href="{{route('post.create')}}">Create</a>
      </div>
      
      <div class="container mt-3">
        <table class="table text-center">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
              </tr>
            </thead>
            <tbody>
              {{-- @dd($posts[0]->title) --}}
                @foreach ($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
          {!! $users->links() !!}
      </div>

      @endsection
