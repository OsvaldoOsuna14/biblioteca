@extends('layouts.app')

@section('title', 'Edtiar Préstamo')

@section('content')

    <div class="container py-4">
        <div class="card-header" style="border-radius: 1rem 1rem 0 0;">
            <h2 class="mb-0 text-light">
                <i class="fas fa-book-reader me-2"></i>
                Editar Préstamo
            </h2>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('loan.update', ['loan' => $loan->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
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

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="libros" class="form-label fw-bold">
                                    <i class="fas fa-books me-2"></i>Libros
                                </label>
                                <select class="form-select shadow-sm" id="libros" name="libros[]" multiple required>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}" @if(in_array($book->id, $loan->books->pluck('id')->toArray())) selected @endif>
                                            {{ $book->titulo }}
                                            <span class="text-muted">({{ $book->piezas_disponibles }} disponibles)</span>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_cliente" class="form-label fw-bold">
                                    <i class="fas fa-user me-2"></i>Cliente
                                </label>

                                <div class="input-group">
                                    <select class="form-select shadow-sm" id="id_cliente" name="id_cliente" required>
                                        <option value="">Seleccione un cliente</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}" @if($client->id == $loan->client->id) selected
                                            @endif>
                                                {{ $client->nombre }} {{ $client->apellidos }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-mb-6">
                                <label for="fecha_prestamo" class="form-label fw-bold">
                                    <i class="fas fa-calendar-day me-2"></i>Fecha de Préstamo
                                </label>
                                <input type="date" class="form-control shadow-sm" id="fecha_prestamo" name="fecha_prestamo"
                                value="{{ $loan->fecha_prestamo }}" required>
                            </div>
                            <div class="col-mb-6">
                                <label for="fecha_devolucion" class="form-label fw-bold">
                                    <i class="fas fa-calendar-day me-2"></i>Fecha de Limite
                                </label>
                                <input type="date" class="form-control shadow-sm" id="fecha_limite" name="fecha_limite"
                                value="{{ $loan->fecha_limite }}" required>
                            </div>
                    </div>


                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('loan.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection