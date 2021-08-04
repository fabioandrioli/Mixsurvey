@extends('site.profile.showProfile')
@section('profile')
    <div class="row">
        <div class="col-sm-12 offset-md-2 col-md-8">
            <div class="row">
                <div class="col-12">
                    {{$surveis->links()}}
                </div>
            </div>
            <div class="showSurveyProfile">
                <ul class="list-group list-group-flush">
                    @forelse($surveis as $survey)
                        <li><i class="fa fa-check-square-o"></i><a  href="{{route('site.show',$survey->slug)}}"> {{$survey->title}}</a></li>
                        <hr style="color:white;">
                    @empty
                        <h1>Nenhuma enquete votada</h1>
                    @endforelse
               </ul>
            </div>
            <div class="row">
                <div class="col-12">
                    {{$surveis->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
