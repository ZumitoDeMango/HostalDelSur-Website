@extends('templates.master')

@section('main-content')
<div class="row">
    <h1 class="text-center">Ubicación</h1>
    <div class="col-6">
        <p>Nos encontramos en</p>
        <p>Av. Lircay 2480, 3464336 Talca, Maule</p>
        <img src="{{ asset("images/hostal2.jpg") }}" class="img-fluid" alt="">
    </div>
    <div class="col-6">
        <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3251.759560969401!2d-71.65273028912074!3d-35.41120987256156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9665c68e0e60266b%3A0xd98f561db9209f85!2sHostal%20del%20Sur!5e0!3m2!1ses!2scl!4v1727596229636!5m2!1ses!2scl" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
@endsection