
@extends('site.user_guest.index')
@section('showSurveis')
    <div  class="row offset-md-4 col-md-8 col-sm-12">
        <div  class="card_show_survey">
            @if(empty($survey->image))
                <img class="card-img-top img-thumbnail" src="{{url('assets/uploads/defaults/img_default.png')}}" alt="Card image cap">
            @else
                <img class="card-img-top img-thumbnail" src="{{url('assets/uploads/surveys/'.$survey->image)}}" alt="Card image cap">
            @endif
            <div  class="card-body">
                <h5 class="card-title">
                    {{$survey->title}}
                </h5>
                    <p style="font-family: 'Supermercado One', cursive;font-size:14pt" class="card-text">{{$survey->description}}</p>
                    <div>
                    @if(\Carbon\Carbon::parse($survey->start_date)->format('Y-m-d') <= \Carbon\Carbon::now()->format('Y-m-d') && \Carbon\Carbon::parse($survey->finish_date)->format('Y-m-d')  >= \Carbon\Carbon::now()->format('Y-m-d'))
                        @if(Auth::check())
                            @if(!Auth::user()->surveys->contains('id',$survey->id) && !$survey->inSession)
                                <vote-option-component :session="false"  :survey_id="{{$survey->id}}" :options="{{$survey->getOption()}}"></vote-option-component>
                            @elseif(!Auth::user()->surveys->contains('id',$survey->id)  && $survey->inSession)
                                <vote-option-component :session="true" :survey_id="{{$survey->id}}" :options="{{$survey->getOption()}}"></vote-option-component>
                            @else
                                <show-results-component :session="false" :options="{{$survey->options}}" :surveyid="{{$survey->id}}" ></show-results-component>
                                <small style="margim-bottom:30px" class="alert alert-success">eu voto:
                                    @forelse($survey->options as $option)
                                        @if(Auth::user()->options->contains('id',$option->id))
                                            <strong>{{$option->title}}</strong>
                                        @endif
                                    @empty

                                    @endforelse
                                </small>
                            @endif
                        @else
                            <vote-option-component :session="false" :survey_id="{{$survey->id}}" :options="{{$survey->getOption()}}"></vote-option-component>
                        @endif
                    @else
                         <show-results-component :options="{{$survey->options}}" :surveyid="{{$survey->id}}" ></show-results-component>
                         @if(Auth::check())
                            @if(Auth::user()->surveys->contains('id',$survey->id))
                                <small style="margim-bottom:30px" class="alert alert-success"> voto:
                                    @forelse($survey->options as $option)
                                        @if(Auth::user()->options->contains('id',$option->id))
                                            <strong>{{$option->title}}</strong>
                                        @endif
                                    @empty

                                    @endforelse
                                </small>
                            @endif
                        @endif
                    @endif
                </div>
                <!-- --->
            </div>
        </div>
    </div>
@endsection
