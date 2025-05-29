<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Custom CSS will be linked here or styles embedded --}}
    <style>
        /* Define CSS variables based on Bootstrap's theme or custom values */
        :root {
            --bs-primary: #007bff; /* Example, assuming Bootstrap's default blue */
            --bs-secondary: #6c757d;
            --bs-success: #28a745;
            --bs-danger: #dc3545;
            --bs-warning: #ffc107;
            --bs-info: #17a2b8;
            --bs-light: #f8f9fa;
            --bs-dark: #343a40;
            --bs-body-color: #212529;
            --bs-body-bg: #ffffff;
            --bs-font-sans-serif: 'Nunito', sans-serif; /* Align with Laravel's default */
            --bs-link-color: var(--bs-primary);
            --bs-link-hover-color: darkblue; /* Example, can be refined */

            /* Spacing variables (can be used for margins, paddings if not using Bootstrap classes directly) */
            --space-1: 0.25rem; /* 4px if base is 16px */
            --space-2: 0.5rem;  /* 8px */
            --space-3: 1rem;    /* 16px */
            --space-4: 1.5rem;  /* 24px */
            --space-5: 3rem;    /* 48px */
        }

        body {
            font-family: var(--bs-font-sans-serif);
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            /* Ample whitespace via Bootstrap's default body margins or custom ones */
        }

        /* Minimalist aesthetic: Avoid unnecessary rounded corners globally unless part of Bootstrap's components */
        /* Example: .card, .btn { border-radius: 0; } -- if strict no-rounded-corners is desired */

        /* Navigation styling can be further refined here based on 05_03_navigation.md */
        .navbar {
            /* Adhere to layout/whitespace for padding/margins if customizing beyond BS defaults */
        }
        .nav-link {
            /* color: var(--bs-link-color); Using Bootstrap's default nav link color is fine */
        }
        .nav-link:hover, .nav-link:focus {
            /* color: var(--bs-link-hover-color); */
        }
        .nav-link.active {
            /* font-weight: bold; As per 05_03_navigation.md */
        }

        /* Button styling - Bootstrap classes will handle most, but focus can be enhanced if needed */
        .btn:focus {
            /* box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25); Bootstrap default is good */
        }

        /* Form styling - Bootstrap classes will handle most */
        .form-control:focus {
            /* border-color: var(--bs-primary); */
            /* box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25); Bootstrap default is good */
        }
        .form-label {
            /* margin-bottom: var(--space-1); Spacing for labels */
        }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>
                        {{-- Product link can be added here later --}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">{{ __('Sign In') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}" href="{{ route('cart.index') }}">{{ __('Cart') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item {{ request()->routeIs('profile.show') ? 'active' : '' }}" href="{{ route('profile.show') }}">
                                        {{ __('My Profile') }}
                                    </a>
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html> 