@extends('layouts.app')

@section('title', 'Editar Libro')

@section('content')


<div class="container py-4">
    <div class="card-header" style="border-radius: 1rem 1rem 0 0;">
        <h2 class="mb-0 text-light">
            <i class="fas fa-book-reader me-2"></i>
            Editar Libro
        </h2>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('book.update', $book) }}" method="POST">
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
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                           id="titulo" name="titulo" value="{{ old('titulo', $book->titulo) }}" required>
                </div>
                <div class="mb-3">
                    <label for="url_imagen" class="form-label">URL de la imagen</label>
                    <input type="url" class="form-control @error('url_imagen') is-invalid @enderror" 
                           id="url_imagen" name="url_imagen" value="{{ old('url_imagen', $book->url_imagen) }}" required>
                </div>
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <input type="text" class="form-control @error('autor') is-invalid @enderror" 
                           id="autor" name="autor" value="{{ old('autor', $book->autor) }}" required>
                </div>
                <div class="mb-3">
                    <label for="total_piezas" class="form-label">Piezas Totales</label>
                    <input type="number" class="form-control @error('total_piezas') is-invalid @enderror" 
                           id="total_piezas" name="total_piezas" value="{{ old('total_piezas', $book->total_piezas) }}" required>
                </div>
                <div class="mb-3">
                    <label for="piezas_disponibles" class="form-label">Piezas Disponibles</label>
                    <input type="number" class="form-control @error('piezas_disponibles') is-invalid @enderror" 
                           id="piezas_disponibles" name="piezas_disponibles" 
                           value="{{ old('piezas_disponibles', $book->piezas_disponibles) }}" required>
                    @error('piezas_disponibles')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('book.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection