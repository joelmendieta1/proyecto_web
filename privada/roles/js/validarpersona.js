function ValidarPersona(){
    var nombre=document.formu.nombres.value;
    var ci=document.formu.ci.value;
    var paterno=document.formu.ap.value;
    var materno=document.formu.am.value;

    if(ci==""){
        alert("El ci esta vacio");
        document.formu.ci.focus();
        return;
    }
    if((materno=="") && (paterno=="")){
        alert("unos de los apellidos deben ser llenados");
        document.formu.ap.focus();
        return;
    }
    
    if(paterno !=""){
        if(!v1.test(paterno)){
        alert("el apellido paterno es incorrecto");
        document.formu.ap.focus();
        return;  
        }  
    }
    if(materno !=""){
        if(!v1.test(materno)){
        alert("el apellido materno es incorrecto");
        document.formu.am.focus();
        return;  
        }  
    }
    if(!v1.test(nombre)){
        alert("el nombre incorrecto o el campo esta vacio");
        document.formu.nombres.focus();
        return;
    }
    
    document.formu.submit();
}

