function buscarR() {
    var d1 = document.formu.rubro.value;
    var contenedor = document.getElementById('categoria');
    var ajax = nuevoAjax();
    var url = 'ajax_buscar_rubro.php';
    var param = 'rubro=' + d1;

    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}
function buscarCategorias() {
    var rubroId = document.formu.rubro.value;
    var contenedorCategoria = document.getElementById('categoriaContainer');
    var contenedorActivos = document.getElementById('activosContainer');

    contenedorCategoria.innerHTML = '';
    contenedorActivos.innerHTML = '';

    if (rubroId) {
        var ajax = nuevoAjax();
        var url = 'ajax_buscar_rubro.php';
        var param = 'rubro=' + rubroId;

        ajax.open('POST', url, true);
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                contenedorCategoria.innerHTML = ajax.responseText;
            }
        };
        ajax.send(param);
    }
}
function listarActivos() {
    var categoria_id = document.formu.categoria.value;
    var contenedor = document.getElementById('activosContainer');
    var ajax = nuevoAjax();
    var url = 'ajax_listar_activos.php';
    var param = 'categoria=' + categoria_id;

    ajax.open('POST', url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            contenedor.innerHTML = ajax.responseText;
        }
    }
    ajax.send(param);
}

