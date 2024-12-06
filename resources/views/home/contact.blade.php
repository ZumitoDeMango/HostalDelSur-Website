@extends('templates.master')

@section('main-content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 p-3 rounded">
                <h5 class="text-center display-4 fw-bold mb-4">Información de Contacto</h5>
                <div class="list-group">
                    <div class="list-group-item copy-text d-flex justify-content-between align-items-center py-3" data-copy="Hostaldelsur@gmail.com">
                        <span><strong>Correo:</strong> Hostaldelsur@gmail.com</span>
                        <i class="fas fa-copy text-primary copy-icon" style="cursor: pointer;"></i>
                    </div>
                    <div class="list-group-item copy-text d-flex justify-content-between align-items-center py-3" data-copy="9 8535 3488">
                        <span><strong>Celular y WhatsApp:</strong> 9 8535 3488</span>
                        <i class="fas fa-copy text-primary copy-icon" style="cursor: pointer;"></i>
                    </div>
                    <div class="list-group-item copy-text d-flex justify-content-between align-items-center py-3" data-copy="71 2713 971">
                        <span><strong>Fono Fijo:</strong> 71 2713 971</span>
                        <i class="fas fa-copy text-primary copy-icon" style="cursor: pointer;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos adicionales -->
<style>
    .copy-text:hover {
        background-color: #f8f9fa;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .copy-icon {
        transition: transform 0.3s ease, color 0.3s ease;
    }
    .copy-icon:hover {
        transform: scale(1.2);
        color: #28a745;
    }
    .alert {
        font-weight: bold;
        border-radius: 10px;
    }
</style>

<!-- Script -->
<script>
    document.querySelectorAll('.copy-text').forEach(element => {
        element.addEventListener('click', () => {
            const textToCopy = element.getAttribute('data-copy');
            const icon = element.querySelector('i');
            const originalIconClass = icon.className;

            // Copiar al portapapeles
            navigator.clipboard.writeText(textToCopy).then(() => {
                // Cambiar ícono temporalmente
                icon.className = 'fas fa-check-circle text-success';
                // Mostrar mensaje
                const message = document.getElementById('copy-message');
                message.style.display = 'block';

                // Restaurar después de 2 segundos
                setTimeout(() => {
                    message.style.display = 'none';
                    icon.className = originalIconClass;
                }, 2000);
            }).catch(err => {
                console.error('Error al copiar al portapapeles:', err);
            });
        });
    });
</script>

@endsection