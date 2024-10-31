function buscarC() {
    var d1, contenedor, url;
    contenedor = document.getElementById('cliente');
    contenedor2 = document.getElementById('cliente_selecionada');
    contenedor3 = document.getElementById('cliente_insertada');
    d1 = document.formu.cliente.options[document.formu.cliente.selectedIndex].value;
    ajax = nuevoAjax();
    url = 'ajax_buscar_cliente.php';
    param = 'cliente='+d1;
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

    function buscar_cliente(id_cliente) {
    var d1, contenedor, url;
    contenedor = document.getElementById('cliente_selecionada');
    contenedor2 = document.getElementById('cliente_insertada');
    document.formu.id_cliente.value = id_cliente;
    d1 = id_cliente;
    ajax = nuevoAjax();
    url = 'ajax_buscar_cliente1.php';
    param = 'id_cliente=' + d1;
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

function insertar_cliente() {
    var d1, contenedor, url;
    contenedor = document.getElementById('cliente');
    contenedor2 = document.getElementById('cliente_selecionada');
    contenedor3 = document.getElementById('cliente_insertada');
    d1 = document.formu.tipo1.value;
    d2 = document.formu.nombre1.value;
    d3 = document.formu.apellido1.value;
    d4 = document.formu.telefono1.value;
    d5 = document.formu.genero1.value;
    if (d1 == '') {
        alert('El tipo de cliente esta vacio');
        document.formu.tipo1.focus();
        return;
    }
    if (d2 == '') {
        alert('El nombre esta vacio');
        document.formu.nombre1.focus();
        return;
    }
    if (d3 == '') {
        alert('El apellido esta vacio');
        document.formu.apellido1.focus();
        return;
    }
    if (d4 == '') {
        alert('El telefono esta vacio');
        document.formu.telefono1.focus();
        return;
    }
    if (d5 == '') {
        alert('el genero esta vacio');
        document.formu.genero1.focus();
        return;
    }
    ajax = nuevoAjax();
    url = 'ajax_insertar_cliente.php';
    param = 'tipo1='+ d1+'&nombre1='+d2+'&apellido1='+d3+'&telefono1='+d4+'&genero1='+d5;
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