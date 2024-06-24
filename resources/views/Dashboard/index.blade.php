@extends('layout.master')
@section('title','Dashboard')
@section('content')
<div class="container">
    <div class="mt-4">
        <div class="text-center">
         <a href="{{route("dashboard.create")}}" type="button" class="btn btn-primary">Creat Post</a>
        </div>
    </div>
    <div class="mt-4">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Post-by</th>
                <th scope="col">Created-at</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
              <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->user ? $post->user->name:'not found'}}</td>
                <td>{{$post->created_at}}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                     <a href="{{route("dashboard.show" , $post->id)}}" type="button" class="btn btn-success mr-2">View</a>
                        <a href="{{route("dashboard.edit",$post->id)}}"  type="button" class=" btn btn-warning mr-2">Edit</a>
                       <form method="POST" action="{{route("dashboard.destroy",$post->id)}}">
                        @csrf
                        @method("DELETE")
                        <button style="display:inline;" type="submit" onclick="return confirm('are you sure you want to delete the post?')" class="btn btn-danger">Delete</button>
                    </form>
                      </div>
                </td>
              </tr>
             @endforeach
            </tbody>
          </table>
    </div>
</div>

@endsection
