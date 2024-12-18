@extends('templates.master')

@section('main-content')
<form method="GET" action="{{ route('reservations.admin') }}" class="mt-2">
    @csrf
    <div class="row align-items-end">
        <div class="col-md-4">
            <label for="mes" class="form-label">Mes</label>
            <select id="mes" name="mes" class="form-select" onchange="this.form.submit()">
                @foreach($months as $key => $month)
                <option value="{{ $key }}" {{ $selectedMonth == $key ? 'selected' : '' }}>{{ $month }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="anio" class="form-label">Año</label>
            <select id="anio" name="anio" class="form-select" onchange="this.form.submit()">
                @foreach($years as $year)
                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>
{{-- Tabla de Reservas --}}
<div class="card text-white bg-dark mt-4 mb-4">
    <div class="card-body">
        <h3 class="card-title text-center mb-3">RESERVAS</h3>
        {{-- Tabla de reservas --}}
        <table class="table table-hover align-middle text-center text-white">
            <thead class="table-dark">
                <tr>
                    <th>Hora y Fecha</th>
                    <th>Cliente</th>
                    <th>Total Noches</th>
                    <th>Total Precio</th>
                    <th>Ver Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->fecha_reserva->format('H:i - d/m/Y') }}</td>
                    <td>{{ $reservation->nombre }}</td>
                    <td>{{ $reservation->total_noches }}</td>
                    <td>${{ $reservation->total_precio }}</td>
                    <td>
                        <a href="{{ route('reservations.show', $reservation->id) }}" 
                           class="btn btn-sm btn-info text-white" 
                           title="Ver detalles">
                            <span class="material-icons">visibility</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection