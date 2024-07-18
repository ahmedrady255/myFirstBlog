@extends('layout.master')
@section('title', 'Create Post')
@section('content')
    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @csrf
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
            Title:
            <input class="form-control" name="title" type="text" value="{{ old('title') }}">
            <div class="form-floating">
                Description:
                <textarea class="form-control" name="description" style="height: 100px">{{ old('description') }}</textarea>
            </div>
            <div class="form-floating">
                Content:
                <textarea class="form-control" name="post_content" style="height: 100px">{{ old('post_content') }}</textarea>
            </div>
            Upload photo:
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="post_image" value="{{ old('post_image') }}">
                <label class="input-group-text">Upload</label>
            </div>

                Video URL:
                <input class="form-control" name="video_url" type="text">

            <input class="btn btn-primary mt-2" type="submit" value="Submit">
        </div>
    </form>
@endsection
