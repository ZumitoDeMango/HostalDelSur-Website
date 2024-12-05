@extends('templates.master')

@section('main-content')
<div class="container mt-4 d-flex justify-content-center align-items-center">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark p-4">
                <div class="card-body">
                    <h3 class="card-title text-center text-white mb-4">Iniciar Sesión</h3>
                    <form method="POST" action="{{ route('admin.submit') }}">
                        @csrf
                        <div class="mb-3">
                        <label for="email" class="form-label text-center text-white">Correo</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="ejemplo@correo.com">
                        </div>
                        
                        <div class="mb-3">
                        <label for="password" class="form-label text-center text-white">Contraseña</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Contraseña">
                        </div>
                        
                        <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>

                        @if ($errors->any())
                            <script>
                                window.onload = function() {
                                    // Mostrar el modal de error
                                    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                                    errorModal.show();
                                }
                            </script>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal de error -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection