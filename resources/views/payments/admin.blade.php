@extends('templates.master')

@section('main-content')
{{-- Tabla de Pagos --}}
<div class="card text-white bg-dark mt-4">
    <div class="card-body">
        <h3 class="card-title text-center mb-3">PAGOS</h3>
        {{-- Barra de búsqueda --}}
        <div class="row mb-3">
            <form class="d-flex" role="search" method="GET" action="{{ route('payments.admin') }}">
                <input 
                    class="form-control me-2" 
                    type="search" 
                    name="search" 
                    placeholder="Buscar pago" 
                    aria-label="Search" 
                    value="{{ $search ?? '' }}"> <!-- Preserva el valor ingresado -->
                <button class="btn btn-success" type="submit">
                    <span class="material-icons">search</span>
                </button>
            </form>
        </div>
        {{-- Tabla de pagos --}}
        <table class="table table-hover align-middle text-center text-white">
            <thead class="table-dark">
                <tr>
                    <th>Fecha del pago</th>
                    <th>Cliente</th>
                    <th>Monto pagado</th>
                    <th>Tipo de pago</th>
                    <th>Estado</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->fecha_pago->format('d/m/Y') }}</td>
                    <td>{{ $payment->reservation->nombre }}</td>
                    <td>${{ $payment->monto }}</td>
                    <td>{{ $payment->tipo_pago }}</td>
                    <td>{{ $payment->estado }}</td>
                    <td>
                        <a href="{{-- {{ route('payments.details', $payment->id) }} --}}" 
                           class="btn btn-sm btn-info text-white" 
                           title="Ver detalles">
                            <span class="material-icons">visibility</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Botón de agregar pago --}}
        <div class="d-grid">
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalPayment">
                <span class="material-icons align-middle">add</span>
                <span class="align-middle">Agregar Pago</span>
            </button>
        </div>
    </div>
</div>

@endsection