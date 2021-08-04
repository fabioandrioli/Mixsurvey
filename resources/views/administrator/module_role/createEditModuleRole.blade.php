@extends('dashboard.dashboard')
@section('dashboard')
    <div class="content">
        <div class="row">
            <div class="offset-md-2 col-md-6  col-sm-12 myCard">
                <div class="row">
                    <div class="col-12">
                        @if(!isset($role))
                            <h1>Create Role</h1>
                        @else
                             <h1>Edit Role</h1>
                        @endif
                    </div>
                </div>
                @if(!isset($role))
                <form action="{{route('roles.store')}}" method="POST">
                @else
                <form action="{{route('roles.update',$role->id)}}" method="POST">
                    {{method_field('PUT')}}
                @endif
                    @csrf
                    <div class="form-group">
                        <label for="titleFormControlInput">Title</label>
                    <input type="text" name="title" value="{{$role->title ?? ''}}" class="form-control" id="titleFormControlInput" placeholder="title this role">
                    </div>
                    <div class="form-group">
                        <label for="descriptionFormControlInput">Description</label>
                        <input type="text" name="description" value="{{$role->description ?? ''}}" class="form-control" id="descriptionFormControlInput" placeholder="Description for role">
                    </div>
                    @if(!isset($role))
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    @else
                        <button class="btn btn-success" type="submit">Edit</button>
                        <a href="{{route('role.module.form.delete',$role->id)}}" class="btn btn-danger">Delete</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
