@extends('template.site_template')
@section('content')
    <div class="contacts" class="content">
        <div class="jumbotron jumbotron-sm">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <h1 class="h1">
                            Entre em contato conosco!
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="well well-sm">
                        <form action="{{route('site.contacts.request')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="offset-md-1 col-md-4">
                                    <div class="form-group">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <label for="name">
                                            Nome</label>
                                        <input type="text" name="nome" class="form-control" id="name" placeholder="Nome completo" required="required" />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">
                                            Endereço de email</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                            </span>
                                            <input type="email" name="email" class="form-control" id="email" placeholder=" Endereço de email" required="required" /></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">
                                            Assunto</label>
                                        <select id="subject" name="assunto" class="form-control" required="required">
                                            <option value="na" selected="">Escolha um:</option>
                                            <option value="enquetes">Enquete</option>
                                            <option value="sugestao">Sugestão</option>
                                            <option value="negócios">Negócios</option>
                                            <option value="reclamacao">Reclamação</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="name">
                                            Menssagem</label>
                                        <textarea name="menssagem" id="message" class="form-control" rows="7" cols="30" required="required"
                                            placeholder="Menssagem"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                        Enivar Mensagem</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
