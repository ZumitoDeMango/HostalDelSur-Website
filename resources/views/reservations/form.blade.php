@extends('templates.master')

@section('main-content')
<div class="container mt-4 mb-4">
    <div class="row">
        <!-- Formulario de Reserva -->
        <div class="col-md-6">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <form method="POST" action="{{ route('reservations.store') }}">
                        @csrf
                        <h3 class="mb-4">Registrar Reserva</h3>

                        <div class="mb-3">
                            <label for="rut_o_pasaporte" class="form-label">RUT (sin puntos y con guión) o Pasaporte</label>
                            <input id="rut_o_pasaporte" name="rut_o_pasaporte" type="text" class="form-control">
                            @error('rut_o_pasaporte')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input id="nombre" name="nombre" type="text" class="form-control">
                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input id="correo" name="correo" type="email" class="form-control">
                            @error('correo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fono" class="form-label">Teléfono</label>
                            <input id="fono" name="fono" type="text" class="form-control">
                            @error('fono')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="info_adicional" class="form-label">Información Adicional (Opcional)</label>
                            <textarea id="info_adicional" name="info_adicional" class="form-control" rows="3"></textarea>
                            @error('info_adicional')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fechas" class="form-label">Fechas</label>
                            <input id="fechas" name="fechas" type="text" class="form-control">
                            @error('fechas')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Pagar</button>
                            <a href="{{ route('rooms.index') }}" class="btn btn-danger text-white">Cancelar</a>
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
                    <div class="image-container-card mb-3">
                        @php
                            $photos = json_decode($room->urlfoto, true);
                        @endphp
                        <img src="{{ asset('storage/' . $photos[0]) }}" class="img-fluid card-img-top" alt="Foto">
                    </div>
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
                    let startDate = selectedDates[0];
                    let endDate = selectedDates[1];

                    // Si la fecha de inicio es posterior a la de fin, intercambiamos las fechas
                    if (startDate > endDate) {
                        // Intercambiar fechas
                        [startDate, endDate] = [endDate, startDate];
                        // Actualizar las fechas seleccionadas en el campo de entrada
                        fechasInput.value = `${formatDate(startDate)} hasta ${formatDate(endDate)}`;
                    }

                    // Calcular la cantidad de noches
                    const totalNoches = Math.max(1, (endDate - startDate) / (1000 * 3600 * 24));
                    totalNochesSpan.textContent = totalNoches;
                    precioTotalSpan.textContent = totalNoches * precioPorNoche;
                }
            }
        });

        // Función para formatear las fechas
        function formatDate(date) {
            return date.getDate().toString().padStart(2, '0') + '-' + (date.getMonth() + 1).toString().padStart(2, '0') + '-' + date.getFullYear();
        }
    });
</script>

@endsection