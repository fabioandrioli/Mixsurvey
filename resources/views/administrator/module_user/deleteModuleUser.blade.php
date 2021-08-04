@extends('dashboard.dashboard')
@section('dashboard')
  <div class="content">
      <div class="row">
          <div class="offset-md-3 col-sm-12 col-md-6">
                <div style="background-color: rgb(202, 140, 140)" class="myCard">
                    <div class="row">
                        <div class="col-12">
                            <h4>Deseja confirmar a exclusão do usuário: </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h2>{{$user->name}}</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="{{route('delete.module.user.with.role',$user->id)}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Excluir</button>
                                <a class="btn btn-info" href="{{ URL::previous() }}">Voltar</a>
                            </form>
                        </div>
                    </div>
                </div>
          </div>
      </div>
  </div>
@endsection
