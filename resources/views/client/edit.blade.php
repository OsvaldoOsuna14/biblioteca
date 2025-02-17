@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')

    <div class="container py-4">

        <div class="card">
            <div class="card-header">
                <h2 class="mb-0 text-light">
                    <i class="fas fa-user-edit me-2"></i>
                    Editar Cliente
                </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('clients.update', $client->id) }}" method="POST">
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

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{{ old('nombre', $client->nombre) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos"
                            value="{{ old('apellidos', $client->apellidos) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Email</label>
                        <input type="email" class="form-control" id="correo" name="correo"
                            value="{{ old('correo', $client->correo) }}" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection