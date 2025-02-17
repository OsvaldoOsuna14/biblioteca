@extends('layouts.app')

@section('title', 'Editar Recepcionista')

@section('content')

<div class="container py-4">
    <div class="card-header" style="border-radius: 1rem 1rem 0 0;">
        <h2 class="mb-0 text-light">
            <i class="fas fa-user-edit me-2"></i>
            Editar Recepcionista
        </h2>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('receptionists.update', $receptionist->id) }}" method="POST">
                @csrf
                @method('PUT') 
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="{{ old('username', $receptionist->username) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                               value="{{ old('nombre', $receptionist->nombre) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos"
                               value="{{ old('apellidos', $receptionist->apellidos) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo"
                               value="{{ old('correo', $receptionist->correo) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="text-muted">Deja el campo vacío si no deseas cambiar la contraseña.</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('receptionists.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
