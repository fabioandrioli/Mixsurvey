@extends('dashboard.dashboard')
@section('dashboard')
    <div class="content">
        <div class="row">
            <div class="offset-md-2 col-md-6  col-sm-12 myCard">
                <div class="row">
                    <div class="col-12">
                        <h1>Create video</h1>
                    </div>
                </div>
                @if(!isset($video))
                <form action="{{route('videos.store')}}" method="POST">
                @else
                <form action="{{route('videos.update',$video->id)}}" method="POST">
                    {{method_field('PUT')}}
                @endif
                    @csrf
                    <div class="form-group">
                        <label for="titleFormControlInput">Title</label>
                    <input type="text" name="title" value="{{$video->title ?? ''}}" class="form-control" id="titleFormControlInput" placeholder="title this video">
                    </div>
                    <div class="form-group">
                        <label for="descriptionFormControlInput">Description</label>
                        <input type="text" name="description" value="{{$video->description ?? ''}}" class="form-control" id="descriptionFormControlInput" placeholder="Description for video">
                    </div>
                    <div class="form-group">
                        <label for="linkFormControlInput">link</label>
                        <input type="text" name="link" value="{{$video->link ?? ''}}" class="form-control" id="linkFormControlInput" placeholder="link for video">
                    </div>
                    @if(!isset($video))
                        <button class="btn btn-success" type="submit">Register</button>
                    @else
                        <button class="btn btn-success" type="submit">Edit</button>
                        <a href="{{route('video.module.form.delete',$video->id)}}" class="btn btn-danger">Delete</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
