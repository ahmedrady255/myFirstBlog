@extends("layout.master")
@section("title","Edit post")
@section('content')
<form method="POST" action="{{route("dashboard.update",$post->id)}}" enctype="multipart/form-data">
    @method('PUT') {{--to escape from html limitation--}}
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
        <input class="form-control" name="title"  type="text" value="{{$post->title}}" aria-label="default input example">

        <div class="form-floating">
            Discreption :
            <textarea class="form-control"  name="discreption" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{$post->discription}}</textarea>
        </div>
            <div class="form-floating">
                Content :
                <textarea class="form-control"  name="post_content" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{old('discreption')}}</textarea>
            </div>
            Upload photo:
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="post_image" value="{{$post->post_image}}" id="inputGroupFile02">

            </div>
        <div class="mb-3">
            <label class="form-check-label">Post creator:</label>
            <select name="post_creator" class="form-control">
                @foreach ($Users as $user )
                {{-- <option value="{{ $user->id }}" @if ($user->id == $post->user_id) selected @endif>{{ $user->name }}</option> --}}
                <option @selected($post->user_id==$user->id) value="{{ $user->id }}"> {{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <input class="btn btn-primary mt-2" type="submit" value="Edit post">
     </div>
</form>

@endsection
