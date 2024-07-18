@extends('layout.master')

@section('title', 'Search Result')

@section('content')
    <div class="container-fluid">
        @if (count($results) > 0)
            @foreach ($results as $result)
                @if ($result->user_id == Auth::id())
                    <p style="align-content: center">your posts </p>
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <div class="btn-group">
                                <button style="width:10px;height: 10px; margin-left: 260px;" class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false"></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('post.edit', $result->id) }}">Edit post</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('post.delete', $result->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('delete')
                                            <button class="dropdown-item">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <img src="{{ asset('images/' . $result->post_image) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $result->title }}</h5>
                                <p class="card-text">{{ $result->description }}</p>
                                <a href="{{ route('post.show', $result->id) }}" class="btn btn-primary">Show more</a>
                            </div>
                        </div>
                    </div>
                @elseif($result->user_id != Auth::id())
                    <div class="col-md-4 mb-4">
                        <p style="align-content: center ;align-items: center;color: black;font-size: large;font-weight: bold">other posts </p>
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('images/' . $result->post_image) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $result->title }}</h5>
                                <p class="card-text">{{ $result->description }}</p>
                                <a href="{{ route('post.show', $result->id) }}" class="btn btn-primary">Show more</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <p>No results found.</p>
        @endif
    </div>
@endsection
