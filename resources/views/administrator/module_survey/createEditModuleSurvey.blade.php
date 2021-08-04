@extends('dashboard.dashboard')
@section('dashboard')
    <div class="content">
        <div class="row">
            <div class="offset-md-2 col-md-8 col-sm-12 myCard">
                <div class="row">
                    <div class="col-12">
                        @if(!isset($survey))
                            <h1>Create Survey</h1>
                        @else
                             <h1>Edit Survey</h1>
                        @endif
                    </div>
                </div>
                @if(!isset($survey))
                <form action="{{route('surveis.store')}}" method="POST" enctype="multipart/form-data">
                @else
                <form action="{{route('surveis.update',$survey->id)}}" method="POST" enctype="multipart/form-data">
                    {{method_field('PUT')}}
                @endif
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="titleFormControlInput">Title</label>
                    <input type="text" name="title" value="{{$survey->title ?? ''}}" class="form-control" id="titleFormControlInput" placeholder="title this survey">
                    </div>
                    <div class="form-group">
                        <label for="descriptionFormControlInput">Description</label>
                        <input type="text" name="description" value="{{$survey->description ?? ''}}" class="form-control" id="descriptionFormControlInput" placeholder="Description for survey">
                    </div>
                    <div class="form-group row">
                        <label for="inicio-date-input" class="col-2 col-form-label">Data de ínicio</label>
                        <div class="col-10">
                            <input class="form-control" @isset($survey) value="{{$survey->start_date}}" @endisset name="start_date" type="date"  id="inicio-date-input">
                        </div>
                    </div>
                    <hr>
                    <div class="form-check">
                        <input @if(isset($survey) && $survey->spotlight) checked @endif name="spotlight" type="checkbox" value="1" class="form-check-input" id="destaqueCheck">
                        <label class="form-check-label" for="destaqueCheck">Destaque</label>
                    </div>
                    <div class="form-check">
                        <input @if(isset($survey) && $survey->status) checked @endif name="status" type="checkbox" value="1" class="form-check-input" id="statusCheck">
                        <label class="form-check-label" for="statusCheck">Ativo</label>
                    </div>
                    <div class="form-check">
                        <input @if(isset($survey) && $survey->capa) checked @endif name="capa" type="checkbox" value="1" class="form-check-input" id="capaCheck">
                        <label class="form-check-label" for="capaCheck">Capa</label>
                    </div>
                    <div class="form-check">
                        <input @if(isset($survey) && $survey->inSession) checked @endif name="inSession" type="checkbox" value="1" class="form-check-input" id="inSessionCheck">
                        <label class="form-check-label" for="inSessionCheck">Estar logado para votar</label>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="fim-date-input" class="col-2 col-form-label">Data de fim</label>
                        <div class="col-10">
                            <input class="form-control" @isset($survey) value="{{$survey->finish_date}}" @endisset name="finish_date" type="date"  id="fim-date-input">
                        </div>
                    </div>
                    <div class="form-group">
                        @isset($survey)
                            <label for="descriptionFormControlInput">Adicionar opção</label>
                            <a href="{{route('options.create',$survey->id)}}" class="btn btn-info">New option</a>
                        @endisset
                    </div>
                    <div class="form-group">
                        <label for="categorySelect">Categoria</label>
                        <select name="category_id" multiple class="form-control" id="categorySelect">
                            @forelse($categories as $category)
                               @if(isset($survey) && $survey->category == $category)
                                    <option selected value="{{$category->id}}">{{$category->title}}</option>
                                @else
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endif
                            @empty
                                <option>Nenhuma categoria encontrada</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        @if(isset($survey) && !empty($survey->image))
                            <input type="file" name="image" class="form-control-file">
                            <picture>
                                <label>
                                    <img width="150px" height="150px" src="{{url('assets/uploads/surveys/'.$survey->image)}}" class="img-edit img-fluid img-thumbnail" alt="Imagem edição">
                                </label>
                            </picture>
                            <div class="form-check">
                                <input name="remove_image" type="checkbox" value="1" class="form-check-input" id="RemoveImageCheck">
                                <label class="form-check-label" for="RemoveImageCheck">Remover imagem</label>
                            </div>
                        @else
                             <label for="ImageFormControlFile">survey image</label>
                            <input type="file" name="image" class="form-control-file">
                        @endif
                        <p>Dimensão ideal Alt: 853px Larg: 1280px</p>
                    </div>
                    @if(!isset($survey))
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    @else
                        <button class="btn btn-success" type="submit">Edit</button>
                        <a href="{{route('survey.module.form.delete',$survey->id)}}" class="btn btn-danger">Delete</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
