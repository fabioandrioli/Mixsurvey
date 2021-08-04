@extends('dashboard.dashboard')
@section('dashboard')
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <a href="{{route('surveis.create')}}" class="btn_register_user_index btn btn-info">Cadastrar</a>
            </div>
            <div class="col-md-6 col-sm-12">
                <nav class="navbar">
                @if(!isset($category))
                    <form class="form-inline" method="POST" action="{{route('surveis.index')}}">
                @else
                    <form class="form-inline" method="POST" action="{{route('category.surveis.show',$category->id)}}">
                @endif
                    @csrf
                    <div style="margin-top: 8px" class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input  style="margin-right: 4px" name="destaque" value="1" type="checkbox" aria-label="Checkbox for following text input">
                                <span class="badge badge-info">Destaque</span>
                            </div>
                          <div class="input-group-text">
                            <input  style="margin-right: 4px" name="status[]" value="1" type="checkbox" aria-label="Checkbox for following text input">
                            <span class="badge badge-success">Ativa</span>
                          </div>
                        </div>
                      </div>
                      <div style="margin-top: 8px" class="input-group mb-3">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <input style="margin-right: 4px" name="status[]" value="0"  type="checkbox" aria-label="Checkbox for following text input">
                            <span class="badge badge-danger">Inativo</span>
                          </div>
                        </div>
                      </div>
                      <div style="margin-left:5px">
                        <input class="form-control mr-sm-2" name="searchIndexModuleSurvey" type="search" placeholder="Search Survey" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                      </div>
                    </form>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if(isset($category))
                    <h3>Surveis of category: {{$category->title}}</h3>
                @else
                    <h3>Surveis</h3>
                @endif
            </div>
        </div>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">New option</th>
                    <th scope="col">Options</th>
                    <th scope="col">Start</th>
                    <th scope="col">Finish</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            @forelse($surveis as $survey)
                <tr>
                    <th scope="row">{{$survey->id}}</th>
                    <td>
                        @if(empty($survey->image))
                            <p>Sem imagem</p>
                        @else
                            <picture>
                                <img width="150px" height="150px" src="{{url('assets/uploads/surveys/'.$survey->image)}}" class="img-edit img-fluid img-thumbnail" alt="Imagem edição">
                            </picture>
                        @endif
                    </td>
                    <td>
                        <a class="edit_user_module_index" href="{{route('surveis.edit',$survey->id)}}"><div class="edit_label"><i class="btn btn-info fa fa-pencil"></i></div>
                            {{$survey->title}}
                            @if($survey->status)
                                <span class="badge badge-success">Ativa</span>
                            @else
                                <span class="badge badge-danger">Desligada</span>
                            @endif
                            @if($survey->spotlight)
                                <span class="badge badge-info">Destaque</span>
                            @endif
                            @if($survey->capa)
                                <span class="badge badge-primary">Capa</span>
                            @endif
                            @if($survey->inSession)
                                <span class="badge badge-primary">Estar logado</span>
                            @endif
                        </a>
                    </td>
                    <td>
                        <a href="{{route('option.create',$survey->id)}}" class="btn btn-info">+</a>
                    </td>
                    <td>
                        <a href="{{route('surveis.show',$survey->id)}}" class="badge badge-dark">{{$survey->options->count()}}</a>
                    </td>
                    <td>{{Carbon\Carbon::parse($survey->start_date)->format('d/m/Y')}}</td>
                    <td>{{Carbon\Carbon::parse($survey->finish_date)->format('d/m/Y')}}</td>
                    <td><a class="edit_survey_module_index" href="{{route('surveis.edit',$survey->id)}}"><i class="btn btn-info fa fa-pencil"></i></a></td>
                    <td><a href="{{route('survey.module.form.delete',$survey->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
            @empty
                <td>Nenhuma enquete econtrada.</td>
            @endforelse
            </tbody>
        </table>
        {{$surveis->links()}}
    </div>
@endsection
