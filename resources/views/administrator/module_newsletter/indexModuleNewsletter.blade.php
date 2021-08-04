@extends('dashboard.dashboard')
@section('dashboard')
    <div class="content">
        <div class="row">
            <div class="offset-md-8 col-md-4 col-sm-12">
                <nav class="navbar">
                    <form class="form-inline" method="POST" action="{{route('letter.index')}}">
                        @csrf
                        <input class="form-control mr-sm-2" name="searchIndexModuleLetter" type="search" placeholder="Search letters" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3>Newsletters</h3>
            </div>
        </div>
    </div>
    <div class="table-responsive-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">email</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            @forelse($letters as $letter)
                <tr>
                    <th scope="row">{{$letter->id}}</th>
                    <td>{{$letter->email}}</td>
                    <td><a href="{{route('letter.form.delete',$letter->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
            @empty
                <td>Nenhuma email econtrado.</td>
            @endforelse
            </tbody>
        </table>
        {{$letters->links()}}
    </div>
@endsection
