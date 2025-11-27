/**
 * JavaScript para la vista de Clientes
 * Validaciones según SQL: nombre(250), identificacion(int UNIQUE), email(250), telefono(bigint)
 */

function confirmarEliminar() {
    return confirm("¿Estás seguro de eliminar este cliente?");
}

function validarFormularioCliente(form) {
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

    // Identificación (entero, único)
    const identificacion = form.querySelector('[name="txtidentificacion"]');
    let valorId = parseInt(identificacion.value);
    if (isNaN(valorId) || valorId <= 0) {
        mostrarError(identificacion, 'La identificación debe ser un número positivo');
        valido = false;
    } else if (valorId > 2147483647) {
        mostrarError(identificacion, 'La identificación excede el límite permitido');
        valido = false;
    }

    // Email (max 250 caracteres, formato válido)
    const email = form.querySelector('[name="txtemail"]');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim()) {
        mostrarError(email, 'El correo electrónico es requerido');
        valido = false;
    } else if (!emailRegex.test(email.value)) {
        mostrarError(email, 'Ingrese un correo electrónico válido');
        valido = false;
    } else if (email.value.length > 250) {
        mostrarError(email, 'El correo no puede exceder 250 caracteres');
        valido = false;
    }

    // Teléfono (bigint)
    const telefono = form.querySelector('[name="txttelefono"]');
    let valorTel = telefono.value.replace(/\D/g, '');
    if (!valorTel) {
        mostrarError(telefono, 'El teléfono es requerido');
        valido = false;
    } else if (valorTel.length > 15) {
        mostrarError(telefono, 'El teléfono no puede exceder 15 dígitos');
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
        if (form.querySelector('[name="txtnombre"]') && form.querySelector('[name="txtidentificacion"]')) {
            form.addEventListener('submit', function(e) {
                if (!validarFormularioCliente(this)) {
                    e.preventDefault();
                }
            });
        }
    });

    // Auto-ocultar alertas
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});

