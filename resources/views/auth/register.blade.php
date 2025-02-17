@extends('layouts.login')

@section('title', 'Registrarse')

@section('content')
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Registro de Usuario</h2>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p class="mb-0">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Usuario</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Correo Electrónico</label>
                                    <input type="email" name="correo" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Contraseña</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirmar Contraseña</label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Apellidos</label>
                                    <input type="text" name="apellidos" class="form-control" required>
                                </div>

                           

                                <div class="col-12 mb-4">
                                    <label class="form-label">Rol</label>
                                    <select name="rol" class="form-select" required>
                                        <option value="">Seleccione un rol</option>
                                        <option value="administrador">Administrador</option>
                                        <option value="recepcionista">Recepcionista</option>
                                        <option value="cliente">Cliente</option>
                                    </select>
                                </div>
                            </div>


                            <a href="{{ route('login') }}" class="btn btn-secondary w-100 mb-3">
                                Regresar
                            </a>
                            <button type="submit" class="btn btn-primary w-100">
                                Registrar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection