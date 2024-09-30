@extends('templates.master')

@section('main-content')

{{-- tabla de habitaciones --}}
<div class="card text-white bg-dark mt-4">
    <div class="card-body">
        <h4 class="card-title text-center">HABITACIONES</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Habitacion</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Piso</th>
                    <th>Disponible</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)    
                <tr>
                    <td>{{ $room->nombre }}</td>
                    <td>{{ $room->tipo }}</td>
                    <td>{{ $room->precio }}</td>
                    <td>{{ $room->piso }}</td>
                    <td>{{ $room->disponible }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning pb-0 text-white" data-bs-toggle="tooltip" data-bs-title="Editar">
                            <span class="material-icons" style="font-size: 20px;">edit</span>
                        </a>
                        <a href="#" class="btn btn-sm btn-danger pb-0 text-white" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                            <span class="material-icons" style="font-size: 20px;">delete</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-grid">
            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#agregarHabitacion">Agregar habitacion</button>
        </div>
    </div>
</div>

{{-- modal para agregar habitacion --}}
<div class="modal fade" id="agregarHabitacion" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="agregarLabel">Agregar habitacion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nombre de la habitacion</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select class="form-select"></select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Precio</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Baño privado</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Television</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Aire acondicionado</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripcion</label>
                        <textarea class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Piso</label>
                        <input type="number" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>

@endsection