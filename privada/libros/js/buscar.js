function buscar() {
    var d1, contenedor, url;
    contenedor = document.getElementById('categoria');
    contenedor2 = document.getElementById('categoria_selecionada');
    contenedor3 = document.getElementById('categoria_insertada');
    d1 = document.formu.Categoria.value;

    ajax = nuevoAjax();
    url = 'ajax_buscar_categoria.php';
    param = 'Categoria=' + d1;
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

    function buscar_categoria(id) {
    var d1, contenedor, url;
    contenedor = document.getElementById('categoria_selecionada');
    contenedor2 = document.getElementById('categoria_insertada');
    document.formu.id.value = id;
    d1 = id;
    ajax = nuevoAjax();
    url = 'ajax_buscar_categoria1.php';
    param = 'id=' + d1;
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

            function insertar_categoria() {
    var d1, contenedor, url;
    contenedor = document.getElementById('categoria');
    contenedor2 = document.getElementById('categoria_selecionada');
    contenedor3 = document.getElementById('categoria_insertada');
    d1 = document.formu.Categoria1.value;
    if (d1 == '') {
        alert('La Categoria esta vacia');
        document.formu.Categoria1.focus();
        return;
    }
    ajax = nuevoAjax();
    url = 'ajax_insertar_categoria.php';
    param = 'Categoria1=' + d1;;
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