
@extends('site.user_guest.index')
@section('showSurveis')
    @isset($title)
        <div class="col-12">
            <h4 class="alert alert-primary">{{$title}}</h4>
        </div>
    @endisset

    <div class="row">
        <div class="col-12">
            <div class="small alert alert-info">
                <h5>Algumas enquetes só podem ser votdadas se você estiver logado. <a href="{{route('site.create')}}">Cadastrar-se</a></h5>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-12">
                <div >
                    {{$surveis->links()}}
                </div>
            </div>
        </div>

    @forelse($surveis as $survey)
        <div class="card" style="margin-bottom: 10px;">
            @if(empty($survey->image))
                <img class="card-img-top img-thumbnail" src="{{url('assets/uploads/defaults/img_default.png')}}" alt="Card image cap">
            @else
                <img class="card-img-top img-thumbnail" src="{{url('assets/uploads/surveys/'.$survey->image)}}" alt="Card image cap">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{$survey->title}}</h5>
                <p class="card-text">{{$survey->description}}</p>
                @if(\Carbon\Carbon::parse($survey->start_date)->format('Y-m-d') <= \Carbon\Carbon::now()->format('Y-m-d') && \Carbon\Carbon::parse($survey->finish_date)->format('Y-m-d')  >= \Carbon\Carbon::now()->format('Y-m-d'))
                    <a href="{{route('site.show',$survey->slug)}}" class="btn btn-primary">Votar agora</a>
                @else
                    <a href="{{route('site.show',$survey->slug)}}" class="btn btn-primary">Ver resultado</a>
                @endif
            </div>

                @if(\Carbon\Carbon::parse($survey->start_date)->format('Y-m-d') <= \Carbon\Carbon::now()->format('Y-m-d') && \Carbon\Carbon::parse($survey->finish_date)->format('Y-m-d')  >= \Carbon\Carbon::now()->format('Y-m-d'))
                    @if($survey->inSession)
                        <div >
                            <p style="position:absolute;bottom:0;margin-bottom:0;width:100%;" class="small alert alert-success">*Precisar estar logado para votar.</p>
                        </div>
                    @endif
                @else
                        <div >
                            <p style="position:absolute;bottom:0;margin-bottom:0;width:100%;" class="small alert alert-danger">*Esta enquete ja foi encerrada.</p>
                        </div>
                @endif
        </div>
    @empty
        <h1>Nenhuma enquete encontrada.</h1>
    @endforelse
    <div class="row">
        <div class="col-12">
            <div >
                {{$surveis->links()}}
            </div>
        </div>
    </div>
@endsection
