@extends('templates.master')

@section('main-content')
<div class="card text-white bg-dark">
    <div class="card-body">
        <h4 class="card-title text-center">HABITACIONES</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Piso</th>
                    <th>Disponible</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>7</td>
                    <td>Matrimonial</td>
                    <td>40000</td>
                    <td>1</td>
                    <td>Disponible</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning pb-0 text-white" data-bs-toggle="tooltip" data-bs-title="Editar">
                            <span class="material-icons" style="font-size: 20px;">edit</span>
                        </a>
                        <a href="#" class="btn btn-sm btn-danger pb-0 text-white" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                            <span class="material-icons" style="font-size: 20px;">delete</span>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-grid">
            <a class="btn btn-primary" href="#" 
            role="button">Agregar habitacion</a>
        </div>
    </div>
</div>
@endsection