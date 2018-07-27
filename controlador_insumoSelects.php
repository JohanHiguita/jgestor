<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");

  $arrayClientes=getTablaNombreClientes();
  $arrayInsumos=getNombreInsumosVend();


  $matriz=array($arrayClientes,$arrayInsumos);
  //$matriz=array("M1","M2");
  $myJSON = json_encode($matriz);
  echo $myJSON;
?>
