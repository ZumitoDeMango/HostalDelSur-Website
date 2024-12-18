@extends('templates.master')

@section('main-content')
<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col-md-6">
            <!-- Formulario de Reserva -->
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
                            <input id="correo" name="correo" type="text" class="form-control">
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
                            <input type="hidden" class="form-control" id="monto" name="monto">
                        </div>

                        <div class="form-group mb-3">
                            <label for="metodo_pago" class="form-label">Método de Pago</label>
                            <select class="form-select" id="metodo_pago" name="metodo_pago">
                                <option value="" selected>Selecciona un método</option>
                                <option value="transferencia">Transferencia Bancaria</option>
                                <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                                <option value="efectivo">Efectivo</option>
                            </select>
                            @error('metodo_pago')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                        </div>

                        <!-- Sección para agregar huéspedes -->
                        <div class="mb-3">
                            <h5>Huéspedes</h5>
                            @error('guests')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div id="guest-list" class="mb-3">
                                <!-- Aquí se mostrarán los huéspedes agregados -->
                            </div>
                            <div class="card p-3 bg-light text-dark">
                                <h6>Nuevo Huésped</h6>
                                <div class="mb-2">
                                    <label for="guest_rut" class="form-label">RUT o Pasaporte</label>
                                    <input type="text" id="guest_rut" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="guest_name" class="form-label">Nombre Completo</label>
                                    <input type="text" id="guest_name" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="guest_email" class="form-label">Correo Electrónico</label>
                                    <input type="email" id="guest_email" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="guest_phone" class="form-label">Teléfono</label>
                                    <input type="text" id="guest_phone" class="form-control">
                                </div>
                                <button type="button" id="add-guest-btn" class="btn btn-primary">Agregar Huésped</button>
                            </div>
                        </div>

                        <!-- Lista de huéspedes en campos ocultos -->
                        <div id="hidden-guest-fields"></div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Reservar</button>
                            <a href="{{ route('rooms.index') }}" class="btn btn-danger text-white">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <!-- Detalles de la Habitación -->
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
                    <p><strong>Precio por noche:</strong> ${{ number_format($room->precio, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Precio Aproximado -->
            <div class="card mt-4">
                <div class="card-header bg-success text-white">
                    <h5>Precio Aproximado</h5>
                </div>
                <div class="card-body">
                    <p><strong>Total de noches:</strong> <span id="totalNoches">0</span></p>
                    <p><strong>Precio total:</strong> $<span id="precioTotal">0</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Calcular precios en tiempo real y controlar el datepicker
    document.addEventListener('DOMContentLoaded', function () {
        const precioPorNoche = {{ $room->precio }};
        const totalNochesSpan = document.getElementById('totalNoches');
        const precioTotalSpan = document.getElementById('precioTotal');
        const fechasInput = document.getElementById('fechas');
        const montoInput = document.getElementById('monto'); // Campo monto a pagar

        // Obtener las fechas ocupadas desde PHP
        const occupiedDates = @json($occupiedDates);

        // Configurar Flatpickr
        flatpickr(fechasInput, {
            mode: "range",
            minDate: "today",
            dateFormat: "d-m-Y",
            locale: {
                rangeSeparator: " hasta "
            },
            disable: occupiedDates,
            onChange: function(selectedDates) {
                // Verifica si se han seleccionado dos fechas
                if (selectedDates.length === 2) {
                    let startDate = selectedDates[0];
                    let endDate = selectedDates[1];

                    // Calcular la cantidad de noches
                    const totalNoches = Math.max(1, (endDate - startDate) / (1000 * 3600 * 24));
                    totalNochesSpan.textContent = totalNoches;

                    // Calcular el precio total y formatearlo
                    const totalPrecio = totalNoches * precioPorNoche;
                    const precioTotalFormateado = totalPrecio.toLocaleString('es-CL'); // Formato chileno

                    // Actualizar la interfaz con los resultados
                    precioTotalSpan.textContent = precioTotalFormateado;

                    // Rellenar automáticamente el campo "Monto a Pagar"
                    montoInput.value = totalPrecio;
                }
            }
        });
    });

    // Adicion de huespedes
    document.addEventListener('DOMContentLoaded', function () {
        const guestList = document.getElementById('guest-list');
        const hiddenGuestFields = document.getElementById('hidden-guest-fields');
        const addGuestBtn = document.getElementById('add-guest-btn');

        addGuestBtn.addEventListener('click', function () {
            const guestRut = document.getElementById('guest_rut').value.trim();
            const guestName = document.getElementById('guest_name').value.trim();
            const guestEmail = document.getElementById('guest_email').value.trim();
            const guestPhone = document.getElementById('guest_phone').value.trim();

            if (!guestRut || !guestName || !guestEmail || !guestPhone) {
                alert('Por favor, complete todos los campos del huésped.');
                return;
            }

            // Crear un elemento para mostrar al huésped
            const guestItem = document.createElement('div');
            guestItem.className = 'alert alert-secondary d-flex justify-content-between align-items-center';
            guestItem.innerHTML = `
                <div>
                    <strong>${guestName}</strong> (${guestRut}) <br>
                    ${guestEmail} - ${guestPhone}
                </div>
                <button type="button" class="btn-close btn-sm" aria-label="Eliminar"></button>
            `;
            guestList.appendChild(guestItem);

            // Agregar campos ocultos para enviar al servidor
            const guestIndex = document.querySelectorAll('#hidden-guest-fields input').length / 4;
            hiddenGuestFields.innerHTML += `
                <input type="hidden" name="guests[${guestIndex}][rut_o_pasaporte]" value="${guestRut}">
                <input type="hidden" name="guests[${guestIndex}][nombre]" value="${guestName}">
                <input type="hidden" name="guests[${guestIndex}][correo]" value="${guestEmail}">
                <input type="hidden" name="guests[${guestIndex}][fono]" value="${guestPhone}">
            `;

            // Limpiar los campos del formulario de huésped
            document.getElementById('guest_rut').value = '';
            document.getElementById('guest_name').value = '';
            document.getElementById('guest_email').value = '';
            document.getElementById('guest_phone').value = '';

            // Botón para eliminar huésped
            guestItem.querySelector('.btn-close').addEventListener('click', function () {
                guestItem.remove();
                hiddenGuestFields.innerHTML = '';
                // Reindexar los campos ocultos
                const guests = document.querySelectorAll('#guest-list .alert');
                guests.forEach((guest, index) => {
                    const inputs = guest.querySelectorAll('input[type="hidden"]');
                    inputs.forEach(input => {
                        input.name = input.name.replace(/\d+/, index);
                    });
                });
            });
        });
    });
</script>

@endsection