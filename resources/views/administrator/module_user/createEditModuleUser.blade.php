@extends('dashboard.dashboard')
@section('dashboard')
    <div class="content">
        <div class="row">
            <div class="offset-md-2 col-md-6  col-sm-12 myCard">
                <div class="row">
                    <div class="col-12">
                        @if(!isset($user))
                            <h1>Create User</h1>
                        @else
                             <h1>Edit User</h1>
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
                @if(!isset($user))
                    <form action="{{route('create.module.user.with.role')}}" method="POST" enctype="multipart/form-data">
                @else
                    <form action="{{route('update.module.user.with.role',$user->id)}}" method="POST" enctype="multipart/form-data">
                        {{method_field('PUT')}}
                @endif
                    @csrf
                    <div class="form-group">
                        <label for="nameFormControlInput">Name</label>
                    <input type="text" name="name" value="{{$user->name ?? ''}}" class="form-control" id="nameFormControlInput" placeholder="name this user">
                    </div>
                    <div class="form-group">
                        <label for="emailFormControlInput">Email address</label>
                        <input type="email" name="email" value="{{$user->email ?? ''}}" class="form-control" id="emailFormControlInput" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label for="RoleFormControlSelect">Role user</label>
                        <select name="role_id" class="form-control" id="RoleFormControlSelect">
                            @if(!isset($user))
                                <option selected></option>
                            @endif
                            @forelse($roles as $role)
                                @if(isset($user) && $role->id == $user->role_id)
                                    <option selected value="{{$role->id}}">{{$user->role->title}}</option>
                                @else
                                    <option value="{{$role->id}}">{{$role->title}}</option>
                                @endif
                            @empty
                                <option>nenhuma role encontrada</option>
                            @endforelse

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ImageFormControlFile">User image</label>
                        <input type="file" name="image" class="form-control-file" id="ImageFormControlFile">
                    </div>
                    @if(!isset($user))
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    @else
                        <button class="btn btn-success" type="submit">Edit</button>
                        <a href="{{route('user.module.form.delete',$user->id)}}" class="btn btn-danger">Delete</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
