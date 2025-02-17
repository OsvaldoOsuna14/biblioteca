@extends('layouts.app')

@section('title', 'Clientes')

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
                <h2 class="text-light
                mb-0">Clientes</h2>
                <a href="{{ route('clients.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Agregar Nuevo Cliente
                </a>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo Electrónico</th>
                                <th>Prestamos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->nombre }}</td>
                                    <td>{{ $client->apellidos }}</td>
                                    <td>{{ $client->correo }}</td>
                                    <td>
                                        @if($client->loans_count > 0)
                                            <span class="text-warning">{{ $client->loans_count }} préstamo(s) en curso</span>
                                        @else
                                            <span class="text-success">No tiene préstamos activos</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning me-2">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>

                                            <form action="{{ route('clients.delete', $client) }}" method="POST"
                                                style="display: inline-block;"
                                                onsubmit="return confirm('¿Estás seguro de querer eliminar este cliente?')">
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