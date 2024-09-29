@extends('templates.master')

@section('main-content')
<div class="row">
    <!-- tabla -->
    <div class="col-12 order-last order-lg-first">
        <div class="row">
            {{-- card habitacion --}}
            <div class="col-12 col-md-6 col-xl-4 d-flex align-items-stretch">
                <div class="card mb-3">
                    <img src="{{ asset("images/hab1.jpeg") }}" class="card-img-top" alt="...">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">Habitacion 1</h5>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-success">
                                Reservar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4 d-flex align-items-stretch">
                <div class="card mb-3">
                    <img src="{{ asset("images/hab2.jpeg") }}" class="card-img-top" alt="...">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">Habitacion 2</h5>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-success">
                                Reservar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-4 d-flex align-items-stretch">
                <div class="card mb-3">
                    <img src="{{ asset("images/hab3.jpeg") }}" class="card-img-top" alt="...">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">Habitacion 3</h5>
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-success">
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