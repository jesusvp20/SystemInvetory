/**
 * JavaScript para la vista de Inventario
 * Incluye: validaciones, formato de precios, confirmaciones
 */

// Confirmación de eliminación
function confirmarEliminar() {
    return confirm("¿Estás seguro de eliminar este producto?");
}

// Ordenar productos
function ordenar(campo) {
    let direccion = 'asc';
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('campo') === campo && urlParams.get('direccion') === 'asc') {
        direccion = 'desc';
    }
    window.location.href = `${window.rutaOrdenar}?campo=${campo}&direccion=${direccion}`;
}

// Formatear precio con puntos de miles (1.500.000)
function formatearPrecio(input) {
    let valor = input.value.replace(/\./g, '').replace(/[^0-9]/g, '');
    if (valor === '') {
        input.value = '';
        return;
    }
    let numero = parseInt(valor);
    input.value = numero.toLocaleString('es-CO');
}

// Obtener valor numérico del precio formateado
function obtenerValorPrecio(valorFormateado) {
    return valorFormateado.replace(/\./g, '').replace(/,/g, '.');
}

// Validar formulario de producto antes de enviar
function validarFormularioProducto(form) {
    let valido = true;
    limpiarErrores(form);

    // Nombre (max 250 caracteres, requerido)
    const nombre = form.querySelector('[name="txtname"]');
    if (!nombre.value.trim()) {
        mostrarError(nombre, 'El nombre del producto es requerido');
        valido = false;
    } else if (nombre.value.length > 250) {
        mostrarError(nombre, 'El nombre no puede exceder 250 caracteres');
        valido = false;
    }

    // Descripción (requerido)
    const descripcion = form.querySelector('[name="txtdescripcion"]');
    if (!descripcion.value.trim()) {
        mostrarError(descripcion, 'La descripción es requerida');
        valido = false;
    }

    // Precio (max 99999999.99, requerido)
    const precio = form.querySelector('[name="txtprecio"]');
    let valorPrecio = parseFloat(obtenerValorPrecio(precio.value));
    if (isNaN(valorPrecio) || valorPrecio <= 0) {
        mostrarError(precio, 'El precio debe ser mayor a 0');
        valido = false;
    } else if (valorPrecio > 999999999999) {
        mostrarError(precio, 'El precio no puede exceder 999.999.999.999');
        valido = false;
    }

    // Cantidad (entero positivo, requerido)
    const cantidad = form.querySelector('[name="txtcantidad_disponible"]');
    let valorCantidad = parseInt(cantidad.value);
    if (isNaN(valorCantidad) || valorCantidad < 0) {
        mostrarError(cantidad, 'La cantidad debe ser un número positivo');
        valido = false;
    } else if (valorCantidad > 2147483647) {
        mostrarError(cantidad, 'La cantidad excede el límite permitido');
        valido = false;
    }

    // Categoría (max 50 caracteres, requerido)
    const categoria = form.querySelector('[name="txtcategoria"]');
    if (!categoria.value.trim()) {
        mostrarError(categoria, 'La categoría es requerida');
        valido = false;
    } else if (categoria.value.length > 50) {
        mostrarError(categoria, 'La categoría no puede exceder 50 caracteres');
        valido = false;
    }

    // Proveedor (requerido)
    const proveedor = form.querySelector('[name="txtproveedor"]');
    if (!proveedor.value) {
        mostrarError(proveedor, 'Debe seleccionar un proveedor');
        valido = false;
    }

    // Código del producto (max 50 caracteres, único)
    const codigo = form.querySelector('[name="txtcodigoProducto"]');
    if (codigo && !codigo.readOnly) {
        if (!codigo.value.trim()) {
            mostrarError(codigo, 'El código del producto es requerido');
            valido = false;
        } else if (codigo.value.length > 50) {
            mostrarError(codigo, 'El código no puede exceder 50 caracteres');
            valido = false;
        }
    }

    // Si es válido, convertir precio a formato decimal antes de enviar
    if (valido) {
        precio.value = obtenerValorPrecio(precio.value);
    }

    return valido;
}

// Mostrar mensaje de error en un campo
function mostrarError(input, mensaje) {
    input.classList.add('is-invalid');
    let feedback = document.createElement('div');
    feedback.className = 'invalid-feedback';
    feedback.textContent = mensaje;
    input.parentNode.appendChild(feedback);
}

// Limpiar errores del formulario
function limpiarErrores(form) {
    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
    form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Agregar evento de formato de precio a todos los inputs de precio
    document.querySelectorAll('[name="txtprecio"]').forEach(input => {
        // Formatear valor inicial si existe
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

    // Agregar validación a los formularios
    document.querySelectorAll('form').forEach(form => {
        if (form.querySelector('[name="txtname"]')) {
            form.addEventListener('submit', function(e) {
                if (!validarFormularioProducto(this)) {
                    e.preventDefault();
                }
            });
        }
    });

    // Auto-ocultar alertas después de 5 segundos
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});

