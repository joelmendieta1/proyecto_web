"use strict"
function buscar(){
    var d1,d2,d3,d4,ajax,url,param,contenedor;
    contenedor = document.getElementById('directorios1');
    d1 = document.formu.terapeuta.options[document.formu.terapeuta.selectedIndex].value;
    d2=document.formu.cargos.value;
    d3=document.formu.fecha_inicio.value;
    ajax=nuevoAjax();
    url="ajax_buscar.php";
    param="terapeuta="+d1+"&cargos="+d2+"&fecha_inicio="+d3;
    //alert(param);
    ajax.open("POST",url,true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4){
            contenedor.innerHTML=ajax.responseText;
        }
    }
    ajax.send(param);
}

