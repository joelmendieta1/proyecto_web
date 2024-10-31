"use strict"
function buscar(){
    var d1,d2,d3,d4,ajax,url,param,contenedor;
    contenedor = document.getElementById('usuarios1');
    d1=document.formu.persona.value;
    d2=document.formu.usuario.value;
    ajax=nuevoAjax();
    url="ajax_buscar.php";
    
    param="persona="+d1+"&usuario="+d2;
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