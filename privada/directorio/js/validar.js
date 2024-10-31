function validar(){
    var nombres=document.formu.nombres.value;
    var apellidos=document.formu.apellidos.value;
    var ci=document.formu.ci.value;
    var profesion=document.formu.profesion.value;
    var cargos=document.formu.cargos.value;
    var fecha_inicio=document.formu.fecha_inicio.value;


    if(nombres=='' && apellidos=='' && ci=='' && profesion==''){
        alert('llenar dato');
        document.formu.nombres.focus();
        return;
    }
    if(cargos==''){
        alert('El cargo esta vacio');
        document.formu.cargos.focus();
        return;
    }
        if(fecha_inicio==''){
        alert('la fecha inicio esta vacia');
        document.formu.fecha_inicio.focus();
        return;  
    }
    
    document.formu.submit();
}