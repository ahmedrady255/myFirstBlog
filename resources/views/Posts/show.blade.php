@extends("layout.master")
@section("title","showmore")

@section("content")
    <div class="container mt-4">
        <div class="card mb-3">
            <img src="{{asset('images/'.$post->post_image)}}" class="card-img-top" alt="..."style="max-width: fit-content;max-height: fit-content;margin-left:40%">
            <div class="card-body">
                <h5 class="card-title"><big>{{$post->title}}</big></h5>
                <p class="card-text">{{$post->description}}.</p>
                <p class="card-text">{{$post->content}}.</p>
                <p class="card-text"><small class="text-body-secondary">Last updated at {{$post->updated_at}} , Created by :{{$post->user ? $post->user->name :'not found'}} ,Email : {{$post->user ? $post->user->email:'not found'}},Created at : {{$post->created_at}} </small></p>
            </div>
        </div>
        <div class="comments-container">
            <h4>Comments</h4>
            @if ($post->comments->isNotEmpty())
                @foreach ($post->comments as $comment)
                    <div class="card mb-2">
                        <div style="border-radius: 10px" class="card-body">
                            <p>{{ $comment->comment }}</p>
                            <small class="text-muted">by {{ $comment->user->name }} on {{ $comment->created_at }}</small>
                            <!-- Edit and Delete buttons for comments -->
                            @if(auth()->user()->id === $comment->user_id)
                                <div class="btn-group" style="float: right;margin-top: -50px;">
                                    <button style="width:10px;height: 10px ;" class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" onclick="" href="">Edit comment</a></li>
                                        <li>
                                            <form method="POST" action="" enctype="multipart/form-data">
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
                <form action="{{ route('comments.store', $post->id) }}" method="POST">
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

@endsection
