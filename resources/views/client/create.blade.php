@extends('layouts.app')

@section('title', 'Agregar Nuevo Cliente')

@section('content')

    <div class="container py-4">
        <div class="card-header" style="border-radius: 1rem 1rem 0 0;">
            <h2 class="mb-0 text-light">
                <i class="fas fa-user-plus me-2"></i>
                Agregar Nuevo Cliente
            </h2>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('clients.store') }}" method="POST">
                    @csrf

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
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos"
                            value="{{ old('apellidos') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Email</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo') }}"
                            required>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>

                </form>
            </div>



        </div>
    </div>



@endsection