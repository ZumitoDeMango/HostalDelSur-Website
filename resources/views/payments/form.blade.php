@extends('templates.master')

@section('main-content')
<div class="container mt-4 d-flex justify-content-center align-items-center">
    <div class="row">
        <div class="col">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h1 class="text-center">Seleccionar Método de Pago</h1>
                    <p class="text-center">Por favor, elige tu método de pago preferido para completar tu reserva.</p>

                    <div class="row justify-content-center mt-4">
                        <div class="col-md-6">
                            <form action="{{-- {{ route('payment.process') }} --}}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="reserva" class="form-label">ID de la Reserva</label>
                                    <input type="text" class="form-control" id="reserva" name="reserva" value="{{-- {{ $reserva->id ?? '' }} --}}" readonly>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="monto" class="form-label">Monto a Pagar</label>
                                    <input type="text" class="form-control" id="monto" name="monto" value="{{-- {{ $reserva->total_precio ?? '' }} --}}" readonly>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="metodo_pago" class="form-label">Método de Pago</label>
                                    <select class="form-select" id="metodo_pago" name="metodo_pago" required>
                                        <option value="" disabled selected>Selecciona un método</option>
                                        <option value="transferencia">Transferencia Bancaria</option>
                                        <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                                        <option value="paypal">PayPal</option>
                                    </select>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success">Proceder al Pago</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection