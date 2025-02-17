@extends('layouts.app')



@section('title', 'Dashboard')

@section('content')
    <div class="dahsboar-container py-4">
        <div class="row g-2 mt-4">
            <div class="col-md-4">
                <div class="tarjeta-estadisticas prestamos-activos h-100">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h3 class="mb-1">Préstamos Activos</h3>
                            <div class="number">{{ $activeLoans ?? 0 }}</div>
                        </div>
                        <i class="bi bi-book-half fs-1"></i>
                    </div>
                    <a href="{{ route('loan.index') }}" class="stats-link">
                        Ver detalles <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
            <div class="tarjeta-estadisticas prestamos-vencidos h-100">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h3 class="mb-1">Préstamos Vencidos</h3>
                        <div class="number">{{ $overdueLoans ?? 0 }}</div>
                    </div>
                    <i class="bi bi-exclamation-triangle fs-1"></i>
                </div>
                <a href="{{ route('loan.index') }}" class="stats-link">
                    Ver detalles <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="tarjeta-estadisticas libros-disponibles h-100">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h3 class="mb-1">Libros Disponibles</h3>
                        <div class="number">{{ $availableBooks ?? 0 }}</div>
                    </div>
                    <i class="bi bi-journals fs-1"></i>
                </div>
                <a href="{{ route('book.index') }}" class="stats-link">
                    Ver detalles <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
        </div>
    </div>
@endsection