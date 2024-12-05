@extends('templates.master')

@section('main-content')
{{-- Tabla de Reservas --}}
<div class="card text-white bg-dark mt-4">
    <div class="card-body">
        <h3 class="card-title text-center mb-3">RESERVAS</h3>
        {{-- Barra de búsqueda --}}
        <div class="row mb-3">
            <form class="d-flex" role="search" method="GET" action="{{ route('reservations.admin') }}">
                <input 
                    class="form-control me-2" 
                    type="search" 
                    name="search" 
                    placeholder="Buscar reserva" 
                    aria-label="Search" 
                    value="{{ $search ?? '' }}"> <!-- Preserva el valor ingresado -->
                <button class="btn btn-success" type="submit">
                    <span class="material-icons">search</span>
                </button>
            </form>
        </div>
        {{-- Tabla de reservas --}}
        <table class="table table-hover align-middle text-center text-white">
            <thead class="table-dark">
                <tr>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Total Noches</th>
                    <th>Total Precio</th>
                    <th>Detalles</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->fecha_reserva->format('d/m/Y') }}</td>
                    <td>{{ $reservation->nombre }}</td>
                    <td>{{ $reservation->total_noches }}</td>
                    <td>${{ $reservation->total_precio }}</td>
                    <td>
                        <a href="{{-- {{ route('reservations.details', $reservation->id) }} --}}" 
                           class="btn btn-sm btn-info text-white" 
                           title="Ver detalles">
                            <span class="material-icons">visibility</span>
                        </a>
                    </td>
                    <td>
                        <form method="POST" action="{{-- {{ route('reservations.destroy', $reservation->id) }} --}}">
                            @csrf
                            @method("delete")
                            <button type="button" 
                                    class="btn btn-sm btn-danger text-white" 
                                    title="Eliminar"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalDelete"
                                    data-bs-reservation-id="{{ $reservation->id }}"
                                    data-bs-action="{{-- {{ route('reservations.destroy', $reservation->id) }} --}}">
                                <span class="material-icons">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Botón de agregar reserva --}}
        <div class="d-grid">
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalReservation">
                <span class="material-icons align-middle">add</span>
                <span class="align-middle">Agregar Reserva</span>
            </button>
        </div>
    </div>
</div>

@endsection