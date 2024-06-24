@extends('layout.master')
@section('title','search result')
@section('content')
<div class="container-fluid">
@if (count($results) > 0)
        <div class="mt-4 text-center">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Post-by</th>
                    <th scope="col">Created-at</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($results as $result)
                  <tr>
                    <th scope="row">{{$result->id}}</th>
                    <td>{{$result->title}}</td>
                    <td>{{$result->user ? $result->user->name:'not found'}}</td>
                    <td>{{$result->created_at}}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                         <a href="{{route("dashboard.show" , $result->id)}}" type="button" class="btn btn-success mr-2">View</a>
                            <a href="{{route("dashboard.edit",$result->id)}}"  type="button" class=" btn btn-warning mr-2">Edit</a>
                           <form method="POST" action="{{route("dashboard.destroy",$result->id)}}">
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
@else
    <p>No results found.</p>
@endif
</div>
</div>
@endsection
