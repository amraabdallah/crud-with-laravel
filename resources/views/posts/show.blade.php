@extends('layouts.app')
@section('title')Show @endsection

@section('content')
{{-- @dd($postinfo); --}}

<div class="container mt-5 col-6">

    <table class="table">
        <thead class="table-light">
          <th> Post Info</th>
        </thead>
        <tbody>
          <td>
              <strong>Title</strong>
              <p>{{$postinfo['title']}}</p>

              <strong>Description</strong>
              <p>{{$postinfo['description']}}</p>
          </td>
        </tbody>
      </table>
    {{-- ============================= --}}
    <table class="table mt-4">
        <thead class="table-light">
          <th> Post Creator Info</th>
        </thead>
        <tbody>
          {{-- @dd($users) --}}
          
          <td>
              <strong>Name</strong>
              <p>{{$postinfo->user->name}}</p>

              <strong>Email</strong>
              <p>{{$postinfo->user->email}}</p>

              <strong>Created At</strong>
              <p>{{$postinfo->formatteDdate}}</p>
              
          </td>
        </tbody>
      </table>
      
    
</div>

@endsection