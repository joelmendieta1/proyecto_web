"use strict"
function buscar(){
    var d1,d2,d3,d4,ajax,url,param,contenedor;
    contenedor = document.getElementById('citas1');
    d1=document.formu.cliente.value;
    d2=document.formu.empleado.value;
    d3=document.formu.fecha.value;
    d4=document.formu.hora.value;
    ajax=nuevoAjax();
    url="ajax_buscar.php";
    param="cliente="+d1+"&empleado="+d2+"&fecha="+d3+"&hora="+d4;
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

