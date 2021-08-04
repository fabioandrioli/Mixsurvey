@extends('dashboard.dashboard')
@section('dashboard')
    <div class="content">
        <div class="row">
            <div class="col-6">
                <a href="{{route('categories.create')}}" class="btn_register_user_index btn btn-info">Cadastrar</a>
            </div>
            <div class="col-6">
                <nav class="navbar">
                    <form class="form-inline" method="POST" action="{{route('category.index')}}">
                        @csrf
                        <input class="form-control mr-sm-2" name="searchIndexModuleCategory" type="search" placeholder="Search Category" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>categories</h3>
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
                    <th scope="col">Survey number</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td><a class="edit_user_module_index" href="{{route('categories.edit',$category->id)}}"><div class="edit_label"><i class="btn btn-info fa fa-pencil"></i></div>  {{$category->title}}</a></td>
                    <td>{{$category->description}}</td>
                    <td><a href="{{route('categories.show',$category->id)}}" class="badge badge-dark">{{$category->surveis->count()}}</a></td>
                    <td><a class="edit_category_module_index" href="{{route('categories.edit',$category->id)}}"><i class="btn btn-info fa fa-pencil"></i></a></td>
                    <td><a href="{{route('category.module.form.delete',$category->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
            @empty
                <td>Nenhuma categoria econtrada.</td>
            @endforelse
            </tbody>
        </table>
        {{$categories->links()}}
    </div>
@endsection
