<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
 <!-- Scripts -->
 
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/5qovufqekkfm6x72on94k5cryet3z5k4he1oprbdzuglbvds/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.tiny.cloud/1/5qovufqekkfm6x72on94k5cryet3z5k4he1oprbdzuglbvds/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
    
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-danger shadow-sm text-white">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="color:#fff;">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                       
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}" style="color: #fff;padding-top:15px;">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" style="color: #fff;padding-top:15px;">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        
                            <li class="nav-item dropdown">
                                <a style="padding-top:15px;color:#fff;font-weight:bold;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                   @if(Auth::check()&& Auth::user()->isadmin==1)
                                    <a class="dropdown-item" href="{{ url('auth/category') }}" >
                                    {{ __('Dashboard') }}
                                </a>
                                @else
                                  
                                        <a class="dropdown-item" href="{{ url('ads') }}" style="color:blue">
                                            <i class="fas fa-camera"  style="color:blue"></i> {{ __('Ads') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ url('messages') }}" style="color:blue">
                                            <i class="fas fa-envelope" style="color:blue"></i> {{ __('Messages') }}
                                        </a>
                                        @endif
                                  
                                    
                                    <a style="color:blue" class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                        style="color:black!important;" style="color:blue">
                                        <i class="fas fa-user-lock" style="color:blue"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!--second navbar-->
        <a href="#" id="prev" style="background-color: red;color:#fff;display:none;">PREV MENU</a>
        <a href="#" class="float-right" id="next" style="background-color: red;color:#fff;display:none;">NEXT MENU</a>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm  
        navbar-hover" id="showhideprevnext1"
        >
           
            <a class="navbar-brand" href="#">

            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHover"
                aria-controls="navbarDD" aria-expanded="false" aria-label="Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class=" collapse navbar-collapse" id="navbarHover">

                <ul class="container-fluid navbar-nav" id="slider-i" >

                    @foreach($menus as $menuItem)
                        <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle text-dark" href="{{route('category.show',$menuItem->slug)}}"
                                data-toggle="dropdown_remove_dropdown_class_for_clickable_link" arial-haspopup="true"
                                arial-expanded="false" >
                               {{$menuItem->name}}
                               
                            </a>
                            <ul class="dropdown-menu">
                               @foreach($menuItem->subcategories as $subMenuItem)
                                <li>
                                <a class="dropdown-item dropdown-toggle"
                                 href="{{route('subcategory.show',[
                                    $menuItem->slug,$subMenuItem->slug
                                ])}}">
                                    {{$subMenuItem->name}}
                                </a>
                                     
                                   
                                    <ul class="dropdown-menu">
                                       @foreach($subMenuItem->childcategories as $childMenu)
                                        <li>
                                            <a class="dropdown-item" 
                                        href="{{route('childcategory.show',[

                                            $menuItem->slug,
                                            $subMenuItem->slug,
                                            $childMenu->slug

                                        ])}}">
                                               {{$childMenu->name}} 
                                            </a>
                                           
                                        </li>
                                        @endforeach
                                        
                                    </ul>
                                
                                </li>
                                @endforeach
                                
                            </ul>
                           
                        </li>
                        @endforeach
                        
                    </ul>
            </div>
        </nav>


        <main class="py-4">
            @yield('content')
        </main>

    </div>
    
    <style>
        body{
            overflow-x: hidden;
        }
       .navbar-nav{
           height: 55px!important;
       }
        .dropdown:hover>.dropdown-menu {
            display: block;
        }

        @media only screen and(max-width:9991px) {
            .navbar-hover .show>.dropdown-toggle::after {
                transform: rotate(-90deg)
            }
        }

        @media only screen and (min-width:492px) {
            .navbar-hover .collapse ul li {
                position: relative;
            }

            .navbar-hover .collapse ul li:hover>ul {
                display: block
            }

            .navbar-hover .collapse ul ul {
                position: absolute;
                top: 100%;
                left: 0;
                min-width: 100px;
                display: none
            }

            .navbar-hover .collapse ul ul ul {
                position: absolute;
                top: 0;
                left: 100%;
                min-width: 200px;
                display: none
            }
            .navbar-nav > li{
                padding-left:3px!important;
                margin-right:3px!important;
            }
            .vertical-menu a {
            background-color: #fff;
            color: #000;
            display: block;
            padding: 12px;
            text-decoration: none;
        }

        .vertical-menu a:hover {
            background-color: #0A4D68;
            color: #fff;
        }
        .vertical-menu a.active {
            background-color: #00FFCA;
            color: #fff;
        }




    </style>

</body>

</html>
