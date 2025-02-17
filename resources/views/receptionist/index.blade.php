@extends('layouts.app')

@section('title', 'Recepcionistas')

@section('content')



<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header header d-flex justify-content-between align-items-center p-4">
            <h2 class="text-light mb-0">Recepcionistas</h2>
            <a href="{{ route('receptionists.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i>
                Agregar Nuevo Recepcionista
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Correo Electrónico</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($receptionists as $receptionist)
                            <tr>
                                <td>{{ $receptionist->username }}</td>
                                <td>{{ $receptionist->nombre }}</td>
                                <td>{{ $receptionist->apellidos }}</td>
                                <td>{{ $receptionist->correo }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('receptionists.edit', $receptionist) }}" class="btn btn-sm btn-warning me-2">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('receptionists.delete', $receptionist) }}" method="POST"
                                        style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
