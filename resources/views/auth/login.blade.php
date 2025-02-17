@extends('layouts.login')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="login-page">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-5">
                    <div class="card shadow">
                        <div class="card-body">
                            <h2 class="text-center">Iniciar Sesión</h2>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <p class="mb-0">{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-person"></i>
                                        </span>

                                        <input class="form-control" type="text" name="username" id="username" required
                                            autofocus placeholder="Ingrese su usuario">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-lock"></i>
                                        </span>

                                            <input class="form-control" type="password" name="password" id="password"
                                                required placeholder="Ingrese su contraseña">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                   Ingresar
                                </button>
                            </form>

                            <div class="text-center">
                                <p class="mb-0">
                                    <a href="{{ route('register') }}">Regístrate aquí</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection