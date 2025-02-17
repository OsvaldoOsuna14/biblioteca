<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Gestión de Biblioteca')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <header class="header navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <div class="container-fluid">
            <h1 class="navbar-brand">Biblioteca </h1>

        </div>

    </header>



    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard.index') }}">
                                <i class="bi bi-house"></i> Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('book.index') ? 'active' : '' }}" href="{{ route('book.index') }}">
                                <i class="bi bi-book"></i> Libros
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('clients.index') ? 'active' : '' }}" href="{{ route('clients.index') }}">
                                <i class="bi bi-person"></i> Clientes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('loan.index') ? 'active' : '' }}" href="{{ route('loan.index') }}">
                                <i class="bi bi-journal-text"></i> Préstamos
                            </a>
                        </li>
                        @if (auth()->user()->rol == 'administrador')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('receptionists.index') ? 'active' : '' }}" href="{{ route('receptionists.index') }}">
                                    <i class="bi bi-people"></i> Recepcionistas
                                </a>
                            </li>
                        
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>