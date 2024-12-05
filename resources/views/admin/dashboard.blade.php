@extends('templates.master')

@section('main-content')
<div class="row mt-4">
    <div class="col-6">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h4 class="card-title mb-3 text-center">CHECK-IN Y CHECK-OUT</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>N° habitacion</th>
                            <th>Nombre huesped</th>
                            <th>Check</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>7</th>
                            <td>Pepito</td>
                            <td>Entra</td>
                            <td>12-10-2024</td>
                        </tr>
                        <tr>
                            <th>3</th>
                            <td>Clarita</td>
                            <td>Sale</td>
                            <td>15-10-2024</td>
                        </tr>
                    </tbody>
                </table>
                <h4 class="card-title mb-3 text-center">RESUMEN DE GANANCIAS</h4>
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
                    <a class="btn btn-primary" href="{{ route('admin.payments') }}" 
                    role="button">PAGOS</a>
                </div>
                <div class="d-grid mb-3">
                    <a class="btn btn-primary" href="{{ route('admin.admins') }}" 
                    role="button">ADMINISTRADORES</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection