{{-- Author: Emily Cardona Castañeda --}}

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', __('layout.admin_title')) — {{ __('layout.admin_brand') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            @if(Route::has('admin.index'))
                <a class="navbar-brand" href="{{ route('admin.index') }}">
                    {{ __('layout.admin_brand') }}
                </a>
            @endif

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar"
                aria-controls="adminNavbar" aria-expanded="false" aria-label="{{ __('layout.toggle_navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbar">
                <div class="navbar-nav ms-auto align-items-lg-center">
                    @if(Route::has('admin.index'))
                        <a class="nav-link" href="{{ route('admin.index') }}">{{ __('layout.admin_panel') }}</a>
                    @endif
                    @if(Route::has('admin.product.index'))
                        <a class="nav-link" href="{{ route('admin.product.index') }}">{{ __('layout.admin_products') }}</a>
                    @endif
                    @if(Route::has('admin.category.index'))
                        <a class="nav-link" href="{{ route('admin.category.index') }}">{{ __('layout.admin_categories') }}</a>
                    @endif
                    @if(Route::has('admin.service.index'))
                        <a class="nav-link" href="{{ route('admin.service.index') }}">{{ __('layout.admin_services') }}</a>
                    @endif
                    @if(Route::has('admin.order.index'))
                        <a class="nav-link" href="{{ route('admin.order.index') }}">{{ __('layout.admin_orders') }}</a>
                    @endif
                    @if(Route::has('admin.user.index'))
                        <a class="nav-link" href="{{ route('admin.user.index') }}">{{ __('layout.admin_users') }}</a>
                    @endif
                    @if(Route::has('home.index'))
                        <a class="nav-link" href="{{ route('home.index') }}">{{ __('layout.back_to_store') }}</a>
                    @endif
                    @auth
                        @if(Route::has('logout'))
                            <form method="POST" action="{{ route('logout') }}" class="d-inline ms-lg-2">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">{{ __('layout.logout') }}</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-secondary">
        <div class="container">
            <h1 class="h3">@yield('subtitle', __('layout.admin_subtitle'))</h1>
        </div>
    </header>

    <main class="container my-4 flex-grow-1">
        @if(session('success'))
            <div class="alert alert-success mb-4" role="alert">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger mb-4" role="alert">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    <footer>
        <div class="container">
            <small>{{ __('layout.footer_admin') }}</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
