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
                    <th>Eliminar</th>
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
                    <td>
                        <form method="POST" action="{{ route('reservations.destroy', $reservation->id) }}">
                            @csrf
                            @method("delete")
                            <button type="button" 
                                    class="btn btn-sm btn-danger text-white" 
                                    title="Eliminar"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalDelete"
                                    data-bs-reservation-id="{{ $reservation->id }}"
                                    data-bs-action="{{ route('reservations.destroy', $reservation->id) }}">
                                <span class="material-icons">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- modal para confirmacion de delete --}}
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLabel">PELIGRO DE ELIMINACIÓN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Al eliminar esta reserva estaría tambien borrando todos los datos relacionados a esta. ¿Estás seguro que deseas proceder? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modalDelete = document.getElementById('modalDelete');
        modalDelete.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Botón que disparó el modal
            var roomId = button.getAttribute('data-bs-reservation-id'); // ID de la habitación
            var action = button.getAttribute('data-bs-action'); // Ruta de eliminación

            // Actualizar el formulario del modal
            var deleteForm = modalDelete.querySelector('#deleteForm');
            deleteForm.action = action;
        });
    });
</script>
@endsection