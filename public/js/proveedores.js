/**
 * JavaScript para la vista de Proveedores
 * Validaciones según SQL: nombre(250), direccion(250), telefono(250)
 */

function confirmarEliminar() {
    return confirm("¿Estás seguro de eliminar este proveedor?");
}

function validarFormularioProveedor(form) {
    let valido = true;
    limpiarErrores(form);

    // Nombre (max 250 caracteres)
    const nombre = form.querySelector('[name="txtnombre"]');
    if (!nombre.value.trim()) {
        mostrarError(nombre, 'El nombre es requerido');
        valido = false;
    } else if (nombre.value.length > 250) {
        mostrarError(nombre, 'El nombre no puede exceder 250 caracteres');
        valido = false;
    }

    // Dirección (max 250 caracteres)
    const direccion = form.querySelector('[name="txtdireccion"]');
    if (!direccion.value.trim()) {
        mostrarError(direccion, 'La dirección es requerida');
        valido = false;
    } else if (direccion.value.length > 250) {
        mostrarError(direccion, 'La dirección no puede exceder 250 caracteres');
        valido = false;
    }

    // Teléfono (max 250 caracteres)
    const telefono = form.querySelector('[name="txttelefono"]');
    if (!telefono.value.trim()) {
        mostrarError(telefono, 'El teléfono es requerido');
        valido = false;
    } else if (telefono.value.length > 250) {
        mostrarError(telefono, 'El teléfono no puede exceder 250 caracteres');
        valido = false;
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
    document.querySelectorAll('form').forEach(form => {
        if (form.querySelector('[name="txtnombre"]') && form.querySelector('[name="txtdireccion"]')) {
            form.addEventListener('submit', function(e) {
                if (!validarFormularioProveedor(this)) {
                    e.preventDefault();
                }
            });
        }
    });

    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});

