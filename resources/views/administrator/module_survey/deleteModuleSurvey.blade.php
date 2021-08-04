@extends('dashboard.dashboard')
@section('dashboard')
  <div class="content">
      <div class="row">
          <div class="offset-md-3 col-sm-12 col-md-6">
                <div style="background-color: rgb(202, 140, 140)" class="myCard">
                    <div class="row">
                        <div class="col-12">
                            <h4>Deseja confirmar a exclusão da enquete: </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h2>{{$survey->title}}</h2>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-6">
                            <h4>data do inicio: {{$survey->start_date}}</h4>
                        </div>
                        <div class="col-6">
                            <h4>data do fim: {{$survey->finish_date}}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5>Descrição: {{$survey->description}}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="{{route('surveis.destroy',$survey->id)}}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
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
