@extends('layouts.app')

@section('title', 'Agregar Nuevo Préstamo')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header" style="border-radius: 1rem 1rem 0 0;">
            <h2 class="mb-0 text-light">
                <i class="fas fa-book-reader me-2"></i>
                Agregar Nuevo Préstamo
            </h2>
        </div>
        
        <div class="card-body shadow-sm">
            <form action="{{ route('loan.store') }}" method="POST">
                @csrf
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
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
                                    <option value="{{ $book->id }}">
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
                                        <option value="{{ $client->id }}">
                                            {{ $client->nombre . ' ' . $client->apellidos }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newUserModal">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_prestamo" class="form-label fw-bold">
                                <i class="fas fa-calendar me-2"></i>Fecha de Préstamo
                            </label>
                            <input type="date" class="form-control shadow-sm" id="fecha_prestamo" name="fecha_prestamo"
                                value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha_limite" class="form-label fw-bold">
                                <i class="fas fa-calendar-alt me-2"></i>Fecha Límite
                            </label>
                            <input type="date" class="form-control shadow-sm" id="fecha_limite" name="fecha_limite" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('loan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header">
                <h5 class="modal-title text-light" id="newUserModalLabel">
                    <i class="fas fa-user-plus me-2"></i>Nuevo Cliente
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="newUserForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">Nombre</label>
                        <input type="text" class="form-control shadow-sm" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label fw-bold">Apellidos</label>
                        <input type="text" class="form-control shadow-sm" id="apellidos" name="apellidos" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label fw-bold">Correo</label>
                        <input type="email" class="form-control shadow-sm" id="correo" name="correo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Guardar Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#libros').select2({
                placeholder: 'Seleccione los libros',
                allowClear: true
            });

            $('#id_cliente').select2({
                placeholder: 'Seleccione un cliente',
                allowClear: true
            });


            $('#newUserForm').on('submit', function (e) {
                e.preventDefault();

                fetch('{{ route("clients.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        nombre: $('#nombre').val(),
                        apellidos: $('#apellidos').val(),
                        correo: $('#correo').val()
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const newOption = new Option(
                                data.user.nombre + ' ' + data.user.apellidos,
                                data.user.id,
                                true,
                                true
                            );
                            $('#id_cliente').append(newOption).trigger('change');

                            $('#newUserModal').modal('hide');
                            $('#newUserForm')[0].reset();

                            alert('Cliente registrado exitosamente');
                        } else {
                            alert('Error al registrar el cliente: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al registrar el cliente');
                    });
            });
        });
    </script>
@endpush