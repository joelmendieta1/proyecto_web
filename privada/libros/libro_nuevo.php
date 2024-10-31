<?php
session_start();
require_once("../../conexion.php");
require_once("../../header.php");

$sql = $db->Prepare("SELECT   Categoria,id_persona
                     FROM     categorias
                     WHERE    estado = 'A'                        
                              ");
$rs = $db->GetAll($sql);
?>
<html>

<head>
  <link href='../../css/bootstrap.min.css' rel='stylesheet' />
  <script type='text/javascript' src='../../ajax.js'></script>
  <script type='text/javascript' src='./js/validar.js'></script>
  <script type='text/javascript' src='./js/buscar.js'></script>
  <script type='text/javascript' src='../js/expresiones_regulares.js'></script>
</head>

<body>
  <br>
  <h2 align='center'>AGREGAR LIBRO</h2>
  <form action='libro_nuevo1.php' method='post' name='formu'>
    <center>
      <div style="border: 1px solid white; width:fit-content;">
        <br>
        <table>
          <tr>
            <td>
                  <label >(*)busque la Categoria del libro</label><br>
                  <input type='text' name='Categoria' value=''  onKeyUp='buscar()'>
            </td>
          </tr>
          <tr>
            <td>
              <div id='categoria'></div>
            </td>
          <tr>
            <td>
              <div id='categoria_selecionada'></div>
            </td>
          </tr>
          <tr>
            <td>
              <input type='hidden' name='id'>
              <div id='categoria_insertada'></div>
            </td>
          </tr>
        </table>
        <table>
          <tr>
            <td>
              <div class="row">
                <div class="col-sm">
                  <label>(*)Codigo</label><br>
                  <input type='text' name='codigo' id='codigo'>
                </div>
                <div class="col-sm">
                  <label>(*)Titulo</label><br>
                  <input type='text' name='titulo' id='titulo'>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="row">
                <div class="col-sm">
                  <label>(*)Nro de Pagina</label><br>
                  <input type='text' name='nro_paginas' id='nro_paginas'>
                </div>
                <div class="col-sm">
                  <label>(*)Editorial</label><br>
                  <input type='text' name='editorial' id='editorial'>
                </div>
              </div>
            </td>
          </tr>
        </table>
        <br>
        <div class='container'>
          <button type='button' class='btn btn-primary' onclick='validar()'>ACEPTAR</button>
          <button type='reset' class='btn btn-secondary'>BORRAR</button>
          <br>(*)Datos Obligatorios
        </div>
        <br>
      </div>
    </center>
  </form>

  <script src='../../js/bootstrap.bundle.min.js'></script>
</body>

</html>