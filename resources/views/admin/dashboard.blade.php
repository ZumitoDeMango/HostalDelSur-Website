@extends('templates.master')

@section('main-content')
<div class="row mt-4">
    <div class="col-6">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h4 class="card-title mb-3 text-center">CHECK-IN Y CHECK-OUT DEL DÍA</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Habitación</th>
                            <th>Cliente</th>
                            <th>Acción</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stays as $stay)
                            @if ($stay->fecha_inicio <= now() && $stay->fecha_fin >= now())
                                <tr>
                                    <td>{{ $stay->room->nombre }}</td>
                                    <td>{{ $stay->reservation->nombre }}</td>
                                    <td>Entra</td>
                                    <td>{{ $stay->fecha_inicio->format('d-m-Y') }}</td>
                                </tr>
                            @elseif ($stay->fecha_fin < now())
                                <tr>
                                    <td>{{ $stay->room->nombre }}</td>
                                    <td>{{ $stay->reservation->nombre }}</td>
                                    <td>Sale</td>
                                    <td>{{ $stay->fecha_fin->format('d-m-Y') }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <h4 class="card-title mb-3 text-center">RESUMEN DE GANANCIAS MENSUALES</h4>
                <p class="text-center text-white">
                    Total de ganancias para este mes: ${{ number_format($monthlyIncome, 0, ',', '.') }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h4 class="card-title mb-3 text-center">GESTIÓN</h4>
                <div class="d-grid mb-3">
                    <a class="btn btn-primary" href="{{ route('rooms.admin') }}" 
                    role="button">HABITACIONES</a>
                </div>
                <div class="d-grid mb-3">
                    <a class="btn btn-primary" href="{{ route('reservations.admin') }}" 
                    role="button">RESERVAS</a>
                </div>
                <div class="d-grid mb-3">
                    <a class="btn btn-primary" href="{{ route('payments.admin') }}" 
                    role="button">PAGOS</a>
                </div>
                <div class="d-grid mb-3">
                    <a class="btn btn-primary" href="{{ route('users.admin') }}" 
                    role="button">ADMINISTRADORES</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection