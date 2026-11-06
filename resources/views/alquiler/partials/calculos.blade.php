<div class="row g-3 mt-1">
    <div class="col-12">
        <div class="alert alert-light border mb-0" role="status">
            <div class="row g-2 text-center text-md-start">
                <div class="col-6 col-md-3">
                    <div class="small text-muted">Días de alquiler</div>
                    <div class="fw-semibold" id="resumenDias">—</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="small text-muted">Seguro por día</div>
                    <div class="fw-semibold" id="resumenTarifa">—</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="small text-muted">Subtotal</div>
                    <div class="fw-semibold" id="resumenSubtotal">—</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="small text-muted">Recargo por retraso</div>
                    <div class="fw-semibold" id="resumenRecargo">—</div>
                </div>
                <div class="col-12">
                    <hr class="my-2">
                    <div class="d-flex justify-content-between fs-5 fw-bold">
                        <span>Total</span>
                        <span id="resumenTotal">—</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('formAlquiler');
        if (!form) {
            return;
        }

        const seguro = form.querySelector('#tipo_seguro');
        const fechaInicio = form.querySelector('#fecha_inicio');
        const fechaDevolucion = form.querySelector('#fecha_devolucion_prevista');
        const fechaDevolucionReal = form.querySelector('#fecha_devolucion_real');
        const duracion = form.querySelector('#duracion_dias');
        const recargo = form.querySelector('#recargo');
        const precioTotal = form.querySelector('#precio_total');
        const tarifaInfo = document.getElementById('tarifaSeguroInfo');
        const resumenDias = document.getElementById('resumenDias');
        const resumenTarifa = document.getElementById('resumenTarifa');
        const resumenSubtotal = document.getElementById('resumenSubtotal');
        const resumenRecargo = document.getElementById('resumenRecargo');
        const resumenTotal = document.getElementById('resumenTotal');
        const botonLimpiar = document.getElementById('btnLimpiarFormulario');
        const milisegundosPorDia = 24 * 60 * 60 * 1000;
        const recargoPorDia = {{ \App\Models\Alquiler::RECARGO_POR_DIA }};

        const formatearMoneda = function (valor) {
            return 'L ' + valor.toFixed(2);
        };

        const tarifaSeleccionada = function () {
            const opcion = seguro.options[seguro.selectedIndex];
            const tarifa = opcion ? parseFloat(opcion.dataset.precio) : 0;

            return Number.isNaN(tarifa) ? 0 : tarifa;
        };

        const calcularDias = function () {
            if (!fechaInicio.value || !fechaDevolucion.value) {
                return null;
            }

            const inicio = new Date(fechaInicio.value + 'T00:00:00');
            const devolucion = new Date(fechaDevolucion.value + 'T00:00:00');

            if (Number.isNaN(inicio.getTime()) || Number.isNaN(devolucion.getTime())) {
                return null;
            }

            if (devolucion < inicio) {
                return 0;
            }

            return Math.max(1, Math.round((devolucion - inicio) / milisegundosPorDia));
        };

        const calcularDiasRetraso = function () {
            if (!fechaDevolucion.value || !fechaDevolucionReal.value) {
                return 0;
            }

            const prevista = new Date(fechaDevolucion.value + 'T00:00:00');
            const real = new Date(fechaDevolucionReal.value + 'T00:00:00');

            if (Number.isNaN(prevista.getTime()) || Number.isNaN(real.getTime())) {
                return 0;
            }

            const dias = Math.round((real - prevista) / milisegundosPorDia);

            return dias > 0 ? dias : 0;
        };

        const limpiarResumen = function () {
            duracion.value = '';
            recargo.value = '0.00';
            precioTotal.value = '';
            resumenDias.textContent = '—';
            resumenTarifa.textContent = '—';
            resumenSubtotal.textContent = '—';
            resumenRecargo.textContent = '—';
            resumenTotal.textContent = '—';
        };

        const actualizarCalculos = function () {
            if (fechaInicio.value) {
                fechaDevolucion.min = fechaInicio.value;
            }

            const tarifa = tarifaSeleccionada();
            const dias = calcularDias();
            const diasRetraso = calcularDiasRetraso();
            const recargoValor = diasRetraso * recargoPorDia;

            if (dias === null) {
                limpiarResumen();
                return;
            }

            const subtotal = dias * tarifa;
            const total = subtotal + recargoValor;

            duracion.value = dias;
            recargo.value = recargoValor.toFixed(2);
            precioTotal.value = total.toFixed(2);

            if (tarifaInfo) {
                tarifaInfo.textContent = 'Precio por día: ' + formatearMoneda(tarifa) + '.';
            }

            resumenDias.textContent = dias + (dias === 1 ? ' día' : ' días');
            resumenTarifa.textContent = formatearMoneda(tarifa);
            resumenSubtotal.textContent = formatearMoneda(subtotal);
            resumenRecargo.textContent = diasRetraso > 0
                ? formatearMoneda(recargoValor) + ' (' + diasRetraso + (diasRetraso === 1 ? ' día' : ' días') + ')'
                : formatearMoneda(0);
            resumenTotal.textContent = formatearMoneda(total);
        };

        seguro.addEventListener('change', actualizarCalculos);
        fechaInicio.addEventListener('change', actualizarCalculos);
        fechaInicio.addEventListener('input', actualizarCalculos);
        fechaDevolucion.addEventListener('change', actualizarCalculos);
        fechaDevolucion.addEventListener('input', actualizarCalculos);
        fechaDevolucionReal.addEventListener('change', actualizarCalculos);
        fechaDevolucionReal.addEventListener('input', actualizarCalculos);

        if (botonLimpiar) {
            botonLimpiar.addEventListener('click', function () {
                form.reset();
                actualizarCalculos();
            });
        }

        actualizarCalculos();
    });
</script>
@endpush
