@extends('templates.master')

@section('main-content')
<div class="card text-white bg-dark mt-4">
    <div class="card-body">
        <h3 class="card-title text-center mb-3">ADMINISTRADORES</h3>
        {{-- Tabla de administradores --}}
        <table class="table table-hover align-middle text-center text-white">
            <thead class="table-dark">
                <tr>
                    <th>RUT</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Nivel</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->rut }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->level }}</td>
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
                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalAddUser">
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

<div class="modal fade" id="modalAddUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserLabel">Agregar Nuevo Administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUserForm" method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rut" class="form-label">RUT</label>
                        <input type="text" class="form-control" id="rut" name="rut" placeholder="Ingrese el RUT">
                        @error('rut')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese el correo">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese la contraseña">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Nivel</label>
                        <select class="form-select" id="level" name="level">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modal = new bootstrap.Modal(document.getElementById('modalAddUser'));
            modal.show();
        });
    </script>
@endif

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