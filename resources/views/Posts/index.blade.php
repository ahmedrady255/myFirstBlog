@extends("layout.master")
@section('title','allPosts')
@section('content')
    <div class="container text-center mt-4">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 18rem;">
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


@endsection
