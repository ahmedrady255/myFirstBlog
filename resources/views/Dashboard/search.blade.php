@extends('layout.master')

@section('title', 'Search Result')

@section('content')
    <div class="container-fluid">
        @if (count($results) > 0)
            @foreach ($results as $result)
                @if ($result->user_id == Auth::id())
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
                @else
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
                            <tr>
                                <th scope="row">{{ $result->id }}</th>
                                <td>{{ $result->title }}</td>
                                <td>{{ $result->user ? $result->user->name : 'not found' }}</td>
                                <td>{{ $result->created_at }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="{{ route('dashboard.show', $result->id) }}" type="button" class="btn btn-success mr-2">View</a>
                                            <a href="{{ route('dashboard.edit', $result->id) }}" type="button" class="btn btn-warning mr-2">Edit</a>
                                            <form method="POST" action="{{ route('dashboard.destroy', $result->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete the post?')" class="btn btn-danger">Delete</button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            @endforeach
        @else
            <p>No results found.</p>
        @endif
    </div>
@endsection
