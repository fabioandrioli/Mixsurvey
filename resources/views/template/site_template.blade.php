@inject('categories','App\Category')
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Mixsurvey</title>
        <link rel="shortcut icon" href="{{url('assets/logo/a.png')}}"  type="image/png" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="{{ asset('css/siteIndexBody.css') }}">

        @yield('templateStyle')
    </head>
    <body>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <div id="app">
            <nav style="font-family: 'Bebas Neue', cursive;font-size:18pt" class="navbar navbar-expand-lg navbar-light bg-light">
                <a style="font-size: 24pt" class="navbar-brand" href="{{route('site.index')}}"> <img src="{{ asset('assets/logo//a.png') }}"> Mixsurvey</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site.index')}}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categorias
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @forelse($categories->all() as $category)
                            <a class="dropdown-item" href="{{route('site.category',$category->slug)}}">{{$category->title}}</a>
                            @empty
                                <a class="dropdown-item">Nenhuma categoria encontrada.</a>
                            @endforelse
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site.aboutUs')}}">Sobre nós</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('site.contacts')}}">Contato</a>
                    </li>
                    @if(Auth::check())
                        @canany(['Webmaster','Administrador'])
                            <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Dashboard</a></li>
                        @endcanany
                    @endif
                </ul>
                <form class="form-inline my-2 my-lg-0" method="POST" action="{{route('site.search.index')}}">
                    @csrf
                    <input class="form-control mr-sm-2" name="searchNavbar" type="search" placeholder="Buscar" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
                @guest
                    <a style="margin-left:2px" href="{{route('site.create')}}" class="btn btn-outline-info my-2 my-sm-0" >Cadastrar-se</a>
                    <a style="margin-left:2px" href="{{route('site.login')}}" class="btn btn-outline-info my-2 my-sm-0" >Login</a>
                @else
                    <a style="margin-left:2px" href="{{route('guest.index')}}" class="btn btn-outline-info my-2 my-sm-0" ><i class="fa fa-user"></i> Meu perfil</a>
                    <a style="margin-left:2px" href="{{route('logout')}}" class="btn btn-outline-info my-2 my-sm-0" >Sair</a>
                @endguest
                </div> <!-- collapse navbar-collapse -->
            </nav> <!-- navbar navbar-expand-lg navbar-light bg-light -->
            <div style="position: relative" class="card-body">
                @yield('content')
            </div>
            <footer class="footer">
               <div class="content">
                    <div class="offset-md-2 col-md-6 col-sm-12">
                        ₢ Todos os direitos reservados.
                    </div>
               </div>
            </footer>
          <!-- Scripts -->
        </div>
        @isset($chart)
            {!! $chart->script() !!}
        @endisset
        @isset($categoryChart)
            {!! $categoryChart->script() !!}
        @endisset
        @isset($chartSurvey)
            {!! $chartSurvey->script() !!}
        @endisset

          <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>
