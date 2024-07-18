@extends('layout.master')
@section('title', 'Home')
@section('content')
    <style>
        /*body {*/
        /*    display: flex;*/
        /*    justify-content: center;*/
        /*    align-items: center;*/
        /*    min-height: 100vh;*/
        /*    margin: 0;*/
        /*    background-color: #f0f0f0;*/
        /*    font-family: Arial, sans-serif;*/
        /*}*/

        .welcome-container {
            margin-left: 450px;
            margin-top: 50px;
            justify-content: center;
            align-items: center;
            padding: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
            max-width: 40%;
            background-color: #ffffff;
        }

        .welcome-container h1 {
            margin-bottom: 30px;
        }

        .welcome-container button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            background-color: #5cb85c;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        .welcome-container button:hover {
            background-color: #4cae4c;
        }

        .post {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            margin-top: 50px;
        }

        .card {
            width: 800px;
            }

        .comments-container {
            border-top: none;
            border-bottom: 1px solid #ddd;
            border-right: 1px solid #ddd;
            border-left: 1px solid #ddd;

            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-bottom: 15px;
            width: 800px;
        }
    </style>

    @if (Route::has('login'))
        @auth
            <div class="post">
                <h1 class="text-center">Welcome to home page</h1>
                @foreach ($posts as $post)
                    <div class="card text-center">
                        <div class="card-header">
                            {{ $post->user->name }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">show post</a>
                        </div>
                        <div class="card-footer text-muted">
                            {{ $post->created_at }}
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
                @endforeach
            </div>
        @else
            <div class="welcome-container">
                <h1>Welcome!</h1>
                <button onclick="location.href='{{ url('/login') }}'">Login</button>
                <button onclick="location.href='{{ url('/register') }}'">Register</button>
            </div>

            <div class="post">
                @foreach ($posts as $post)
                    <div class="card text-center">
                        <div class="card-header">
                            {{ $post->user->name }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Show post</a>
                        </div>
                        <div class="card-footer text-muted">
                            {{ $post->created_at }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endauth
    @endif
@endsection

