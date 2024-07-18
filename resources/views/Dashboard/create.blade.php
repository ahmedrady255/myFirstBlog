@extends("layout.master")
@section("title","Create post")
@section('content')
<form method="POST" action="{{route("dashboard.store")}}" enctype="multipart/form-data">
    @csrf {{--must be used to security after any post request --}}
     <div class="container mt-4">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        Title :
        <input class="form-control" name="title"  type="text"  aria-label="default input example" value="{{old('title')}}">

        <div class="form-floating">
            Description :
            <textarea class="form-control"  name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{old('description')}}</textarea>
        </div>
            <div class="form-floating">
                Content :
                <textarea class="form-control"  name="post_content" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{old('post_content')}}</textarea>
            </div>
            Upload photo:
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="post_image" id="inputGroupFile02" value="{{old('post_image')}}">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
            </div>
            Video URL:
            <input class="form-control" name="video_url" type="text">

            <div class="mb-3">
            <label class="form-check-label">Post creator:</label>
            <select name="post_creator" class="form-control">
                @foreach ($Users as $user )
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <input class="btn btn-primary mt-2" type="submit" value="Submit">
     </div>
</form>
@endsection
