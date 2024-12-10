@extends('templates.master')

@section('main-content')
<form method="GET" action="{{ route('payments.admin') }}" class="mt-2">
    <div class="row align-items-end">
        <div class="col-md-4">
            <label for="mes" class="form-label">Mes</label>
            <select id="mes" name="mes" class="form-select">
                <option value="" selected>Todos</option>
                @foreach($months as $key => $month)
                <option value="{{ $key }}" {{ request('mes') == $key ? 'selected' : '' }}>{{ $month }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="anio" class="form-label">Año</label>
            <select id="anio" name="anio" class="form-select">
                <option value="" selected>Todos</option>
                @foreach($years as $year)
                <option value="{{ $year }}" {{ request('anio') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </div>
</form>
{{-- Tabla de Pagos --}}
<div class="card text-white bg-dark mt-4 mb-4">
    <div class="card-body">
        <h3 class="card-title text-center mb-3">PAGOS</h3>
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
@if($filteredTotal > 0)
    <div class="alert alert-info text-center">
        Total del mes: <strong>${{ $filteredTotal }}</strong>
    </div>
@endif
@endsection