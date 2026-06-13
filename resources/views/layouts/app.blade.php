<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jejak Karya') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,500,600,700,800" rel="stylesheet">

    <!-- Design System Styles (Pastel Blue & Modern Minimalist) -->
    <style>
        :root {
            --pastel-bg: #f0f4ff;
            --pastel-card: #ffffff;
            --pastel-primary: #3b82f6;
            --pastel-primary-hover: #2563eb;
            --pastel-primary-light: #eff6ff;
            --pastel-text: #334155;
            --pastel-text-light: #64748b;
            --pastel-border: #e2e8f0;
            --radius-lg: 16px;
            --radius-md: 10px;
            --shadow-sm: 0 2px 10px rgba(59, 130, 246, 0.05);
            --shadow-soft: 0 4px 24px rgba(0, 0, 0, 0.03);
            --shadow-hover: 0 10px 30px rgba(59, 130, 246, 0.08);
            --transition: all 0.2s ease-in-out;
        }
        
        body {
            background-color: var(--pastel-bg) !important;
            color: var(--pastel-text);
            font-family: 'Nunito', 'Segoe UI', system-ui, sans-serif;
            letter-spacing: 0.2px;
        }

        /* Navbar Styling - Clean, High Contrast but not over-the-top */
        .navbar {
            background-color: #ffffff !important;
            box-shadow: var(--shadow-sm);
            border-bottom: 1px solid var(--pastel-border);
            padding: 1rem 0;
        }
        .navbar-brand {
            font-weight: 800;
            color: var(--pastel-primary) !important;
            font-size: 1.35rem;
            letter-spacing: -0.5px;
        }
        .nav-link {
            font-weight: 600;
            color: var(--pastel-text-light) !important;
            padding: 0.5rem 1rem !important;
            margin: 0 0.2rem;
            border-radius: 8px;
            transition: var(--transition);
        }
        .nav-link:hover, .nav-link.active {
            color: var(--pastel-primary) !important;
            background-color: var(--pastel-primary-light);
        }

        /* Dropdown Styling */
        .dropdown-menu {
            border: 1px solid var(--pastel-border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-hover);
            padding: 0.5rem;
            margin-top: 0.5rem;
        }
        .dropdown-item {
            border-radius: 6px;
            font-weight: 500;
            color: var(--pastel-text);
            padding: 0.5rem 1rem;
            transition: var(--transition);
        }
        .dropdown-item:hover {
            background-color: var(--pastel-primary-light);
            color: var(--pastel-primary);
        }

        /* Content spacing */
        main {
            min-height: calc(100vh - 80px);
        }

        /* Reusable Card & Input Overrides for internal pages */
        /* These are fallback styles if specific views don't override them */
        .card {
            border: 1px solid rgba(0,0,0,0.03);
            border-radius: var(--radius-lg);
            background-color: var(--pastel-card);
            box-shadow: var(--shadow-soft);
        }
        .btn-primary {
            background-color: var(--pastel-primary);
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            transition: var(--transition);
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--pastel-primary-hover);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }
        .form-control, .form-select {
            border-radius: var(--radius-md);
            border: 1px solid var(--pastel-border);
            padding: 0.75rem 1rem;
            background-color: #f8fafc;
            color: var(--pastel-text);
        }
        .form-control:focus, .form-select:focus {
            background-color: #fff;
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Jejak Karya') }}
                </a>
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.categories.index') }}">Kategori Lomba</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.competitions.index') }}">Info Lomba Rekomendasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.verifications.index') }}">Validasi Sertifikat & Arsip</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.submissions.index') }}">Lapor Progres Lomba</a>
                                </li>
                            @endif
                        @endauth
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
                                <li class="nav-item ms-md-2">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Daftar Baru') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end border-0" aria-labelledby="navbarDropdown">
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
</body>
</html>
