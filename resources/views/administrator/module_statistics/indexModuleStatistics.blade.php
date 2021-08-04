@extends('dashboard.dashboard')
@section('dashboard')
    <div class="row">
        <div class="col-md-3 offset-sm-2 col-sm-6">
            <div class="panel_statistics">
               <div style="float:left;display:inline-block;">
                    <i class="fa fa-users fa-4x"></i>
               </div>
               <div style="float: right;display:inline-block;">
                   <h4>Usuários totais.</h4>
                   <h4 style="text-align:center">{{$countUser}}</h4>
               </div>
               <div class="clear"></div>
            </div>
        </div>
        <div class="col-md-3 offset-sm-2 col-sm-6">
            <div class="panel_statistics" style="background: #428a71">
               <div style="float:left;display:inline-block;">
                    <i class="fa fa-users fa-4x"></i>
               </div>
               <div style="float: right;display:inline-block;">
                   <h4>Convidados</h4>
                   <h4 style="text-align:center">{{$userGuestCount}}</h4>
               </div>
               <div class="clear"></div>
            </div>
        </div>
        <div class="col-md-3 offset-sm-2 col-sm-6">
            <div class="panel_statistics" style="background: rgb(191, 91, 91);">
               <div style="float:left;display:inline-block;">
                    <i class="fa fa-users fa-4x"></i>
               </div>
               <div style="float: right;display:inline-block;">
                   <h4>Administradores</h4>
                   <h4 style="text-align:center">{{$userAdministratorCount}}</h4>
               </div>
               <div class="clear"></div>
            </div>
        </div>

        <div class="col-md-3 offset-sm-2 col-sm-6">
            <div class="panel_statistics" style="background: rgb(191, 91, 91);">
                <div style="float:left;display:inline-block;">
                        <i class="fa fa-users fa-4x"></i>
                </div>
                <div style="float: right;display:inline-block;">
                    <h4>Newsletters</h4>
                    <h4 style="text-align:center">{{$letterCount}}</h4>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div id="chart" style="height: 300px;width:100%;">
                {!! $chart->container() !!}
             </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div  id="chart" style="height: 300px;width:100%;">
                {!! $categoryChart->container() !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="offset-md-2 col-md-8 col-sm-12">
            <div id="chart" style="height: 300px;width:100%;">
                {!! $chartSurvey->container() !!}
            </div>
        </div>
    </div>
@endsection

