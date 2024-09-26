<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Support Ticket') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        #sidebar.collapsed {
            width: 0;
            overflow: hidden;
            transition: width 0.3s;
        }

        #sidebar.collapsed .nav {
            display: none; 
        }
        .nav-item:hover{
            background: #dbdada;
        }

    </style>
    @yield('style')
    <!-- Scripts -->
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            @auth
                <ul class="navbar-nav me-auto">
                    <li>
                        <button class="btn btn-dark d-block" style="border:none; background:none;" id="sidebarToggle" aria-label="Toggle Sidebar">
                            <span class="text-dark" style="font-size: 30px;">☰</span>
                        </button>
                    </li>
                </ul>
            @endauth
            <div class="container">
               
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ 'Support Ticket' }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon">dfgdfgdfg</span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                       
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
                </div>
            </div>
        </nav>

        <main class="">

            <div class="container-fluid">
                <div class="row flex-nowrap">
                    @include('layouts.sidebar')
                    <div class="col py-3 m-5 mt-0">
                        <div style="min-height: 80px;" class="">
                            @include('layouts.flash-message')
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            document.getElementById('sidebarToggle').addEventListener('click', function () {
                const sidebar = document.querySelector('#sidebar');
                sidebar.classList.toggle('collapsed');
            });
            const elements = document.getElementsByClassName('mendatory');
            Array.from(elements).forEach(element => {
                element.innerHTML += `<span style="color:red;">*</span>`;
            });
        });
        
        function flashMessage(type="success",message=""){
            console.log(type);
            console.log(message);
            if(document.getElementById("alert-"+type)){
                document.getElementById("alert-"+type).classList.remove('d-none');
                document.getElementById("alert-"+type+"-message").innerHTML = message;
                setTimeout(function() {
                    document.getElementById("alert-" + type).classList.add('d-none');
                }, 3000);
            }
        }
    </script>
    @yield('script')
</body>
</html>
