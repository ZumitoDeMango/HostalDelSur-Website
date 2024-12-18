@extends('templates.master')

@section('main-content')
<div class="container my-4">
    <div class="col-12">
        <h1 class="text-center display-4 fw-bold">Sobre Nosotros</h1>
    </div>
    <div class="row">
        <div class="col-6 mt-4">
            <p>
            En el corazón de Talca, Hostal del Sur te recibe con calidez y autenticidad. Somos un refugio para viajeros que buscan comodidad, hospitalidad y un ambiente familiar en su paso por esta encantadora ciudad.
            </p>
            <p>
            Nuestra misión es brindarte una experiencia memorable, combinando la tranquilidad de un hogar con la vibrante energía de Talca. Aquí encontrarás espacios diseñados para tu descanso, rodeado de la belleza del sur de Chile y la amabilidad de nuestra gente.
            </p>
            <p>
            ¡Haz de Hostal del Sur tu punto de partida para descubrir lo mejor de Talca y sus alrededores!
            </p>
        </div>
        <div class="col-6 mt-4">
            <img src="{{ asset('images/hostal1.jpg') }}" class="img-fluid rounded shadow-sm" alt="">
        </div>
    </div>
</div>
@endsection