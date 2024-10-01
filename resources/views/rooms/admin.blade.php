@extends('templates.master')

@section('main-content')

{{-- tabla de habitaciones --}}
<div class="card text-white bg-dark mt-4">
    <div class="card-body">
        <h3 class="card-title text-center mb-3">HABITACIONES</h3>
        <div class="row mb-3">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar habitacion" aria-label="Search">
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
                    <td>{{ $room->tipo }}</td>
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
                        <form method="POST" action="{{ route('rooms.destroy',$room->id) }}">
                        @csrf
                        @method("delete")
                            <div class="d-grid">
                                <button type="submit" class="btn btn-sm btn-danger pb-0 text-white" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                    <span class="material-icons" style="font-size: 20px;">delete</span>
                                </button>
                            </div>
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
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select id="tipo" name="tipo" class="form-select">
                            <option selected>--SELECCIONE UN TIPO--</option>
                            <option value="Single">Single</option>
                            <option value="Twin">Twin</option>
                            <option value="Doble">Doble</option>
                            <option value="Triple">Triple</option>
                            <option value="Cuatruple">Cuatruple</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input id="precio" name="precio" type="number" class="form-control">
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
                    </div>
                    <div class="mb-3">
                        <label for="piso" class="form-label">Piso</label>
                        <input id="piso" name="piso" type="number" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="fotos" class="form-label">Fotos</label>
                        <input id="fotos" class="form-control" type="file" multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection