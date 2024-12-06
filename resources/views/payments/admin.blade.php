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
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->fecha_pago->format('d/m/Y') }}</td>
                    <td>{{ $payment->reservation->nombre }}</td>
                    <td>${{ $payment->monto }}</td>
                    <td>{{ $payment->tipo_pago }}</td>
                    <td>
                        {{-- Botón para mostrar y cambiar el estado --}}
                        <form action="{{ route('payments.toggle', $payment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm 
                                {{ $payment->estado == 'pagado' ? 'btn-success' : 'btn-warning' }} text-white" 
                                title="Cambiar estado">
                                <div class="row">
                                    <div class="col-3">
                                        <span class="material-icons">
                                            {{ $payment->estado == 'pagado' ? 'check_circle' : 'pending' }}
                                        </span>
                                    </div>
                                    <div class="col">
                                        {{ ucfirst($payment->estado) }}
                                    </div>
                                </div>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection