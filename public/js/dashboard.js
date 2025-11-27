/**
 * JavaScript para el Dashboard
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

    // Animación de contadores
    document.querySelectorAll('.contador').forEach(contador => {
        const valorFinal = parseInt(contador.textContent);
        let valorActual = 0;
        const incremento = Math.ceil(valorFinal / 50);
        const intervalo = setInterval(() => {
            valorActual += incremento;
            if (valorActual >= valorFinal) {
                contador.textContent = valorFinal;
                clearInterval(intervalo);
            } else {
                contador.textContent = valorActual;
            }
        }, 20);
    });
});

