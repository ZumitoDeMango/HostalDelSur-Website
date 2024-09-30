@extends('templates.master')

@section('main-content')
<div class="row">
    <!-- tabla -->
    <div class="col-12 order-last order-lg-first">
        <div class="row">
            {{-- card habitacion --}}
            <div class="col-12 col-md-6 col-xl-4 d-flex flex-column p-3 align-items-stretch">
                <div class="card mb-3">
                    <div class="image-container-card">
                        <img src="{{ asset("images/hab1.jpeg") }}" class="img-fluid card-img-top" alt="...">
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">Habitacion 1</h5>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-primary">
                                Reservar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4 d-flex flex-column p-3 align-items-stretch">
                <div class="card mb-3">
                    <div class="image-container-card">
                        <img src="{{ asset("images/hab2.jpeg") }}" class="img-fluid card-img-top" alt="...">
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">Habitacion 2</h5>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-primary">
                                Reservar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4 d-flex flex-column p-3 align-items-stretch">
                <div class="card mb-3">
                    <div class="image-container-card">
                        <img src="{{ asset("images/hab3.jpeg") }}" class="img-fluid card-img-top" alt="...">
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">Habitacion 3</h5>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-primary">
                                Reservar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection