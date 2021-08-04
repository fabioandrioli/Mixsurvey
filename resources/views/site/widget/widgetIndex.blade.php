@extends('template.site_template')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="widget">
                <div class="widget-left">
                    <div class="title">Mais votadas</div>
                    <hr/>
                    <ul>
                        <li>
                            <img class="img-responsive" src="https://via.placeholder.com/70x50">
                            <a href="">Candidatos a prefeito</a>
                        </li>
                        <hr>
                        <li>
                            <img class="img-responsive" src="https://via.placeholder.com/70x50">
                            <a href="">Candidatos a senador</a>
                        </li>
                        <hr>
                        <li>
                            <img class="img-responsive" src="https://via.placeholder.com/70x50">
                            <a href="">Candidatos a presidentes</a>
                        </li>
                        <hr>
                    </ul>
                </div>
                <div class="widget-left sidebar">
                    <div class="title">Papo - reto</div>
                    <hr/>
                    <ul>
                        @forelse($videos as $video)
                            <li>
                                <iframe width="380" height="220" src="{{$video->link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </li>
                            <hr>
                        @empty
                            <li>
                               <h1>Nenhum video cadastrado</h1>
                            </li>
                            <hr>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
           <div class="row">
            @forelse($surveis as $survey)
               <div class="col-md-6">
                    <div style="margin-bottom: 10px;" class="card" style="width: 25rem;">
                        <img class="card-img-top" src="https://via.placeholder.com/50x50" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$survey->title}}</h5>
                            <p class="card-text">{{$survey->description}}</p>
                            <a href="#" class="btn btn-primary">Votar agora</a>
                        </div>
                    </div>
               </div>
            @empty
                <h1>Nenhuma enquete encontrada.</h1>
            @endforelse
           </div>
           {{ $surveis->links() }}
        </div>
    </div>
@endsection
