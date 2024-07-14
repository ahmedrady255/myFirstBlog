@extends("layout.master")
@section('title','allPosts')
@section('content')
    <div class="container">
    <div>
        <div class="mt-4">
            <div class="text-center">
                <a href="{{route("post.create")}}" type="button" class="btn btn-primary">Creat Post</a>
            </div>
        </div>
    </div>
    <div class="container text-center mt-4">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 18rem;">
                        <div class="btn-group">
                            <button style="width:10px;height: 10px ;margin-left: 260px;" class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('post.edit',$post->id)}}">Edit post</a></li>
                                <li>
                                    <form method="POST" action="{{route('post.delete',$post->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('delete')
                                    <button class="dropdown-item">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <img src="{{ asset('images/'.$post->post_image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->discription }}</p>
                            <a href="{{ route("post.show", $post->id) }}" class="btn btn-primary">Show more</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>

@endsection
