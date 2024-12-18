@extends('templates.master')

@section('main-content')
<div class="container mt-4 mb-4">
    <h1 class="text-center">Resumen de Reserva</h1>
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h3>Información de la Reserva</h3>
        </div>
        <div class="card-body">
            <p><strong>Número de Reserva:</strong> {{ $reservation->id }}</p>
            <p><strong>Cliente:</strong> {{ $reservation->nombre }}</p>
            <p><strong>RUT/Pasaporte:</strong> {{ $reservation->rut_o_pasaporte }}</p>
            <p><strong>Correo Electrónico:</strong> {{ $reservation->correo }}</p>
            <p><strong>Teléfono:</strong> {{ $reservation->fono }}</p>
            <p><strong>Fecha de Reserva:</strong> {{ $reservation->fecha_reserva->format('d-m-Y') }}</p>
            <p><strong>Total de Noches:</strong> {{ $reservation->total_noches }}</p>
            <p><strong>Precio Total:</strong> ${{ number_format($reservation->total_precio, 0, ',', '.') }}</p>
            <p><strong>Información Adicional:</strong> {{ $reservation->info_adicional ?? 'No proporcionada' }}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-dark text-white">
            <h3>Huéspedes</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Rut o Pasaporte</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Fono</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($guests as $guest)
                        <tr>
                            <td>{{ $guest->rut_o_pasaporte }}</td>
                            <td>{{ $guest->nombre }}</td>
                            <td>{{ $guest->correo }}</td>
                            <td>{{ $guest->fono }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-secondary text-white">
            <h3>Detalles de la Estancia</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Habitación</th>
                        <th>Descripción</th>
                        <th>Piso</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stays as $stay)
                        <tr>
                            <td>{{ $stay->room->nombre }}</td>
                            <td>{{ $stay->room->descripcion }}</td>
                            <td>{{ $stay->room->piso }}</td>
                            <td>{{ $stay->fecha_inicio->format('d-m-Y') }}</td>
                            <td>{{ $stay->fecha_fin->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-success text-white">
            <h3>Pagos Realizados</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Monto</th>
                        <th>Tipo de Pago</th>
                        <th>Estado</th>
                        <th>Fecha de Pago</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>${{ number_format($payment->monto, 0, ',', '.') }}</td>
                            <td>{{ $payment->tipo_pago }}</td>
                            <td>{{ ucfirst($payment->estado) }}</td>
                            <td>{{ $payment->fecha_pago->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection