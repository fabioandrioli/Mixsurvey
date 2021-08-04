@extends('template.site_template')

@section('content')
   <div class="content">
        <div class="row">
            <div class="offset-md-4 col-md-4 col-sm-12">
                <div class="card-login">
                    <form method="POST" action="{{ route('site.login') }}">
                        @csrf
                        <div class="form-group  row">
                           <i class="fa fa-user fa-3x"></i>
                            <div class="col-sm-10">
                            <input type="email" placeholder="Email" name="email" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="form-group  row">
                          <i class="fa fa-lock fa-3x"></i>
                            <div class="col-sm-10">
                            <input type="password" placeholder="Senha" name="password" class="form-control" id="inputPassword3">
                            </div>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <a class="btn btn-link" href="{{ route('site.forgetPasswordForm') }}">
                            {{ __('Esqeueceu sua senha ?') }}
                        </a>
                        <div class="row">
                            <div style="margin:5px" class="col-md-12 col-sm-12">
                                <div class="g-recaptcha" style="transform:scale(0.8);transform-origin:0 0" data-sitekey="6LfmDqUZAAAAAJ93VW2055FacV4MVIdzdKyaE-ig"></div>
                            </div>
                         </div>
                         <div class="form-group form-check">
                            <input value="1" type="checkbox" class="form-check-input" id="rememberCheck">
                            <label class="form-check-label" style="color: white" for="rememberCheck">Lembrar-me</label>
                          </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   </div>
@endsection
