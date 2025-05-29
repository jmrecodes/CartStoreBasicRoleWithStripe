<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            /* 02_color_palette.md & Accessibility */
            --bs-primary: #0d6efd; /* Default Bootstrap Blue - WCAG AA on white */
            --bs-primary-rgb: 13, 110, 253;
            --bs-secondary: #6c757d; /* Default Bootstrap Secondary - WCAG AA on white */
            --bs-secondary-rgb: 108, 117, 125;
            --bs-success: #198754; /* Default Bootstrap Success - WCAG AA on white */
            --bs-success-rgb: 25, 135, 84;
            --bs-danger: #dc3545; /* Default Bootstrap Danger - WCAG AA on white */
            --bs-danger-rgb: 220, 53, 69;
            --bs-warning: #ffc107; /* Default Bootstrap Warning - WCAG AA on black text */
            --bs-warning-rgb: 255, 193, 7;
            --bs-info: #0dcaf0; /* Default Bootstrap Info - WCAG AA on black text */
            --bs-info-rgb: 13, 202, 240;
            --bs-light: #f8f9fa; /* Default Bootstrap Light */
            --bs-light-rgb: 248, 249, 250;
            --bs-dark: #212529; /* Default Bootstrap Dark */
            --bs-dark-rgb: 33, 37, 41;

            --bs-body-color: #212529; /* Dark grey for text - WCAG AAA on light backgrounds */
            --bs-body-color-rgb: 33, 37, 41;
            --bs-body-bg: #ffffff; /* White background */
            --bs-body-bg-rgb: 255, 255, 255;
            
            --bs-link-color: var(--bs-primary);
            --bs-link-color-rgb: var(--bs-primary-rgb);
            --bs-link-hover-color: #0a58ca; /* Darker blue for hover */
            --bs-link-hover-color-rgb: 10, 88, 202;

            /* 03_typography_system.md */
            --bs-font-sans-serif: 'Nunito', sans-serif;
            --bs-body-font-size: 1rem; /* Base font size (16px) */
            --bs-body-line-height: 1.6; /* Ample line spacing */
            --bs-heading-color: var(--bs-dark);

            /* 04_layout_whitespace/04_00_overview.md - Spacing (base 8px, 1rem = 16px) */
            --space-xxs: 0.25rem; /* 4px */
            --space-xs: 0.5rem;   /* 8px */
            --space-sm: 0.75rem;  /* 12px */
            --space-md: 1rem;     /* 16px */
            --space-lg: 1.5rem;   /* 24px */
            --space-xl: 2rem;     /* 32px */
            --space-xxl: 3rem;    /* 48px */

            /* 08_subtle_visual_details.md */
            --border-radius-sm: 0.25rem; /* 4px */
            --border-radius-md: 0.5rem;  /* 8px */
            --border-radius-lg: 0.75rem; /* 12px */
            --border-radius-pill: 50rem;

            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-inset: inset 0 2px 4px 0 rgba(0,0,0,0.06);
        }

        body {
            font-family: var(--bs-font-sans-serif);
            font-size: var(--bs-body-font-size);
            line-height: var(--bs-body-line-height);
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--bs-heading-color);
            margin-top: var(--space-lg);
            margin-bottom: var(--space-md);
            font-weight: 600; /* Nunito semi-bold */
        }
        h1 { font-size: 2.25rem; line-height: 1.2; }
        h2 { font-size: 1.75rem; line-height: 1.25; }
        h3 { font-size: 1.5rem; line-height: 1.3; }
        
        p {
            margin-bottom: var(--space-md);
        }

        a {
            color: var(--bs-link-color);
            text-decoration: none; /* Minimalist: remove underlines unless on hover for clarity */
        }

        .navbar {
            box-shadow: var(--shadow-sm);
            padding-top: var(--space-sm);
            padding-bottom: var(--space-sm);
        }
        .nav-link {
            padding: var(--space-xs) var(--space-md);
        }
        .nav-link.active {
            font-weight: 700; /* Nunito bold */
            color: var(--bs-primary);
        }
        .dropdown-menu {
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(0,0,0,0.07);
            padding-top: var(--space-xs);
            padding-bottom: var(--space-xs);
        }
        .dropdown-item {
            padding: var(--space-xs) var(--space-md);
        }
        .dropdown-item:active {
            background-color: var(--bs-primary);
            color: #fff;
        }


        .btn {
            border-radius: var(--border-radius-sm);
            padding: var(--space-xs) var(--space-lg);
            font-weight: 600;
            transition: all 0.2s ease-in-out;
        }
        .btn-primary {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }
        .btn-primary:hover {
            background-color: var(--bs-link-hover-color); /* Using link hover for consistency */
            border-color: var(--bs-link-hover-color);
        }
         .btn-sm {
            padding: var(--space-xxs) var(--space-sm);
            font-size: 0.875rem;
            border-radius: var(--border-radius-sm); 
        }

        .form-control, .form-select {
            border-radius: var(--border-radius-sm);
            padding: var(--space-xs) var(--space-sm);
            border: 1px solid #ced4da; /* Bootstrap default */
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
        }
        .form-label {
            margin-bottom: var(--space-xs);
            font-weight: 600;
        }

        .alert {
            border-radius: var(--border-radius-md);
            padding: var(--space-md);
        }

        .card {
            border-radius: var(--border-radius-md);
            box-shadow: var(--shadow-md);
            border: none; /* Minimalist - rely on shadow */
            transition: box-shadow 0.2s ease-in-out, transform 0.2s ease-in-out;
        }
        .card:hover {
            /* Hover effect defined in product and cart views for now, can be centralized */
        }
        .card-header {
             background-color: var(--bs-light);
             border-bottom: 1px solid rgba(0,0,0,0.07);
             padding: var(--space-sm) var(--space-md);
        }
        .card-body {
            padding: var(--space-md);
        }
        .card-footer {
            background-color: var(--bs-light);
            border-top: 1px solid rgba(0,0,0,0.07);
            padding: var(--space-sm) var(--space-md);
        }

        .table {
            margin-bottom: var(--space-md);
        }
        .table th, .table td {
            padding: var(--space-sm);
            vertical-align: middle;
        }

        .badge {
            border-radius: var(--border-radius-pill);
            padding: var(--space-xxs) var(--space-xs);
            font-weight: 600;
        }

        /* Custom spacing utilities removed for simplicity, relying on Bootstrap's standard utilities. */
        /* CSS variables for spacing (--space-xs, etc.) are still available for direct use in component styles. */

    </style>
    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                @php
                    $userHomeRoute = route('home');
                    $adminBaseRoute = route('admin.users.index'); 
                    $navbarBrandRoute = Auth::check() && Auth::user()->isAdmin() ? $adminBaseRoute : $userHomeRoute;
                @endphp
                <a class="navbar-brand fw-bold" href="{{ $navbarBrandRoute }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') && !(Auth::check() && Auth::user()->isAdmin()) ? 'active' : '' }}" href="{{ $userHomeRoute }}">{{ __('Store Home') }}</a>
                        </li>
                        @if(Auth::check() && Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.index') || request()->routeIs('admin.users.create') || request()->routeIs('admin.users.edit') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">{{ __('Manage Users') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.products.index') || request()->routeIs('admin.products.create') || request()->routeIs('admin.products.edit') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">{{ __('Manage Products') }}</a>
                            </li>
                        @elseif(Auth::check())
                            {{-- Links for logged-in non-admin users --}}
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto mb-2 mb-md-0">
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
                            @if (!Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}" href="{{ route('cart.index') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart me-1" viewBox="0 0 16 16">
                                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        <span style="position:relative; display:inline-block;">
                                            {{ __('Cart') }}
                                            <x-cart-count />
                                        </span>
                                    </a>
                                </li>
                            @endif
                            
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