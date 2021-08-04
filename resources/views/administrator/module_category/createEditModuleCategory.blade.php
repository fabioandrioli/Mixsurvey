@extends('dashboard.dashboard')
@section('dashboard')
    <div class="content">
        <div class="row">
            <div class="offset-md-2 col-md-8  col-sm-12 myCard">
                <div class="row">
                    <div class="col-12">
                        @if(!isset($category))
                            <h1>Create Category</h1>
                        @else
                             <h1>Edit Category</h1>
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
                @if(!isset($category))
                <form action="{{route('category.store')}}" method="POST">
                @else
                <form action="{{route('categories.update',$category->id)}}" method="POST">
                    {{method_field('PUT')}}
                @endif
                    @csrf
                    <div class="form-group">
                        <label for="titleFormControlInput">Title</label>
                        <input type="text" name="title" value="{{$category->title ?? ''}}" class="form-control" id="titleFormControlInput" placeholder="title this category">
                    </div>
                    <div class="form-group">
                        <label for="descriptionFormControlInput">Description</label>
                        <input type="text" name="description" value="{{$category->description ?? ''}}" class="form-control" id="descriptionFormControlInput" placeholder="Description for category">
                    </div>
                    <hr>
                     <div class="form-check">
                        <input  @if(isset($category) && $category->spotlight) checked @endif type="checkbox" value="1" class="form-check-input" id="destaqueCheck">
                        <label class="form-check-label" for="destaqueCheck">Destaque</label>
                      </div>
                      <hr>
                    <div class="form-group">
                        <label for="ImageFormControlFile">category image</label>
                        <input type="file" name="image" class="form-control-file" id="ImageFormControlFile">
                    </div>
                    @if(!isset($category))
                        <button class="btn btn-success" type="submit">Cadastrar</button>
                    @else
                        <button class="btn btn-success" type="submit">Edit</button>
                        <a href="{{route('category.module.form.delete',$category->id)}}" class="btn btn-danger">Delete</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
