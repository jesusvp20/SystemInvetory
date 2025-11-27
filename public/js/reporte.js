/**
 * JavaScript para la vista de Reportes
 */

document.addEventListener('DOMContentLoaded', function() {
    // Auto-ocultar alertas
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });

    // Validar formulario de subir archivo
    const formReporte = document.querySelector('form[enctype="multipart/form-data"]');
    if (formReporte) {
        formReporte.addEventListener('submit', function(e) {
            const fileInput = this.querySelector('input[type="file"]');
            if (fileInput && !fileInput.files.length) {
                e.preventDefault();
                alert('Debe seleccionar un archivo');
            }
        });
    }
});

