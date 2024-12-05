@extends('templates.master')

@section('main-content')
<div class="card text-white bg-dark mt-4">
    <div class="card-body">
        <h3 class="card-title text-center mb-3">ADMINISTRADORES</h3>
        {{-- Tabla de administradores --}}
        <table class="table table-hover align-middle text-center text-white">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Nivel</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->level }}</td>
                    <td>
                        {{-- Verificamos si el usuario tiene permisos para editar --}}
                        @if(Auth::user()->level >= 3 || Auth::user()->id == $user->id)
                            <a href="{{-- {{ route('users.edit', $user->id) }} --}}" 
                               class="btn btn-sm btn-warning text-white" 
                               title="Editar">
                                <span class="material-icons">edit</span>
                            </a>
                        @else
                            <button class="btn btn-sm btn-warning text-white" disabled>
                                <span class="material-icons">edit</span>
                            </button>
                        @endif
                    </td>
                    <td>
                        {{-- Verificamos que no sea el mismo usuario y que tenga permisos para eliminar --}}
                        @if(Auth::user()->level >= 3 && Auth::user()->id != $user->id)
                            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                @csrf
                                @method("delete")
                                <button type="button" 
                                        class="btn btn-sm btn-danger text-white" 
                                        title="Eliminar"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalDelete"
                                        data-bs-user-id="{{ $user->id }}"
                                        data-bs-action="{{ route('users.destroy', $user->id) }}">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>
                        @else
                            <button class="btn btn-sm btn-danger text-white" disabled>
                                <span class="material-icons">delete</span>
                            </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Botón de agregar admin --}}
        @if(Auth::user()->level >= 3)
            <div class="d-grid">
                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalReservation">
                    <span class="material-icons align-middle">add</span>
                    <span class="align-middle">Agregar Admin</span>
                </button>
            </div>
        @else
            <div class="d-grid">
                <button type="button" class="btn btn-primary btn-lg" disabled>
                    <span class="material-icons align-middle">add</span>
                    <span class="align-middle">Agregar Admin</span>
                </button>
            </div>
        @endif
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modalDelete = document.getElementById('modalDelete');
        modalDelete.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Botón que disparó el modal
            var userId = button.getAttribute('data-bs-user-id'); // ID del usuario
            var action = button.getAttribute('data-bs-action'); // Ruta de eliminación

            // Actualizar el formulario del modal
            var deleteForm = modalDelete.querySelector('#deleteForm');
            deleteForm.action = action;
        });
    });
</script>

@endsection