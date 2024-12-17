@extends('templates.master')

@section('main-content')
    <div class="row my-4">
        <h1 class="text-center display-4 fw-bold">Su mejor alternativa en Talca</h1>
        <div id="carousel" class="carousel slide mt-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset("images/hostal2.jpg") }}" class="d-block w-100 img-carousel-home" alt="">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset("images/comedor1.jpg") }}" class="d-block w-100 img-carousel-home" alt="">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset("images/hab1.jpeg") }}" class="d-block w-100 img-carousel-home" alt="">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset("images/comedor2.jpg") }}" class="d-block w-100 img-carousel-home" alt="">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset("images/comedor3.jpg") }}" class="d-block w-100 img-carousel-home" alt="">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endsection