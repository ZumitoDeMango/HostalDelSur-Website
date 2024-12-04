@extends('templates.master')

@section('main-content')
<div class="card text-white bg-dark mt-4">
    <div class="card-body">
        <form method="POST" action="{{ route('rooms.update', $room->id) }}">
        @csrf
        @method('PATCH')
            <div class="row">
                <div class="col-lg-9">
                    <h3>Editar {{ $room->nombre }}</h3>
                </div>
                <div class="col-lg-3 d-grid d-lg-flex align-items-center justify-content-lg-between">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('rooms.admin') }}" class="btn btn-warning text-white">Regresar</a>
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la habitacion</label>
                    <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $room->nombre }}">
                </div>
                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo</label>
                    <select id="tipo" name="tipo" class="form-select">
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ $room->tipo == $type->id ? 'selected' : '' }}>
                                {{ $type->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input id="precio" name="precio" type="number" class="form-control" value="{{ $room->precio }}">
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <div class="form-check">
                        <input id="banopriv" name="banopriv" class="form-check-input" type="checkbox" {{ $room->banopriv ? 'checked' : '' }}>
                        <label for="banopriv" class="form-check-label">Baño privado</label>
                    </div>
                    <div class="form-check">
                        <input id="television" name="television" class="form-check-input" type="checkbox" {{ $room->television ? 'checked' : '' }}>
                        <label for="television" class="form-check-label">Televisión</label>
                    </div>
                    <div class="form-check">
                        <input id="aireac" name="aireac" class="form-check-input" type="checkbox" {{ $room->aireac ? 'checked' : '' }}>
                        <label for="aireac" class="form-check-label">Aire acondicionado</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripcion</label>
                    <textarea id="descripcion" name="descripcion" class="form-control">{{ $room->descripcion }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="piso" class="form-label">Piso</label>
                    <input id="piso" name="piso" type="number" class="form-control" value="{{ $room->piso }}">
                </div>
                <div class="mb-3">
                    <label for="fotos" class="form-label">Fotos</label>
                    <input id="fotos" class="form-control" type="file" multiple>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection