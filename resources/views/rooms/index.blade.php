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
                        @php
                            $photos = json_decode($room->urlfoto, true);
                        @endphp
                        <img src="{{ asset('storage/' . $photos[0]) }}" class="img-fluid card-img-top" alt="Foto">
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
            {{-- Modal de la habitación --}}
            <div class="modal fade" id="modalRoom{{ $room->id }}" tabindex="-1" aria-labelledby="mostrarLabel{{ $room->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        {{-- Encabezado del modal --}}
                        <div class="modal-header bg-dark text-white">
                            <h1 class="modal-title fs-5" id="mostrarLabel">{{ $room->nombre }} - {{ $room->type->nombre }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        {{-- Contenido principal del modal --}}
                        <div class="modal-body">
                            <div class="row">
                                {{-- Columna izquierda: Información de la habitación --}}
                                <div class="col-lg-6 d-flex flex-column justify-content-center">
                                    <p>{{ $room->descripcion }}</p>
                                    <p>Se encuentra en el piso {{ $room->piso }}</p>
                                    <p>¿Baño privado? {{ $room->banopriv == '1' ? 'Sí tiene' : 'No tiene' }}</p>
                                    <p>¿Televisión? {{ $room->television == '1' ? 'Sí tiene' : 'No tiene' }}</p>
                                    <p>¿Aire acondicionado? {{ $room->aireac == '1' ? 'Sí tiene' : 'No tiene' }}</p>
                                </div>

                                {{-- Columna derecha: Carrusel de fotos --}}
                                <div class="col-lg-6">
                                    <div id="carouselRoom{{ $room->id }}" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @php
                                                $photos = json_decode($room->urlfoto, true);
                                            @endphp
                                            @foreach($photos as $index => $photo)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $photo) }}" 
                                                        class="d-block w-100 img-carousel" 
                                                        alt="Foto {{ $index + 1 }}" 
                                                        onclick="showFullImage('{{ asset('storage/' . $photo) }}')">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselRoom{{ $room->id }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Anterior</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselRoom{{ $room->id }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Siguiente</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Imagen ampliada (superposición) --}}
                            <div class="full-image-overlay d-none">
                                <img id="fullImage" src="" class="img-fluid" alt="Imagen completa">
                                <button type="button" class="btn btn-light btn-close-overlay" onclick="hideFullImage()">Cerrar</button>
                            </div>
                        </div>

                        {{-- Pie de página del modal --}}
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
<script>
    function showFullImage(imageSrc) {
    const overlay = document.querySelector('.full-image-overlay');
    const fullImage = document.getElementById('fullImage');
    fullImage.src = imageSrc;
    overlay.classList.remove('d-none');
    }

    function hideFullImage() {
        const overlay = document.querySelector('.full-image-overlay');
        overlay.classList.add('d-none');
    }

</script>
@endsection