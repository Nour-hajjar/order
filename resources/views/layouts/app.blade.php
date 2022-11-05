<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'International Board  of professional training and Qualification') }}</title>

       <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
     @if(App::isLocale('ar'))
    <link href="{{ asset('css/a.css') }}" rel="stylesheet">

  @else
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endif

    @yield('stylesheet')
</head>
<body >


          @guest

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                        @else
        <div class="d-flex ltr" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">{{trans('app.International Board  of professional training and Qualification')}} </div>
        <div class="list-group list-group-flush">
            <a href="{{url('/')}}" class="list-group-item list-group-item-action bg-light">{{trans('app.Website')}}</a>
            <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action bg-light">{{trans('app.Categories') }}</a>
            <a href="{{ route('posts.index') }}" class="list-group-item list-group-item-action bg-light">{{trans('app.Posts') }}</a>
           
            <a href="{{ route('galleries.index') }}" class="list-group-item list-group-item-action bg-light">{{trans('app.Galleries') }}</a>
            
            <a href="{{ route('abouts.index') }}" class="list-group-item list-group-item-action bg-light">{{trans('app.About') }}</a>
           
        </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle">{{trans('app.Main Menu')}}</button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                <a class="nav-link" href="{{url('/home')}}">{{trans('app.Home')}} <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{trans('app.Dropdown Menu')}}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">





                                <a class="dropdown-item" href="{{url('/lang/en')}}">{{trans('app.En')}}</a>


                                <a class="dropdown-item" href="{{url('/lang/ar')}}"> {{trans('app.Ar')}}</a>


                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{trans('app.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>


                            @endguest

                </li>
            </ul>
            </div>
        </nav>

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>


            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

@yield('javascript')
</body>
</html>





        <script>
        jQuery(document).ready(function($){
            $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
            });
        })
        </script>
