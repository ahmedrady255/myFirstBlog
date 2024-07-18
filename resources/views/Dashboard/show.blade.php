@extends("layout.master")
@section("title","show")

@section("content")
      <div class="container mt-4">
          <div class="card mb-3"><div class="btn-group">
                  <button style="width:10px;height: 10px ;margin-left:97.6%;" class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                  </button>
                  <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{route('dashboard.edit',$s_post->id)}}">Edit post</a></li>
                      <li>
                          <form method="POST" action="{{route('dashboard.destroy',$s_post->id)}}" enctype="multipart/form-data">
                              @csrf
                              @method('delete')
                              <button class="dropdown-item">Delete</button>
                          </form>
                      </li>
                  </ul>
              </div>
              <img src="{{asset('images/'.$s_post->post_image)}}" class="card-img-top" alt="..."style="max-width: fit-content;max-height: fit-content;margin-left:40%">
              <div class="card-body">
                  <h5 class="card-title"><big>{{$s_post->title}}</big></h5>
                  <p class="card-text">{{$s_post->description}}.</p>
                  @if ($s_post->video_url)
                      @php
                          $videoId = App\Helpers\videoHelper::getVideoId($s_post->video_url);
                      @endphp
                      @if ($videoId)
                          <div class="embed-responsive embed-responsive-16by9">
                              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                          </div>
                      @else
                          <p>Invalid YouTube URL</p>
                      @endif
                  @endif
                  <p class="card-text"><small class="text-body-secondary">Last updated at {{$s_post->updated_at}} , Created by :{{$s_post->user ? $s_post->user->name :'not found'}} ,Email : {{$s_post->user ? $s_post->user->email:'not found'}},Created at : {{$s_post->created_at}} </small></p>
              </div>
      </div>
          <div class="comments-container">
              <h4>Comments</h4>
              @if ($s_post->comments->isNotEmpty())
                  @foreach ($s_post->comments as $comment)
                      <div class="card mb-2">
                          <div style="border-radius: 10px" class="card-body">
                              <p>{{ $comment->comment }}</p>
                              <small class="text-muted">by {{ $comment->user->name }} on {{ $comment->created_at }}</small>
                              @if(auth()->user()->id === $comment->user_id)
                                  <div class="btn-group" style="float: right;margin-top: -50px;">
                                      <button style="width:10px;height: 10px;" class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false"></button>
                                      <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="#">Edit comment</a></li>
                                          <li>
                                              <form method="POST" action="#" enctype="multipart/form-data">
                                                  @csrf
                                                  @method('delete')
                                                  <button class="dropdown-item">Delete</button>
                                              </form>
                                          </li>
                                      </ul>
                                  </div>
                              @endif
                          </div>
                      </div>
                  @endforeach
              @else
                  <p>No comments yet.</p>
              @endif

              @auth
                  <form action="{{ route('comments.store', $s_post->id) }}" method="POST">
                      @csrf
                      <div class="form-group">
                          <label for="body">Add a Comment:</label>
                          <textarea style="border-radius: 10px" name="comment" id="body" rows="3" class="form-control" required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary mt-2">Submit</button>
                  </form>
              @endauth

              @guest
                  <p>Please <a href="{{ route('login') }}">login</a> to comment.</p>
              @endguest
          </div>
      </div>
      <div class="container mt-4">
          <div class="card">
            <div class="card-header">
                Post info
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
