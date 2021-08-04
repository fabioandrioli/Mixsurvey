@extends('site.profile.showProfile')
@section('profile')
<div style="margin-bottom: 10px" class="content">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('guest.update')}}" method="POST">
         @csrf
        <div class="form-group">
            <label for="inputName">Nome</label>
            <input type="text" value={{Auth()->user()->name}} name="name" class="form-control" id="inputName" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" value={{Auth()->user()->email}} name="email" class="form-control" id="inputEmail">
        </div>
        <div class="form-group">
            <label for="inputEmail">Confirme email</label>
            <input type="email" value={{Auth()->user()->email}} name="emailConfirmed" class="form-control" id="inputEmail">
        </div>
        <button type="submit" class="btn btn-primary">Editar</button>
    </form>
</div>
@endsection

