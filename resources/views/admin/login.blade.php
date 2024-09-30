@extends('templates.master')

@section('main-content')
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark p-4">
                <div class="card-body">
                    <h3 class="card-title text-center text-white mb-4">Iniciar Sesión</h3>
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="mb-3">
                        <label for="email" class="form-label text-center text-white">Correo</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="ejemplo@correo.com" required>
                        </div>
                        
                        <div class="mb-3">
                        <label for="password" class="form-label text-center text-white">Contraseña</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Contraseña" required>
                        </div>
                        
                        <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection