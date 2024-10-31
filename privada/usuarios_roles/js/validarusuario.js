function validar(){
    var persona=document.formu.id_persona.value;
    var usuario=document.formu.usuario.value;
    var clave=document.formu.clave.value;

    if(persona==""){
        alert("la persona esta vacio");
        document.formu.id_persona.focus();
        return;
    }
        if(usuario==""){
        alert("el usuario esta incorrecto o vacio");
        document.formu.usuario.focus();
        return;  
        
    }
    if(clave==""){
        alert("la clave esta vacio");
        document.formu.clave.focus();
        return;
    }
    
    document.formu.submit();
}

