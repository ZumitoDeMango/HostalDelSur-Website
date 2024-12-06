@extends('templates.master')

@section('main-content')
<div class="container mt-4 d-flex justify-content-center align-items-center">
    <div class="row">
        <div class="col">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h1 class="text-center">Seleccionar Método de Pago</h1>
                    <p class="text-center">Por favor, elige tu método de pago preferido para completar tu reserva.<p>

                    <div class="row justify-content-center mt-4">
                        <div class="col-md-6">
                            <form action="{{ route('payments.process') }}" method="POST">
                                @csrf
                                
                                <div>
                                    <input type="hidden" name="reserva" value="{{ $reservation->id }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="monto" class="form-label">Monto a Pagar</label>
                                    <input type="text" class="form-control" id="monto" name="monto" value="{{ number_format($reservation->total_precio, 0, ',', '.') }}" readonly>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="metodo_pago" class="form-label">Método de Pago</label>
                                    <select class="form-select" id="metodo_pago" name="metodo_pago">
                                        <option value="" selected>Selecciona un método</option>
                                        <option value="transferencia">Transferencia Bancaria</option>
                                        <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                                        <option value="efectivo">Efectivo</option>
                                    </select>
                                    @error('metodo_pago')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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