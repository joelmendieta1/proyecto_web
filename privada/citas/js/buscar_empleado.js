function buscarE() {
    var d1, contenedor, url;
    contenedor = document.getElementById('empleado');
    contenedor2 = document.getElementById('empleado_selecionada');
    contenedor3 = document.getElementById('empleado_insertada');
    d1 = document.formu.empleado.options[document.formu.empleado.selectedIndex].value;
    ajax = nuevoAjax();
    url = 'ajax_buscar_empleado.php';
    param = 'empleado='+d1;
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
            contenedor2.innerHTML = '';
            contenedor3.innerHTML = '';
        }
    }
    ajax.send(param);
}

    function buscar_empleado(id_empleado) {
    var d1, contenedor, url;
    contenedor = document.getElementById('empleado_selecionada');
    contenedor2 = document.getElementById('empleado_insertada');
    document.formu.id_empleado.value = id_empleado;
    d1 = id_empleado;
    ajax = nuevoAjax();
    url = 'ajax_buscar_empleado1.php';
    param = 'id_empleado=' + d1;
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
            contenedor2.innerHTML = '';
        }
    }
    ajax.send(param);
}

function insertar_empleado() {
    var d1, contenedor, url;
    contenedor = document.getElementById('empleado');
    contenedor2 = document.getElementById('empleado_selecionada');
    contenedor3 = document.getElementById('empleado_insertada');
    d1 = document.formu.nombre1.value;
    d2 = document.formu.ap1.value;
    d3 = document.formu.am1.value;
    d4 = document.formu.ci1.value;
    d5 = document.formu.telefono2.value;
    d6 = document.formu.fecha_inicio1.value;
    d7 = document.formu.fecha_fin1.value;
    if (d1 == '') {
        alert('El nombre esta vacio');
        document.formu.nombre1.focus();
        return;
    }
    if (d2 == '') {
        alert('El apellido paterno esta vacio');
        document.formu.ap1.focus();
        return;
    }
    if (d3 == '') {
        alert('El apellido materno esta vacio');
        document.formu.am1.focus();
        return;
    }
    if (d4 == '') {
        alert('El ci esta vacio');
        document.formu.ci1.focus();
        return;
    }
    if (d5 == '') {
        alert('el telefono esta vacio');
        document.formu.telefono2.focus();
        return;
    }
    if (d6 == '') {
        alert('La fecha esta vacia');
        document.formu.fecha_inicio1.focus();
        return;
    }
    ajax = nuevoAjax();
    url = 'ajax_insertar_empleado.php';
    param = 'nombre1='+ d1+'&ap1='+d2+'&am1='+d3+'&ci1='+d4+'&telefono2='+d5+'&fecha_inicio1='+d6+'&fecha_fin1='+d7;
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    alert('se agrego correctamente');
    setTimeout(function() {
        location.reload();
    }, 1000);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = '';
            contenedor2.innerHTML = '';
            contenedor3.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);

}