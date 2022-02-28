<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<title>@hasSection('title') @yield('title') | @endif {{ config('app.name', "O'Briens") }}
</title>
<link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
{{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}

<style>
    /* Absolute Center Spinner */
    .loading {
        position: fixed;
        z-index: 9999;
        height: 2em;
        width: 2em;
        overflow: show;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }

    /* Transparent Overlay */
    .loading:before {
        content: '';
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));

        background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
    }

    /* :not(:required) hides these rules from IE9 and below */
    .loading:not(:required) {
        /* hide "loading..." text */
        font: 0/0 a;
        color: transparent;
        text-shadow: none;
        background-color: transparent;
        border: 0;
    }

    .loading:not(:required):after {
        content: '';
        display: block;
        font-size: 10px;
        width: 1em;
        height: 1em;
        margin-top: -0.5em;
        -webkit-animation: spinner 150ms infinite linear;
        -moz-animation: spinner 150ms infinite linear;
        -ms-animation: spinner 150ms infinite linear;
        -o-animation: spinner 150ms infinite linear;
        animation: spinner 150ms infinite linear;
        border-radius: 0.5em;
        -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
    }

    /* Animation */

    @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-moz-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-o-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    body {
        background-image: url('{{ asset('images/pattern.svg') }}');
    }

</style>
@livewireStyles

</head>

<body>
<div class="wrapper">
    <!-- Sidebar  -->


    <nav id="sidebar">
        <div class="sidebar-header" style="background-color: rgb(255, 159, 159)">
            <h3><img src="{{ asset('images/logo.png') }}" width="200px"></h3>
        </div>
        <ul class="navbar-nav ml-auto mt-2">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link aobrien {{ Request::is('login*') ? 'active' : '' }}"
                            href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                {{-- @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link aobrien {{ Request::is('register*') ? 'active' : '' }}"
                            href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif --}}
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle aobrien" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                        style="word-wrap: break-word;white-space: unset;">
                        {{ Auth::user()->email }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item logout" href="{{ route('profile') }}">
                            {{ __('Profile') }}
                        </a>
                        <a class="dropdown-item logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
        <br>
        @auth()
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item">
                    <a href="{{ url('/') }}"
                        class="nav-link aobrien {{ Request::is('/*') ? 'active' : '' }}">Home</a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/survey') }}"
                        class="nav-link aobrien {{ Request::is('survey*') || Request::is('survey*') ? 'active' : '' }}">Survey</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/tracerstudy') }}"
                        class="nav-link aobrien {{ Request::is('tracerstudy*') || Request::is('tracerstudy*') ? 'active' : '' }}">Tracer
                        Study</a>
                </li>
            </ul>
        @endauth()

        <!-- Right Side Of Navbar -->

    </nav>

    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light ">
            {{-- <div class="container"> --}}

            <button type="button" id="sidebarCollapse" class="btn btn-danger">
                <i class="bi bi-grid-3x3-gap"></i>
            </button>
            <div class="topnav-centered">
            <h4>@hasSection('title') @yield('title') @endif
            </h4>
        </div>

        {{-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button> --}}
        {{-- <span class="align-middle">@hasSection('title') @yield('title') @endif</span> --}}
        {{-- </div> --}}
    </nav>
    <main class="py-5 px-5 mx-5">

        @yield('content')

    </main>
</div>
</div>
{{-- <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @auth()
                    <ul class="navbar-nav mr-auto">
                        <!--Nav Bar Hooks - Do not delete!!-->
						<li class="nav-item">
                            <a href="{{ url('/surveyanswered') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Surveyanswered</a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/lecturers') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Lecturers</a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/lecturers') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Lecturers</a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/administration2') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Administration2</a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/intake2') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Intake2</a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/parentprofile') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Parentprofile</a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/administration') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Administration</a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/admin') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Admin</a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/students') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Students</a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/intake') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Intake</a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/institution') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Institution</a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/prospects') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Prospects</a>
                        </li>
						<li class="nav-item">
                            <a href="{{ url('/Accommodation') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Accommodation</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/studentdocs') }}" class="nav-link"><i
                                    class="fab fa-laravel text-info"></i> Studentdocs</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/academicterms') }}" class="nav-link">Academicterms</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/alumnis') }}" class="nav-link">
                                Alumnis</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/addresses') }}" class="nav-link">
                                Addresses</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/subjects') }}" class="nav-link">
                                Subjects</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/applications') }}" class="nav-link"> Applications</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/programmes') }}" class="nav-link">
                                Programmes</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/campuses') }}" class="nav-link">
                                Campuses</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/studentprofiles') }}" class="nav-link"> Studentprofiles</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/examresults') }}" class="nav-link"> Examresults</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/officialdocs') }}" class="nav-link"> Officialdocs</a>
                        </li>
                    </ul>
                @endauth()

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-2">
        @yield('content')

    </main>
</div> --}}
@livewireScripts
<script>
    window.livewire_app_url = 'https://oba-m.com.my/student';
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    function toastrsuccess(message) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "0",
            "hideDuration": "0",
            "timeOut": "2500",
            "extendedTimeOut": "0",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"

        }
        toastr.success(message);
    }

    function toastrerror(message) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "0",
            "hideDuration": "0",
            "timeOut": "2500",
            "extendedTimeOut": "0",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        toastr.error(message);
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
    window.livewire.on('closeModal', () => {
        $('#exampleModal').modal('hide');

    });
    window.livewire.on('closeModalSurvey', () => {
        // const container = document.getElementById("surveymodal");
        // const modal = new bootstrap.Modal(container);

        // modal.hide();
        $('#surveymodal').hide();
        $(".modal-backdrop ").remove();
    });
</script>
</body>

</html>
