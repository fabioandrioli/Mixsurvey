@extends('dashboard.dashboard')
@section('dashboard')
    <div class="content">
        <div class="row">
            <div class="offset-md-2 col-md-6  col-sm-12">
                <nav class="navbar">
                    @if(!isset($survey))
                        <form class="form-inline" method="POST" action="{{route('option.index')}}">
                    @else
                        <form class="form-inline" method="POST" action="{{route('survey.options.show',$survey->id)}}">
                    @endif
                            @csrf
                            <input class="form-control mr-sm-2" name="searchIndexModuleOption" type="search" placeholder="Search option" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if(isset($survey))
                    <h3>Options of survey: {{$survey->title}}</h3>
                    <a href="{{route('option.create',$survey->id)}}" class="btn btn-info">New option</a>
                @else
                    <h3>Options</h3>
                @endif
                @isset($survey)
                    @if(isset($options) && count($options) > 0)
                        @if($options[0]->survey->status)
                            Survey status <span class="badge badge-success">Ativa</span>
                        @else
                            Survey status <span class="badge badge-danger">Desligada</span>
                        @endif
                    @endif
                @endisset
            </div>
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
                    <th scope="col">Description</th>
                    @if(!isset($survey))<th scope="col">Survey name</th>@endif
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            @forelse($options as $option)
                <tr>
                    <th scope="row">{{$option->id}}</th>
                    <td>
                        @if(empty($option->image))
                            <p>Sem imagem</p>
                        @else
                            <picture>
                                <img width="150px" height="150px" src="{{url('assets/uploads/options/'.$option->image)}}" class="img-edit img-fluid img-thumbnail" alt="Imagem edição">
                            </picture>
                        @endif
                    </td>
                    <td><a class="edit_user_module_index" href="{{route('options.edit',$option->id)}}"><div class="edit_label"><i class="btn btn-info fa fa-pencil"></i></div>  {{$option->title}}</a></td>
                    <td>{{$option->description}}</td>
                    @if(!isset($survey))
                        <td>
                            <span class="badge badge-info">new option</span>
                            <a href="{{route('options.create',$option->survey->id)}}" style="color:black"> {{$option->survey->title}} </a>
                        </td>
                    @endif
                    <td><a class="edit_option_module_index" href="{{route('options.edit',$option->id)}}"><i class="btn btn-info fa fa-pencil"></i></a></td>
                    <td><a href="{{route('option.module.form.delete',$option->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
            @empty
                <td>Nenhuma opção econtrada.</td>
            @endforelse
            </tbody>
        </table>
        {{$options->links()}}
    </div>
@endsection
