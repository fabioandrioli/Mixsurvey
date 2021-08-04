@extends('dashboard.dashboard')
@section('dashboard')
    <div class="content">
        <div class="row">
            <div class="col-6">
                <a href="{{route('user.module.form.create')}}" class="btn_register_user_index btn btn-info">Cadastrar</a>
            </div>
            <div class="col-6">
                <nav class="navbar">
                @if(!isset($role))
                    <form class="form-inline" method="POST" action="{{route('index.module.user.search')}}">
                @else
                    <form class="form-inline" method="POST" action="{{route('role.users.show',$role->id)}}">
                @endif
                        @csrf
                        <input class="form-control mr-sm-2" name="searchIndexModuleUser" type="search" placeholder="Search User" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </nav>
            </div>
        </div>
        <div class="row">
            @if(isset($role))
                <div class="col-12">
                    <h3>Users of role: {{$role->title}}</h3>
                </div>
            @else
                <div class="col-12">
                    <h3>Users</h3>
                </div>
            @endif

        </div>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Email</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td><a class="edit_user_module_index" href="{{route('user.module.form.edit',$user->id)}}"><div class="edit_label"><i class="btn btn-info fa fa-pencil"></i></div>  {{$user->name}}</a></td>
                    <td>{{$user->role->title}}</td>
                    <td>{{$user->email}}</td>
                    <td><a class="edit_user_module_index" href="{{route('user.module.form.edit',$user->id)}}"><i class="btn btn-info fa fa-pencil"></i></a></td>
                    <td><a href="{{route('user.module.form.delete',$user->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
            @empty
                <td>Nenhum usuário econtrado.</td>
            @endforelse
            </tbody>
        </table>
        {{$users->links()}}
    </div>
@endsection
