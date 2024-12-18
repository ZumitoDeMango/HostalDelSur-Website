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
@if(session('success'))
    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Su reserva ha sido registrada con éxito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ session('success')['message'] }}</p>
                    <ul>
                        <li><strong>Habitación:</strong> {{ session('success')['habitacion'] }}</li>
                        <li><strong>Desde:</strong> {{ session('success')['fecha_inicio'] }}</li>
                        <li><strong>Hasta:</strong> {{ session('success')['fecha_fin'] }}</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para mostrar el modal automáticamente -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        });
    </script>
@endif
@endsection