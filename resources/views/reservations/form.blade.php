@extends('templates.master')

@section('main-content')
<div class="container mt-4">
    <div class="row">
        <!-- Formulario de Reserva -->
        <div class="col-md-6">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <form method="POST" action="/reservas/guardar">

                        <h3 class="mb-4">Registrar Reserva</h3>

                        <div class="mb-3">
                            <label for="rut_o_pasaporte" class="form-label">RUT o Pasaporte</label>
                            <input id="rut_o_pasaporte" name="rut_o_pasaporte" type="text" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input id="nombre" name="nombre" type="text" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input id="correo" name="correo" type="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="fono" class="form-label">Teléfono</label>
                            <input id="fono" name="fono" type="text" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="info_adicional" class="form-label">Información Adicional (Opcional)</label>
                            <textarea id="info_adicional" name="info_adicional" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="fechas" class="form-label">Fechas</label>
                            <input id="fechas" name="fechas" type="text" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Registrar</button>
                            <a href="/habitaciones" class="btn btn-warning text-white">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Detalles de la Habitación -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5>Detalles de la Habitación</h5>
                </div>
                <div class="card-body">
                    <!-- Información de la habitación -->
                    <p><strong>Nombre:</strong> {{ $room->nombre }}</p>
                    <p><strong>Tipo:</strong> {{ $room->type->nombre }}</p>
                    <p><strong>Descripción:</strong> {{ $room->descripcion }}</p>
                    <p><strong>Precio por noche:</strong> ${{ $room->precio }}</p>
                </div>
            </div>

            <!-- Precio Aproximado -->
            <div class="card mt-4">
                <div class="card-header bg-success text-white">
                    <h5>Precio Aproximado</h5>
                </div>
                <div class="card-body">
                    <p><strong>Total de noches:</strong> <span id="totalNoches">1</span></p>
                    <p><strong>Precio total:</strong> $<span id="precioTotal">{{ $room->precio }}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const precioPorNoche = {{ $room->precio }};
        const totalNochesSpan = document.getElementById('totalNoches');
        const precioTotalSpan = document.getElementById('precioTotal');
        const fechasInput = document.getElementById('fechas');

        // Configuración de Flatpickr para seleccionar las fechas
        flatpickr(fechasInput, {
            mode: "range",
            minDate: "today",
            dateFormat: "d-m-Y",
            locale: {
                rangeSeparator: " hasta "
            },
            onChange: function(selectedDates) {
                // Verifica si se han seleccionado dos fechas
                if (selectedDates.length === 2) {
                    // Calcula la cantidad de noches
                    const startDate = selectedDates[0];
                    const endDate = selectedDates[1];
                    const totalNoches = Math.max(1, (endDate - startDate) / (1000 * 3600 * 24));
                    totalNochesSpan.textContent = totalNoches;
                    precioTotalSpan.textContent = totalNoches * precioPorNoche;
                }
            }
        });
    });
</script>

@endsection