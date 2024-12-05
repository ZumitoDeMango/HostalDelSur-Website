@extends('templates.master')

@section('main-content')
<div class="card text-white bg-dark mt-4">
    <div class="card-body">
        <form method="POST" action="{{ route('rooms.update', $room->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <div class="row">
                <div class="col-lg-9">
                    <h3>Editar {{ $room->nombre }}</h3>
                </div>
                <div class="col-lg-3 d-grid d-lg-flex align-items-center justify-content-lg-between">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('rooms.admin') }}" class="btn btn-danger text-white">Regresar</a>
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la habitacion</label>
                    <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $room->nombre }}">
                    @error('nombre')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
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
                    @error('tipo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio</label>
                    <input id="precio" name="precio" type="number" class="form-control" value="{{ $room->precio }}">
                    @error('precio')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
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
                    @error('descripcion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="piso" class="form-label">Piso</label>
                    <input id="piso" name="piso" type="number" class="form-control" value="{{ $room->piso }}">
                    @error('piso')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Mostrar fotos actuales --}}
                <div class="mb-3">
                    <label for="fotos" class="form-label">Fotos actuales</label>
                    <div class="row">
                        @foreach(json_decode($room->urlfoto, true) as $photo)
                            <div class="col-3 position-relative">
                                <img src="{{ asset('storage/' . $photo) }}" alt="Foto de la habitación" class="img-thumbnail" style="width: 100%; height: 200px; object-fit: cover;" />
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" onclick="removePhoto(this, '{{ $photo }}')">
                                    <span class="material-icons">delete</span>
                                </button>
                                <input type="checkbox" name="remove_photos[]" value="{{ $photo }}" class="remove-photo-checkbox" style="display:none;" />
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Subir nuevas fotos --}}
                <div class="mb-3">
                    <label for="foto" class="form-label">Fotos nuevas</label>
                    <input id="foto" name="foto[]" class="form-control" type="file" multiple>
                    @error('foto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function removePhoto(button, photo) {
        const checkbox = button.nextElementSibling; // Encuentra el input checkbox
        checkbox.checked = !checkbox.checked;

        // Cambia el estilo de la imagen o botón para indicar que está marcada para eliminar
        if (checkbox.checked) {
            button.closest('.col-3').style.opacity = '0.5';
        } else {
            button.closest('.col-3').style.opacity = '1';
        }
    }

</script>
@endsection