function validar(){
    var categoria=document.formu.Categoria.value;
    var codigo=document.formu.codigo.value;
    var titulo=document.formu.titulo.value;
    var nro_paginas=document.formu.nro_paginas.value;



    if(categoria==''){
        alert('la categoria esta vacia');
        document.formu.Categoria.focus();
        return;
    }
        if(codigo==''){
        alert('el codigo esta vacio');
        document.formu.codigo.focus();
        return;  
    }
    if(titulo==''){
        alert('el titulo esta vacio');
        document.formu.titulo.focus();
        return;
    }
    if(!v2.test(nro_paginas)){
        alert('el nro de pagina tiene que ser entero');
        document.formu.nro_paginas.focus();
        return;
    }
    
    document.formu.submit();
}