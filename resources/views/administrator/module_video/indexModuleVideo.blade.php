@extends('dashboard.dashboard')
@section('dashboard')
    <div class="content">
        <div class="row">
            <div class="col-6">
                <a href="{{route('videos.create')}}" class="btn_register_user_index btn btn-info">Cadastrar</a>
            </div>
            <div class="col-6">
                <nav class="navbar">
                    <form class="form-inline" method="POST" action="{{route('videos.index')}}">
                        @csrf
                        <input class="form-control mr-sm-2" name="searchIndexModuleSurvey" type="search" placeholder="Search Video" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>video</h3>
            </div>
        </div>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">link</th>
                    <th scope="col">video</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            @forelse($videos as $video)
                <tr>
                    <th scope="row">{{$video->id}}</th>
                    <td><a class="edit_user_module_index" href="{{route('videos.edit',$video->id)}}"><div class="edit_label"><i class="btn btn-info fa fa-pencil"></i></div>  {{$video->title}}</a></td>
                    <td>{{$video->link}}</td>
                    <td><iframe width="300" height="150" src="{{$video->link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
                    <td><a class="edit_video_module_index" href="{{route('videos.edit',$video->id)}}"><i class="btn btn-info fa fa-pencil"></i></a></td>
                    <td><a href="{{route('video.module.form.delete',$video->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
            @empty
                <td>Nenhum video econtrada.</td>
            @endforelse
            </tbody>
        </table>
        {{$videos->links()}}
    </div>
@endsection
