function Validarpeluqueria(){
    var nombre=document.formu.nombre.value;
    var telefono=document.formu.telefono.value;
    var direccion=document.formu.direccion.value;

    if(nombre !=""){
        if(!v1.test(nombre)){
        alert("el apellido nombre es incorrecto");
        document.formu.nombre.focus();
        return;  
        }  
    }

    if(telefono==""){
        alert("El telefono esta vacio");
        document.formu.telefono.focus();
        return;
    }
    if(direccion !=""){
        if(!v1.test(direccion)){
        alert("el apellido direccion es incorrecto");
        document.formu.direccion.focus();
        return;  
        }  
    }
    document.formu.submit();
}

