"use strict"

var v1 = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*$/;

var v2 = /^[0-9]*$/; //VALIDACION DE NUMEROS ENTEROS POSITIVOS//

var v22 = /^[0-9]+[\.]?[0-9]*$/; //VALIDACION DE NUMEROS POSITIVOS INCLUIDOS LOS DECIMALES 

var v222 = /^[-]?[0-9]+[\.]?[0-9]*$/;

var v3 = /\S+@\S+\.\S+/; //VALIDACION CORREO