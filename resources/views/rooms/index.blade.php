@extends('templates.master')

@section('main-content')
<div class="row mt-4 d-flex justify-content-end">
    <div class="col-3">
        <form method="GET" action="{{ route('home.rooms') }}" class="mb-3">
            <select id="tipo" name="tipo" class="form-select" onchange="this.form.submit()">
                <option value="">Todos los tipos</option>
                <option value="Single" {{ request('tipo') == 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Twin" {{ request('tipo') == 'Twin' ? 'selected' : '' }}>Twin</option>
                <option value="Doble" {{ request('tipo') == 'Doble' ? 'selected' : '' }}>Doble</option>
                <option value="Triple" {{ request('tipo') == 'Triple' ? 'selected' : '' }}>Triple</option>
                <option value="Cuatruple" {{ request('tipo') == 'Cuatruple' ? 'selected' : '' }}>Cuatruple</option>
            </select>
        </form>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12 order-last order-lg-first">
        <div class="row">
            {{-- cards de las habitaciones --}}
            @foreach($rooms as $room) 
            <div class="col-12 col-md-6 col-xl-4 d-flex flex-column align-items-stretch">
                <div class="card mb-3">
                    <div class="image-container-card">
                        <img src="{{ asset("images/hab1.jpeg") }}" class="img-fluid card-img-top" alt="...">
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title text-center mb-3">{{ $room->nombre }} - {{ $room->tipo }}</h5>
                        <h6 class="text-center mb-3">Desde ${{ $room->precio }}</h6>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary">
                                Ver detalles
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection