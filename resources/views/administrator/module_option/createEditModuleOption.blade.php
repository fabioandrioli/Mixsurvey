@extends('dashboard.dashboard')
@section('dashboard')
    <div class="content">
        <div class="row">
            <div class="offset-md-2 col-md-8 col-sm-12 myCard">
                <div class="row">
                    <div class="col-12">
                        @if(!isset($option))
                            <h1>Create Option of survey: {{$survey->title}}</h1>
                        @else
                             <h1>Edit Option</h1>
                        @endif
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(isset($option))
                    <form action="{{route('options.update',$option->id)}}" method="POST" enctype="multipart/form-data">
                        {{method_field('PUT')}}
                @else
                    <form action="{{route('option.store')}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="survey_id" value="{{$survey->id}}"/>
                @endif
                    @csrf
                    <div class="form-group">
                        <label for="titleFormControlInput">Title</label>
                    <input type="text" name="title" value="{{$option->title ?? ''}}" class="form-control" id="titleFormControlInput" placeholder="title this option">
                    </div>
                    <div class="form-group">
                        <label for="descriptionFormControlInput">Description</label>
                        <input type="text" name="description" value="{{$option->description ?? ''}}" class="form-control" id="descriptionFormControlInput" placeholder="Description for option">
                    </div>

                    <div class="form-group">
                        @if(isset($option) && !empty($option->image))
                            <input id="edit_image" type="file" name="image" class="form-control-file" id="ImageFormControlFile">
                            <picture>
                                <label for="edit_image">
                                    <img style="cursor:pointer" width="150px" height="150px" src="{{url('assets/uploads/options/'.$option->image)}}" class="img-edit img-fluid img-thumbnail" alt="Imagem edição">
                                </label>
                            </picture>
                            <div class="form-check">
                                <input name="remove_image" type="checkbox" value="1" class="form-check-input" id="RemoveImageCheck">
                                <label class="form-check-label" for="RemoveImageCheck">Remover imagem</label>
                            </div>
                        @else
                             <label for="ImageFormControlFile">option image</label>
                            <input type="file" name="image" class="form-control-file" id="ImageFormControlFile">
                        @endif
                        <p>Dimensão ideal Alt: 300px Larg: 300px</p>
                    </div>
                    @if(isset($option))
                        <button class="btn btn-success" type="submit">Edit</button>
                        <a href="{{route('option.module.form.delete',$option->id)}}" class="btn btn-danger">Delete</a>
                    @else
                         <button class="btn btn-success" type="submit">Cadastrar</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
