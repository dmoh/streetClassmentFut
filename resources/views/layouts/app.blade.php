<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stats City Fut') }}</title>




<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Shadows+Into+Light&display=swap" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('fontawesome-free/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/examples.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/bars-square.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- config('app.name', 'StreetClassmentFut') --}}
                    STAT FUT CITY
                   {{-- <img src="{{ asset('images/stats-fut-cityLogo2.png') }}" alt="stats fut city logo">--}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            {{--@if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdownMatch" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    MATCHS <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMatch">
                                    <a class="dropdown-item" href="{{ route('matchs.list') }}" >
                                        Liste des matchs
                                    </a>
                                    <a class="dropdown-item" href="{{ route('create.match') }}" >
                                        Organiser un match
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdownPlayer" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    JOUEURS<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPlayer">
                                    <a class="dropdown-item" href="{{ route('consultation.index' ) }}">
                                        Liste des joueurs
                                    </a>
                                    <a class="dropdown-item" href="{{ route('create.user' ) }}">
                                        Ajouter un joueur
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('consultation.showProfile', Auth::user()->id ) }}">Mon profil</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('components.alert-message')
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->

    <script src="{{ asset('js/sb-admin-2.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('select[id^="note_vote"]').barrating({
                theme: 'bars-square',
                showValues: true,
                showSelectedRating: false
            });
        });
    </script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
    @yield('script')
</body>
</html>
