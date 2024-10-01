@extends('templates.master')

@section('main-content')
<div class="card text-white bg-dark mt-4">
    <div class="card-body">
        <div class="row">
            <div class="col-9">
                <h3>Editar {{ $room->nombre }}</h3>
            </div>
            <div class="col-3 d-flex align-items-center justify-content-end">
                <a href="{{ route('rooms.admin') }}" class="btn btn-warning text-white">Regresar</a>
            </div>
        </div>
    </div>
</div>
@endsection