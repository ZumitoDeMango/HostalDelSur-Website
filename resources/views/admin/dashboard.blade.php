@extends('templates.master')

@section('main-content')
<div class="row">
    <div class="col-6">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h4 class="card-title mb-3 text-center">Check-In y Check-Out</h4>
                <h4 class="card-title mb-3 text-center">Resumen de ganancias</h4>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h4 class="card-title mb-3 text-center">GESTIÓN</h4>
                <div class="d-grid mb-3">
                    <a class="btn btn-primary" href="#" role="button">HABITACIONES</a>
                </div>
                <div class="d-grid mb-3">
                    <a class="btn btn-primary" href="#" role="button">RESERVAS</a>
                </div>
                <div class="d-grid">
                    <a class="btn btn-primary" href="#" role="button">PAGOS</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection