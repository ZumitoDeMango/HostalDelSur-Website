@extends('templates.master')

@section('main-content')
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Iniciar Sesión</h3>
                        
                        <form>
                            <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="email" placeholder="ejemplo@correo.com" required>
                            </div>
                            
                            <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" placeholder="Contraseña" required>
                            </div>
                            
                            <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                            </div>
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection