<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Buy And Sell') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.tiny.cloud/1/5qovufqekkfm6x72on94k5cryet3z5k4he1oprbdzuglbvds/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.tinymce && document.querySelector('#mytextarea')) {
                window.tinymce.init({
                    selector: '#mytextarea',
                    height: 320,
                    menubar: false,
                    plugins: 'lists link image preview code',
                    toolbar: 'undo redo | bold italic | bullist numlist | link image | preview code'
                });
            }
        });
    </script>
</head>

<body>
    <div id="app" class="market-shell">
        <nav class="navbar navbar-expand-md navbar-dark market-topbar">
            <div class="container">
                <a class="navbar-brand market-brand" href="{{ url('/') }}">
                    <span class="market-brand-mark"><i class="fas fa-store"></i></span>
                    <span>{{ config('app.name', 'Buy And Sell') }}</span>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto align-items-md-center">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item ml-md-2">
                                    <a class="btn btn-light btn-sm px-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle mr-1"></i>{{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->isadmin == 1)
                                        <a class="dropdown-item" href="{{ url('auth/category') }}">
                                            <i class="fas fa-chart-line mr-2"></i>{{ __('Dashboard') }}
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('ads.index') }}">
                                            <i class="fas fa-camera mr-2"></i>{{ __('Ads') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('messages') }}">
                                            <i class="fas fa-envelope mr-2"></i>{{ __('Messages') }}
                                        </a>
                                    @endif

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-user-lock mr-2"></i>{{ __('Logout') }}
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

        <nav class="navbar navbar-expand-lg navbar-light market-nav sticky-top">
            <div class="container">
                <a class="navbar-brand d-lg-none font-weight-bold" href="{{ url('/') }}">Browse</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHover"
                    aria-controls="navbarHover" aria-expanded="false" aria-label="Category navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarHover">
                    <ul class="navbar-nav flex-wrap">
                        @foreach ($menus as $menuItem)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{ route('category.show', $menuItem->slug) }}"
                                    id="categoryDropdown{{ $menuItem->id }}" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{ $menuItem->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="categoryDropdown{{ $menuItem->id }}">
                                    <a class="dropdown-item" href="{{ route('category.show', $menuItem->slug) }}">
                                        View all {{ $menuItem->name }}
                                    </a>

                                    @foreach ($menuItem->subcategories as $subMenuItem)
                                        <div class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle"
                                                href="{{ route('subcategory.show', [$menuItem->slug, $subMenuItem->slug]) }}">
                                                {{ $subMenuItem->name }}
                                            </a>

                                            @if ($subMenuItem->childcategories->count())
                                                <div class="dropdown-menu">
                                                    @foreach ($subMenuItem->childcategories as $childMenu)
                                                        <a class="dropdown-item"
                                                            href="{{ route('childcategory.show', [$menuItem->slug, $subMenuItem->slug, $childMenu->slug]) }}">
                                                            {{ $childMenu->name }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>

        <main class="market-main py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
