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
    <form action="{{route('guest.updatePassword')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="inputPassworAtual">Senha atual</label>
            <input type="password" placeholder="*********" name="oldPassword"  class="form-control" id="inputPassworAtual" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="inputPassword">Nova senha</label>
            <input type="password" name="password"  class="form-control" id="inputPassword" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="inputPasswordConfirmed">Confirme a nova senha</label>
            <input type="password" name="passwordConfirmed" class="form-control" id="inputPasswordConfirmed">
        </div>
        <button type="submit" class="btn btn-primary">Editar</button>
    </form>
</div>
@endsection

