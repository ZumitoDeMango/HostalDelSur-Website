@extends('templates.master')

@section('main-content')
<div class="row mt-4 d-flex justify-content-end">
    <div class="col-3">
        <form method="POST" action="{{ route('rooms.index') }}" class="mb-3">
            @csrf
            <select id="tipo" name="tipo" class="form-select" onchange="this.form.submit()">
                <option value="">Todos los tipos</option>
                @foreach($types as $type)
                    <option value="{{ $type->nombre }}" {{ (isset($tipoSelec) && $tipoSelec == $type->nombre) ? 'selected' : '' }}>
                        {{ $type->nombre }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 order-last order-lg-first">
        <div class="row">
            @foreach($rooms as $room) 
            {{-- card de la habitacion --}}
            <div class="col-12 col-md-6 col-xl-4 d-flex flex-column align-items-stretch">
                <div class="card mb-3">
                    <div class="image-container-card">
                        <img src="{{ asset("images/hab1.jpeg") }}" class="img-fluid card-img-top" alt="...">
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title text-center mb-3">{{ $room->nombre }} - {{ $room->type->nombre }}</h5>
                        <h6 class="text-center mb-3">Desde ${{ $room->precio }}</h6>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#modalRoom{{ $room->id }}">Ver detalles</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal de la habitacion --}}
            <div class="modal fade" id="modalRoom{{ $room->id }}" tabindex="-1" aria-labelledby="mostrarLabel{{ $room->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h1 class="modal-title fs-5" id="mostrarLabel">{{ $room->nombre }} - {{ $room->type->nombre }}</h1>
                            <button type="close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="image-container-card mb-3">
                                <img src="{{ asset("images/hab1.jpeg") }}" class="img-fluid card-img-top" alt="...">
                            </div>
                            <div class="row">
                                <p>{{ $room->descripcion }}</p>
                                <p>Se encuentra en el piso {{ $room->piso }}</p>
                            </div>
                            <div class="row">
                                <p>¿Baño privado? {{ $room->banopriv == '1' ? 'Si tiene' : 'No tiene' }}</p>
                                <p>¿Television? {{ $room->television == '1' ? 'Si tiene' : 'No tiene' }}</p>
                                <p>¿Aire acondicionado? {{ $room->aireac == '1' ? 'Si tiene' : 'No tiene' }}</p>
                            </div>
                        </div>
                        <div class="modal-footer bg-dark text-white">
                            <div class="d-grid">
                                <a href="{{ route('reservations.form', ['id' => $room->id]) }}" class="btn btn-primary">Reservar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection