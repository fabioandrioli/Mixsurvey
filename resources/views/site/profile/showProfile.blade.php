@extends('dashboard.dashboard')
@section('dashboard')
     <div class="row">
        <div class="col-sm-12 offset-md-2 col-md-8">
            <div class="profile">
                <div class="showCenter">
                    <img src="{{url('assets/profile/user.png')}}" alt="">
                    <h4>{{Auth()->user()->name}}</h4>
                </div>
                <div class="showCenter">
                    <p>Email: {{Auth()->user()->email}}</p>
                </div>
                <div class="showCenter" style="width: 100%">
                    <ul>
                        <li><a href="{{route('guest.edit')}}">Editar perfil</a></li>
                        <li><a href="{{route('guest.editPassword')}}">Alterar a senha</a></li>
                        <li><a href="{{route('guest.showSurveyProfile')}}">Enquetes com meu voto</a></li>
                    </ul>
                </div>
                <div class="profile_edits">
                    @yield('profile')
                </div>
                <a href="{{URL::previous()}}" class="btn btn-info">Voltar</a>
            </div>
        </div>
     </div>
@endsection
