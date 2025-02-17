@extends('layouts.app')

@section('title', 'Gestión de Préstamos')

@section('content')

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        
        @endif

        <div class="card">
            <div class="card-header header d-flex justify-content-between align-items-center p-4">
                <h2 class="text-light mb-0">Gestión de Préstamos</h2>
                <a href="{{ route('loan.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Agregar Nuevo Préstamo
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Libros</th>
                                <th>Cliente</th>
                                <th>Creado por</th>
                                <th>Fecha de Préstamo</th>
                                <th>Fecha Límite</th>
                                <th>Fecha Devolución</th>
                                <th>Cerrado por</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($loans as $loan)
                                <tr>
                                    <td>
                                        <ul class="list-unstyled">
                                            <li>{{ implode(', ', $loan->books->pluck('titulo')->toArray()) }}</li>
                                        </ul>
                                    </td>
                                    <td>{{ $loan->client->nombre . ' ' . $loan->client->apellido }}</td>
                                    <td>{{ $loan->creator->nombre . ' ' . $loan->creator->apellido  }}</td>
                                    <td>{{ $loan->fecha_prestamo->format('d/m/Y') }}</td>
                                    <td>{{ $loan->fecha_limite->format('d/m/Y') }}</td>
                                    <td>{{ $loan->fecha_devolucion ? $loan->fecha_devolucion->format('d/m/Y') : 'Pendiente' }}
                                    </td>
                                    <td>{{ $loan->closer ? $loan->closer->nombre . ' ' . $loan->closer->apellido : 'Pendiente' }}
                                    <td>
                                        <span class="badge {{ $loan->estado == 'Activo' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $loan->estado }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if($loan->estado == 'Activo')
                                                <form action="{{ route('loans.close', $loan->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-secondary" style="margin: 10px;">Cerrar préstamo</button>
                                                </form>
                                            @endif
                                            <a href="{{ route('loan.edit', $loan) }}" class="btn btn-sm btn-warning me-2">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>

                                            <form action="{{ route('loan.delete', $loan) }}" method="POST"
                                                style="display: inline-block;"
                                                onsubmit="return confirm('¿Estás seguro de querer eliminar este préstamo?')">
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