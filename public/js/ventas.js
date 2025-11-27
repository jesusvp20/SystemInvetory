/**
 * JavaScript para la vista de Ventas
 * Validaciones según SQL: total decimal(10,2), id_cliente int
 */

function confirmarEliminar() {
    return confirm("¿Estás seguro de eliminar esta venta?");
}

// Formatear precio con puntos de miles
function formatearPrecio(input) {
    let valor = input.value.replace(/\./g, '').replace(/[^0-9]/g, '');
    if (valor === '') {
        input.value = '';
        return;
    }
    let numero = parseInt(valor);
    input.value = numero.toLocaleString('es-CO');
}

function obtenerValorPrecio(valorFormateado) {
    return valorFormateado.replace(/\./g, '').replace(/,/g, '.');
}

function validarFormularioVenta(form) {
    let valido = true;
    limpiarErrores(form);

    // Cliente (requerido)
    const cliente = form.querySelector('[name="id_cliente"]') || form.querySelector('[name="txtcliente"]');
    if (cliente && !cliente.value) {
        mostrarError(cliente, 'Debe seleccionar un cliente');
        valido = false;
    }

    // Total (max 99999999.99)
    const total = form.querySelector('[name="txttotal"]') || form.querySelector('[name="total"]');
    if (total) {
        let valorTotal = parseFloat(obtenerValorPrecio(total.value));
        if (isNaN(valorTotal) || valorTotal <= 0) {
            mostrarError(total, 'El total debe ser mayor a 0');
            valido = false;
    } else if (valorTotal > 999999999999) {
        mostrarError(total, 'El total no puede exceder 10.000.000');
        valido = false;
    }
        if (valido && total) {
            total.value = obtenerValorPrecio(total.value);
        }
    }

    // Cantidad (entero positivo)
    const cantidad = form.querySelector('[name="txtcantidad"]') || form.querySelector('[name="cantidad"]');
    if (cantidad) {
        let valorCantidad = parseInt(cantidad.value);
        if (isNaN(valorCantidad) || valorCantidad <= 0) {
            mostrarError(cantidad, 'La cantidad debe ser mayor a 0');
            valido = false;
        }
    }

    return valido;
}

function mostrarError(input, mensaje) {
    input.classList.add('is-invalid');
    let feedback = document.createElement('div');
    feedback.className = 'invalid-feedback';
    feedback.textContent = mensaje;
    input.parentNode.appendChild(feedback);
}

function limpiarErrores(form) {
    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
}

document.addEventListener('DOMContentLoaded', function() {
    // Formato de precios
    document.querySelectorAll('[name="txttotal"], [name="total"], [name="txtprecio"]').forEach(input => {
        if (input.value) {
            let valorInicial = parseFloat(input.value);
            if (!isNaN(valorInicial)) {
                input.value = Math.round(valorInicial).toLocaleString('es-CO');
            }
        }
        input.addEventListener('input', function() {
            formatearPrecio(this);
        });
    });

    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});

