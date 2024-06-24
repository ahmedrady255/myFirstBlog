@extends("layout.master")
@section("title","showmore")

@section("content")
    <div class="container mt-4">
        <div class="card mb-3">
            <img src="{{asset('images/'.$post->post_image)}}" class="card-img-top" alt="..."style="max-width: fit-content;max-height: fit-content;margin-left:40%">
            <div class="card-body">
                <h5 class="card-title"><big>{{$post->title}}</big></h5>
                <p class="card-text">{{$post->discription}}.</p>
                <p class="card-text">{{$post->content}}.</p>
                <p class="card-text"><small class="text-body-secondary">Last updated at {{$post->updated_at}} , Created by :{{$post->user ? $post->user->name :'not found'}} ,Email : {{$post->user ? $post->user->email:'not found'}},Created at : {{$post->created_at}} </small></p>
            </div>
        </div>

@endsection
