@extends('template.site_template')

@section('content')
   <div class="content">
        <div class="row">
            <div class="offset-md-4 col-md-4 col-sm-12">
               <div class="row">
                   <div class="col-12">
                        @if ($errors->any())
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                   </div>
               </div>
                <div style="height: 330px" class="card-login">
                    <div class="row">
                        <div class="col-12">
                            <div class="small alert alert-info">A senha de acesso será enviada para seu email.</div>
                        </div>

                    </div>
                    <form method="POST" action="{{route('site.store')}}">
                        @csrf
                        <div class="form-group  row">
                             <div class="col-sm-10">
                                 <input type="text" placeholder="Nome completo" name="name" class="form-control" id="inputname">
                             </div>
                         </div>
                        <div class="form-group  row">
                            <div class="col-sm-10">
                                <input type="email" placeholder="Email" name="email" class="form-control" id="inputEmail">
                            </div>
                        </div>
                        <div class="form-group  row">
                             <div class="col-sm-10">
                                <input type="email" placeholder="Confirme o email" name="emailConfirmed" class="form-control" id="inputEmailConfirmed">
                             </div>
                         </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   </div>
@endsection
