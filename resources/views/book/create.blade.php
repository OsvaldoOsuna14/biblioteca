@extends('layouts.app')

@section('title', 'Agregar Nuevo Libro')

@section('content')

    <div class="container py-4">
    <div class="card-header" style="border-radius: 1rem 1rem 0 0;">
        <h2 class="mb-0 text-light">
            <i class="fas fa-book-reader me-2"></i>
            Agregar Nuevo Libro
        </h2>
    </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('book.store') }}" method="POST">
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
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="url_imagen" class="form-label">URL de la imagen</label>
                        <input type="text" class="form-control" id="url_imagen" name="url_imagen"
                            value="{{ old('url_imagen') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" class="form-control" id="autor" name="autor" value="{{ old('autor') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="total_piezas" class="form-label">Piezas Totales</label>
                        <input type="number" class="form-control" id="total_piezas" name="total_piezas"
                            value="{{ old('total_piezas') }}" required>
                    </div>


                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('book.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection