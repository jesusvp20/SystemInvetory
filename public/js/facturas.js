/**
 * JavaScript para la vista de Facturas
 * Validaciones según SQL: numero_factura(50 UNIQUE), total decimal(10,2)
 */

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

function validarFormularioFactura(form) {
    let valido = true;
    limpiarErrores(form);

    // Cliente (requerido)
    const cliente = form.querySelector('[name="cliente_id"]');
    if (cliente && !cliente.value) {
        mostrarError(cliente, 'Debe seleccionar un cliente');
        valido = false;
    }

    // Producto (requerido)
    const producto = form.querySelector('[name="producto_id"]');
    if (producto && !producto.value) {
        mostrarError(producto, 'Debe seleccionar un producto');
        valido = false;
    }

    // Cantidad (entero positivo)
    const cantidad = form.querySelector('[name="cantidad"]');
    if (cantidad) {
        let valorCantidad = parseInt(cantidad.value);
        if (isNaN(valorCantidad) || valorCantidad <= 0) {
            mostrarError(cantidad, 'La cantidad debe ser mayor a 0');
            valido = false;
        }
    }

    // Precio unitario (max 99999999.99)
    const precio = form.querySelector('[name="precio_unitario"]');
    if (precio) {
        let valorPrecio = parseFloat(obtenerValorPrecio(precio.value));
        if (isNaN(valorPrecio) || valorPrecio <= 0) {
            mostrarError(precio, 'El precio debe ser mayor a 0');
            valido = false;
        } else if (valorPrecio > 10000000) {
            mostrarError(precio, 'El precio no puede exceder 10.000.000');
            valido = false;
        }
        if (valido) {
            precio.value = obtenerValorPrecio(precio.value);
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
    document.querySelectorAll('[name="precio_unitario"], [name="total"]').forEach(input => {
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

