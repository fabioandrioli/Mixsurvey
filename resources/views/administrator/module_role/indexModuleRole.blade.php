@extends('dashboard.dashboard')
@section('dashboard')
    <div class="content">
        <div class="row">
            <div class="col-6">
                <a href="{{route('roles.create')}}" class="btn_register_user_index btn btn-info">Cadastrar</a>
            </div>
            <div class="col-6">
                <nav class="navbar">
                    <form class="form-inline" method="POST" action="{{route('roles.index')}}">
                        @csrf
                        <input class="form-control mr-sm-2" name="searchIndexModuleRole" type="search" placeholder="Search role" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>roles</h3>
            </div>
        </div>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">User number</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            @forelse($roles as $role)
                <tr>
                    <th scope="row">{{$role->id}}</th>
                    <td><a class="edit_user_module_index" href="{{route('roles.edit',$role->id)}}"><div class="edit_label"><i class="btn btn-info fa fa-pencil"></i></div>  {{$role->title}}</a></td>
                    <td><div class="edit_label"></div>{{$role->description}}</td>
                    <td><a href="{{route('roles.show',$role->id)}}" class="badge badge-dark">{{$role->users->count()}}</a></td>
                    <td><a class="edit_user_module_index" href="{{route('roles.edit',$role->id)}}"><i class="btn btn-info fa fa-pencil"></i></a></td>
                    <td><a href="{{route('role.module.form.delete',$role->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
            @empty
                <td>Nenhuma enquete econtrada.</td>
            @endforelse
            </tbody>
        </table>
        {{$roles->links()}}
    </div>
@endsection
