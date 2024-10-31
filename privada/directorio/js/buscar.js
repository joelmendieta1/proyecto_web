function buscar() {
    var d1, contenedor, url;
    contenedor = document.getElementById('terapeuta');
    contenedor2 = document.getElementById('terapeuta_selecionada');
    contenedor3 = document.getElementById('terapeuta_insertada');
    d1 = document.formu.nombres.value;
    d2 = document.formu.apellidos.value;
    d3 = document.formu.ci.value;
    d4 = document.formu.profesion.value;
    ajax = nuevoAjax();
    url = 'ajax_buscar_terapeuta.php';
    param = 'nombres='+d1+'&apellidos='+d2+'&ci='+d3+'&profesion='+d4;
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

    function buscar_terapeuta(id_terapeuta) {
    var d1, contenedor, url;
    contenedor = document.getElementById('terapeuta_selecionada');
    contenedor2 = document.getElementById('terapeuta_insertada');
    document.formu.id_terapeuta.value = id_terapeuta;
    d1 = id_terapeuta;
    ajax = nuevoAjax();
    url = 'ajax_buscar_terapeuta1.php';
    param = 'id_terapeuta=' + d1;
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

            function insertar_terapeuta() {
    var d1, contenedor, url;
    contenedor = document.getElementById('terapeuta');
    contenedor2 = document.getElementById('terapeuta_selecionada');
    contenedor3 = document.getElementById('terapeuta_insertada');
    d1 = document.formu.nombres1.value;
    d2 = document.formu.apellidos1.value;
    d3 = document.formu.ci1.value;
    d4 = document.formu.profesion1.value;
    d5 = document.formu.direccion1.value;
    d6 = document.formu.telefono1.value;
    if (d1 == '') {
        alert('El nombre esta vacio');
        document.formu.nombres1.focus();
        return;
    }
    if (d2 == '') {
        alert('El apellido esta vacio');
        document.formu.apellidos1.focus();
        return;
    }
    if (d3 == '') {
        alert('La Cedula esta vacia');
        document.formu.ci1.focus();
        return;
    }
    if (d5 == '') {
        alert('La direccion esta vacia');
        document.formu.direccion1.focus();
        return;
    }
    if (d4 == '') {
        alert('La profesion esta vacia');
        document.formu.profesion1.focus();
        return;
    }
    ajax = nuevoAjax();
    url = 'ajax_insertar_terapeuta.php';
    param = 'nombres1='+ d1+'&apellidos1='+d2+'&ci1='+d3+'&profesion1='+d4+'&direccion1='+d5+'&telefono1='+d5;
    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    alert('se agrego correctamente');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = '';
            contenedor2.innerHTML = '';
            contenedor3.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}