var v1 = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*$/;

var v2 = /^[0-9]*$/; //VALIDACION DE NUMEROS ENTEROS POSITIVOS//

var v22 = /^[0-9]+[\.]?[0-9]*$/; //VALIDACION DE NUMEROS POSITIVOS INCLUIDOS LOS DECIMALES 

var v222 = /^[-]?[0-9]+[\.]?[0-9]*$/;

var v3 = /\S+@\S+\.\S+/; //VALIDACION CORREO

function ValidarPersona() {
    var nombres = document.formu.nombres.value;
    var ci = document.formu.ci.value;
    var paterno = document.formu.ap.value;
    var materno = document.formu.am.value;

    // Restablecer todos los bordes y mensajes de error
    resetBorders();
    clearMessages();

    var errors = []; // Array para acumular los errores

    // Validar el campo CI
    if (ci == "") {
        document.formu.ci.style.border = "2px solid red";
        errors.push({ field: 'tci', message: "El campo CI no puede estar vacío." });
    }

    // Validar que al menos uno de los apellidos esté lleno
    if (paterno === "" && materno === "") {
        document.formu.ap.style.border = "2px solid red";
        document.formu.am.style.border = "2px solid red";
        errors.push({ field: 'tpaterno', message: "Uno de los apellidos debe ser llenado." });
        errors.push({ field: 'tmaterno', message: "Uno de los apellidos debe ser llenado." });
    }
    
    // Validar apellido paterno si no está vacío
    if (paterno !== "") {
        if (!v1.test(paterno)) {
            document.formu.ap.style.border = "2px solid red";
            errors.push({ field: 'tpaterno', message: "El apellido paterno es incorrecto." });
        }  
    }
    
    // Validar apellido materno si no está vacío
    if (materno !== "") {
        if (!v1.test(materno)) {
            document.formu.am.style.border = "2px solid red";
            errors.push({ field: 'tmaterno', message: "El apellido materno es incorrecto." });
        }  
    }
    if (!v1.test(nombres)) {
        document.formu.nombres.style.border = "2px solid red";
        errors.push({ field: 'tnombres', message: "El nombre es incorrecto o el campo está vacío." });
    } 

    // Mostrar todos los errores acumulados
    if (errors.length > 0) {
        errors.forEach(function(error) {
            showMessage(error.field, error.message);
        });
        return false; // Evitar el envío del formulario
    }

    // Enviar el formulario si no hay errores
    document.formu.submit();
    function resetBorders() {
        document.formu.ci.style.border = "";
        document.formu.ap.style.border = "";
        document.formu.am.style.border = "";
        document.formu.nombres.style.border = "";
    }
    
    // Función para limpiar los mensajes de error
    function clearMessages() {
        const messages = document.querySelectorAll("p[name]");
        messages.forEach(paragraph => {
            paragraph.textContent = "";
        });
    }
    
    // Función para mostrar mensajes de error
    function showMessage(fieldName, message) {
        const paragraph = document.querySelector(`p[name='${fieldName}']`);
        paragraph.style.color = "red";
        paragraph.textContent = message;
    }
}

function ValidarEmpleado() {
    var nombre = document.formu.nombre.value;
    var ci = document.formu.ci.value;
    var paterno = document.formu.ap.value;
    var materno = document.formu.am.value;
    var telefono = document.formu.telefono.value;
    var fecha_inicio = document.formu.fecha_inicio.value;

    // Restablecer todos los bordes y mensajes de error
    resetBorders();
    clearMessages();

    var errors = []; // Array para acumular los errores

    // Validar el campo CI
    if (ci == "") {
        document.formu.ci.style.border = "2px solid red";
        errors.push({ field: 'tci', message: "El campo CI no puede estar vacío." });
    }

    // Validar que al menos uno de los apellidos esté lleno
    if (paterno === "" && materno === "") {
        document.formu.ap.style.border = "2px solid red";
        document.formu.am.style.border = "2px solid red";
        errors.push({ field: 'tpaterno', message: "Uno de los apellidos debe ser llenado." });
        errors.push({ field: 'tmaterno', message: "Uno de los apellidos debe ser llenado." });
    }
    
    // Validar apellido paterno si no está vacío
    if (paterno !== "") {
        if (!v1.test(paterno)) {
            document.formu.ap.style.border = "2px solid red";
            errors.push({ field: 'tpaterno', message: "El apellido paterno es incorrecto." });
        }  
    }
    
    // Validar apellido materno si no está vacío
    if (materno !== "") {
        if (!v1.test(materno)) {
            document.formu.am.style.border = "2px solid red";
            errors.push({ field: 'tmaterno', message: "El apellido materno es incorrecto." });
        }  
    }
    
    // Validar nombre
if (!v1.test(nombre)) {
            document.formu.nombre.style.border = "2px solid red";
            errors.push({ field: 'tnombre', message: "El nombre es incorrecto." });
        } 

        if (telefono == "") {
            document.formu.telefono.style.border = "2px solid red";
            errors.push({ field: 'ttelefono', message: "El Telefono campo está vacío o incorecto." });
        }
    if (!v2.test(telefono)) {
        document.formu.telefono.style.border = "2px solid red";
        errors.push({ field: 'ttelefono', message: "El Telefono campo está vacío o incorecto." });
    }
    if (fecha_inicio == "") {
        document.formu.fecha_inicio.style.border = "2px solid red";
        errors.push({ field: 'tfecha_inicio', message: "La fecha esta vacia." });
    }

    // Mostrar todos los errores acumulados
    if (errors.length > 0) {
        errors.forEach(function(error) {
            showMessage(error.field, error.message);
        });
        return false; // Evitar el envío del formulario
    }

    // Enviar el formulario si no hay errores
    document.formu.submit();
    function resetBorders() {
        document.formu.ci.style.border = "";
        document.formu.ap.style.border = "";
        document.formu.am.style.border = "";
        document.formu.nombre.style.border = "";
        document.formu.telefono.style.border = "";
        document.formu.fecha_inicio.style.border = "";
    }
    
    // Función para limpiar los mensajes de error
    function clearMessages() {
        const messages = document.querySelectorAll("p[name]");
        messages.forEach(paragraph => {
            paragraph.textContent = "";
        });
    }
    
    // Función para mostrar mensajes de error
    function showMessage(fieldName, message) {
        const paragraph = document.querySelector(`p[name='${fieldName}']`);
        paragraph.style.color = "red";
        paragraph.textContent = message;
    }
}
function ValidarCategoria() {
    var nombre = document.formu.nombre.value;

    // Restablecer todos los bordes y mensajes de error
    resetBorders();
    clearMessages();

    var errors = []; // Array para acumular los errores


    
    // Validar nombre
    if (!v1.test(nombre)) {
        document.formu.nombre.style.border = "2px solid red";
        errors.push({ field: 'tnombre', message: "El nombre es incorrecto o esta vacio." });
    } 


    // Mostrar todos los errores acumulados
    if (errors.length > 0) {
        errors.forEach(function(error) {
            showMessage(error.field, error.message);
        });
        return false; // Evitar el envío del formulario
    }

    // Enviar el formulario si no hay errores
    document.formu.submit();
    function resetBorders() {
        document.formu.nombre.style.border = "";
    }
    
    // Función para limpiar los mensajes de error
    function clearMessages() {
        const messages = document.querySelectorAll("p[name]");
        messages.forEach(paragraph => {
            paragraph.textContent = "";
        });
    }
    
    // Función para mostrar mensajes de error
    function showMessage(fieldName, message) {
        const paragraph = document.querySelector(`p[name='${fieldName}']`);
        paragraph.style.color = "red";
        paragraph.textContent = message;
    }
}

function ValidarPropietario() {
    var nombre = document.formu.nombre.value;
    var telefono = document.formu.telefono.value;
    var apellido = document.formu.apellido.value;

    // Restablecer todos los bordes y mensajes de error
    resetBorders();
    clearMessages();

    var errors = []; // Array para acumular los errores
    
    
    if (!v1.test(apellido)) {
        document.formu.apellido.style.border = "2px solid red";
        errors.push({ field: 'tapellido', message: "El apellido es incorrecto." });
    }
    if (apellido == "") {
        document.formu.apellido.style.border = "2px solid red";
      errors.push({ field: 'tapellido', message: "El apellido esta vacio." });
  }

    if (!v1.test(nombre)) {
        document.formu.nombre.style.border = "2px solid red";
        errors.push({ field: 'tnombre', message: "El nombre es incorrecto o esta vacio." });
    } 

    if (telefono == "") {
        document.formu.telefono.style.border = "2px solid red";
        errors.push({ field: 'ttelefono', message: "El Telefono campo está vacío o incorecto." });
    }
if (!v2.test(telefono)) {
    document.formu.telefono.style.border = "2px solid red";
    errors.push({ field: 'ttelefono', message: "El Telefono campo está vacío o incorecto." });
}

    // Mostrar todos los errores acumulados
    if (errors.length > 0) {
        errors.forEach(function(error) {
            showMessage(error.field, error.message);
        });
        return false; // Evitar el envío del formulario
    }

    // Enviar el formulario si no hay errores
    document.formu.submit();
    function resetBorders() {
        document.formu.nombre.style.border = "";
        document.formu.telefono.style.border = "";
        document.formu.apellido.style.border = "";
    }
    
    // Función para limpiar los mensajes de error
    function clearMessages() {
        const messages = document.querySelectorAll("p[name]");
        messages.forEach(paragraph => {
            paragraph.textContent = "";
        });
    }
    
    // Función para mostrar mensajes de error
    function showMessage(fieldName, message) {
        const paragraph = document.querySelector(`p[name='${fieldName}']`);
        paragraph.style.color = "red";
        paragraph.textContent = message;
    }
}
function ValidarPromocion() {
    var descuento = document.formu.descuento.value;
    var descripcion = document.formu.descripcion.value;
    var fecha_inicio = document.formu.fecha_inicio.value;
    var fecha_fin = document.formu.fecha_fin.value;

    // Restablecer todos los bordes y mensajes de error
    resetBorders();
    clearMessages();

    var errors = []; // Array para acumular los errores
    
    // Validar nombre
    if (descuento == "") {
        document.formu.descuento.style.border = "2px solid red";
        errors.push({ field: 'tdescuento', message: "El descuento es incorrecto o el campo está vacío." });
    }
    if (!v2.test(descuento)) {
        document.formu.descuento.style.border = "2px solid red";
        errors.push({ field: 'tdescuento', message: "El descuento es incorrecto o el campo está vacío." });
    }
    if (descripcion == "") {
        document.formu.descripcion.style.border = "2px solid red";
        errors.push({ field: 'tdescripcion', message: "La descripcion es incorrecta o el campo está vacío." });
    }

    if (fecha_inicio == "") {
        document.formu.fecha_inicio.style.border = "2px solid red";
        errors.push({ field: 'tfecha_inicio', message: "La fecha inicio campo está vacío." });
    }
    if (fecha_fin == "") {
        document.formu.fecha_fin.style.border = "2px solid red";
        errors.push({ field: 'tfecha_fin', message: "La fecha fin campo está vacío." });
    }

    // Mostrar todos los errores acumulados
    if (errors.length > 0) {
        errors.forEach(function(error) {
            showMessage(error.field, error.message);
        });
        return false; // Evitar el envío del formulario
    }

    // Enviar el formulario si no hay errores
    document.formu.submit();
    function resetBorders() {
        document.formu.descuento.style.border = "";
        document.formu.descripcion.style.border = "";
        document.formu.fecha_fin.style.border = "";
        document.formu.fecha_inicio.style.border = "";
    }
    
    // Función para limpiar los mensajes de error
    function clearMessages() {
        const messages = document.querySelectorAll("p[name]");
        messages.forEach(paragraph => {
            paragraph.textContent = "";
        });
    }
    
    // Función para mostrar mensajes de error
    function showMessage(fieldName, message) {
        const paragraph = document.querySelector(`p[name='${fieldName}']`);
        paragraph.style.color = "red";
        paragraph.textContent = message;
    }
}


