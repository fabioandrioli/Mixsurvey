@extends('template.site_template')
@section('templateStyle')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
@section('content')
@canany(['Webmaster','Administrador'])
<nav style="font-family: 'Bebas Neue', cursive;font-size:18pt" class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('index.module.user')}}"><i class="fa fa-user fa-1x"></i> Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('categories.index')}}"><i class="fa fa-cubes fa-1x"></i> Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('surveis.index')}}"><i class="fa fa-sticky-note fa-1x"></i> Surveis</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('options.index')}}"><i class="fa fa-check-square-o fa-1x"></i> Options</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('videos.index')}}"><i class="fa fa-video-camera fa-1x"></i> Videos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('letters.index')}}"><i class="fa fa-envelope-o fa-1x"></i> Emails</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('statistics.index')}}"><i class="fa fa-bar-chart fa-1x"></i> Statistcs</a>
            </li>

            @can('Webmaster')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('roles.index')}}"><i class="fa fa-tasks fa-1x"></i> Roles</a>
                </li>
            @endcan
        </ul><!-- navbar-nav mr-auto -->
    </div> <!-- collapse navbar-collapse -->
  </nav> <!-- navbar navbar-expand-lg navbar-light bg-light -->
  @endcanany
  @yield('dashboard')
@endsection
