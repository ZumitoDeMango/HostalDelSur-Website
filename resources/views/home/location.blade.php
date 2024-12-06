@extends('templates.master')

@section('main-content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center display-4 fw-bold mb-4">Ubicación</h1>
            <p class="text-center text-muted fs-5">Descubre dónde encontrarnos en Talca, Maule</p>
        </div>
    </div>
    <div class="row align-items-center mt-5">
        <!-- Información y foto -->
        <div class="col-lg-6">
            <div class="p-4 border rounded shadow-sm">
                <h2 class="h4 fw-bold mb-3">Hostal del Sur</h2>
                <p class="mb-1 fs-5">Estamos ubicados en:</p>
                <address class="fs-5 text-muted">
                    Av. Lircay 2480<br>
                    3464336 Talca, Maule
                </address>
                <img src="{{ asset('images/hostal2.jpg') }}" class="img-fluid rounded shadow-sm mt-3" alt="Imagen del Hostal del Sur">
            </div>
        </div>
        <!-- Mapa -->
        <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="map-responsive border rounded shadow-sm">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3251.759560969401!2d-71.65273028912074!3d-35.41120987256156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9665c68e0e60266b%3A0xd98f561db9209f85!2sHostal%20del%20Sur!5e0!3m2!1ses!2scl!4v1727596229636!5m2!1ses!2scl" 
                    width="100%" 
                    height="700" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</div>

@endsection