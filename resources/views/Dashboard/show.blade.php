@extends("layout.master")
@section("title","show")

@section("content")
      <div class="container mt-4">
          <div class="card mb-3">
              <img src="{{asset('images/'.$s_post->post_image)}}" class="card-img-top" alt="..."style="max-width: fit-content;max-height: fit-content;margin-left:40%">
              <div class="card-body">
                  <h5 class="card-title"><big>{{$s_post->title}}</big></h5>
                  <p class="card-text">{{$s_post->discription}}.</p>
                  <p class="card-text"><small class="text-body-secondary">Last updated at {{$s_post->updated_at}} , Created by :{{$s_post->user ? $s_post->user->name :'not found'}} ,Email : {{$s_post->user ? $s_post->user->email:'not found'}},Created at : {{$s_post->created_at}} </small></p>
              </div>
      </div>
      <div class="container mt-4">
          <div class="card">
            <div class="card-header">
                postinfo
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>Created by :{{$s_post->user ? $s_post->user->name :'not found'}} </p>
                <p>Email : {{$s_post->user ? $s_post->user->email:'not found'}}</p>
                <footer class="blockquote-footer"> <cite title="Source Title"> Created at : {{$s_post->created_at}} </cite></footer>
              </blockquote>
            </div>
          </div>
      </div>
@endsection
