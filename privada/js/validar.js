// JavaScript para la validación del formulario
(function() {
    'use strict';

    // Selecciona todos los formularios a los que se les aplicará la validación
    var forms = document.querySelectorAll('.needs-validation');

    // Recorrer los formularios y evitar el envío si son inválidos
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
})();
