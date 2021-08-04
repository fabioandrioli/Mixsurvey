@extends('template.site_template')
@section('content')
    <div class="row">
        <div class=" col-md-8 col-sm-12">
            @yield('showSurveis')
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="widget">
                <div class="widget-left">
                    <div class="title">Destaques</div>
                    <hr/>
                    @forelse($destaques as $survey)
                        <div class="card-widget">
                            @if(empty($survey->image))
                                <img class="card-img-top img-thumbnail" src="{{url('assets/uploads/defaults/img_default.png')}}" alt="Card image cap">
                            @else
                                <img class="card-img-top img-thumbnail" src="{{url('assets/uploads/surveys/'.$survey->image)}}" alt="Card image cap">
                            @endif
                            <a href="{{route('site.show',$survey->slug)}}">{{$survey->title}}</a>
                            <div class="clear"></div>
                        </div>
                    @empty
                        <h1>Nenhuma foi votada.</h1>
                    @endforelse
                </div>
                <section class="newsletter">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="content">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if(session()->has('msg'))
                                        <div class="alert alert-success">
                                            {{ session()->get('msg') }}
                                        </div>
                                    @endif
                                    <form action="{{route('letters.store')}}" method="POST">
                                        @csrf
                                        <h5>Cadastre seu email e receba nossas notícias</h5>
                                        <div class="input-group">
                                            <input type="email" name="email" class="form-control" placeholder="Endereço de email">
                                            <span class="input-group-btn">
                                                <button class="btn" type="submit">Inscrever-se agora!</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div style="background-color: #354e4e" class="widget-left">
                    <div class="title">Mais Votadas</div>
                    <hr/>
                    @forelse($optionsMostVoted as $option)
                        <div class="card-widget">
                            @if(empty($survey->image))
                                <img class="card-img-top img-thumbnail" src="{{url('assets/uploads/defaults/img_default.png')}}" alt="Card image cap">
                            @else
                                <img class="card-img-top img-thumbnail" src="{{url('assets/uploads/surveys/'.$survey->image)}}" alt="Card image cap">
                            @endif
                            <a href="{{route('site.show',$option->survey->slug)}}">{{$option->survey->title}}</a>
                            <div class="clear"></div>
                        </div>
                    @empty
                        <h1>Nenhuma foi votada.</h1>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
