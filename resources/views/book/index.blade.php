@extends('layouts.app')

@section('title', 'Gestión de Libros')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
    <div class="card-header header d-flex justify-content-between align-items-center p-4">
        <h2 class="text-light mb-0">Gestión de Libros</h2>
        <a href="{{ route('book.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="fas fa-plus"></i>
            Agregar Nuevo Libro
        </a>
    </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Piezas Totales</th>
                            <th>Disponibles</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->titulo }}</td>
                                <td>{{ $book->autor }}</td>
                                <td>{{ $book->total_piezas }}</td>
                                <td>
                                    <span class="badge {{ $book->piezas_disponibles > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $book->piezas_disponibles }}
                                    </span>
                                </td>
                                <td>
                                    <img src="{{ $book->url_imagen }}" alt="{{ $book->titulo }}" class="img-thumbnail" style="max-width: 100px;">
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('book.edit', $book) }}"
                                           class="btn btn-sm btn-warning me-2">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        
                                        <form action="{{ route('book.delete', $book) }}" 
                                              method="POST" 
                                              style="display: inline-block;"
                                              onsubmit="return confirm('¿Estás seguro de querer eliminar este libro?')">
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