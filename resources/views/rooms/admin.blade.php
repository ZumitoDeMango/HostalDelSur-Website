@extends('templates.master')

@section('main-content')

{{-- tabla de habitaciones --}}
<div class="card text-white bg-dark mt-4">
    <div class="card-body">
        <h3 class="card-title text-center mb-3">HABITACIONES</h3>
        <div class="row mb-3">
            <form class="d-flex" role="search" method="GET" action="{{ route('rooms.admin') }}">
                <input 
                    class="form-control me-2" 
                    type="search" 
                    name="search" 
                    placeholder="Buscar habitación" 
                    aria-label="Search" 
                    value="{{ $search ?? '' }}"> <!-- Preserva el valor ingresado -->
                <button class="btn btn-success" type="submit">Buscar</button>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Habitacion</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Disponible</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                <tr>
                    <td>{{ $room->nombre }}</td>
                    <td>{{ $room->type->nombre }}</td>
                    <td>${{ $room->precio }}</td>
                    <td>
                        <span class="material-icons" style="font-size: 20px;">{{ $room->disponible == '1' ? 'check' : 'close'}}</span>
                    </td>
                    <td>
                        <div class="d-grid">
                            <a href="{{ route('rooms.edit',$room->id) }}" class="btn btn-sm btn-warning pb-0 text-white" data-bs-title="Editar">
                                <span class="material-icons" style="font-size: 20px;">edit</span>
                            </a>
                        </div>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('rooms.destroy', $room->id) }}" id="deleteForm{{ $room->id }}">
                            @csrf
                            @method("delete")
                            <button type="button" class="btn btn-sm btn-danger pb-0 text-white" data-bs-toggle="modal" data-bs-target="#modalDelete" 
                                data-bs-room-id="{{ $room->id }}" data-bs-action="{{ route('rooms.destroy', $room->id) }}">
                                <span class="material-icons" style="font-size: 20px;">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-grid">
            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalRoom">Agregar habitacion</button>
        </div>
    </div>
</div>

{{-- modal para confirmacion de delete --}}
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar esta habitación? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" action="{{ route('rooms.destroy', $room->id) }}" style="display: inline;">
                    @csrf
                    @method("delete")
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal para agregar habitacion --}}
<div class="modal fade" id="modalRoom" tabindex="-1" aria-labelledby="agregarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <form method="POST" action="{{ route('rooms.store') }}">
            @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="agregarLabel">Agregar habitacion</h1>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de la habitacion</label>
                        <input id="nombre" name="nombre" type="text" class="form-control">
                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select id="tipo" name="tipo" class="form-select">
                            <option selected>--SELECCIONE UN TIPO--</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->nombre }}</option>
                            @endforeach
                        </select>
                        @error('tipo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input id="precio" name="precio" type="number" class="form-control">
                        @error('precio')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <div class="form-check">
                            <input id="banopriv" name="banopriv" class="form-check-input" type="checkbox">
                            <label for="banopriv" class="form-check-label">Baño privado</label>
                        </div>
                        <div class="form-check">
                            <input id="television" name="television" class="form-check-input" type="checkbox">
                            <label for="television" class="form-check-label">Television</label>
                        </div>
                        <div class="form-check">
                            <input id="aireac" name="aireac" class="form-check-input" type="checkbox">
                            <label for="aireac" class="form-check-label">Aire acondicionado</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
                        @error('descripcion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="piso" class="form-label">Piso</label>
                        <input id="piso" name="piso" type="number" class="form-control">
                        @error('piso')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input id="foto" class="form-control" type="file">
                        @error('foto')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modal = new bootstrap.Modal(document.getElementById('modalRoom'));
            modal.show();
        });
    </script>
@endif

<script>
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var roomId = button.getAttribute('data-bs-room-id');
        var action = button.getAttribute('data-bs-action');

        var deleteForm = document.getElementById('deleteForm');
        deleteForm.action = action;
    });
</script>

@endsection