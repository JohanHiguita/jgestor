<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");

  $obj = json_decode($_GET["cod"], false);
  $cod=$obj->cod;

  $arrayClientes=getTablaNombreClientes();
  $arrayInsumo=getRegistroInsumoAlm($cod);
  $matrizResultado=array($arrayClientes,$arrayInsumo);

  $myJSON = json_encode($matrizResultado);
  echo $myJSON;
?>
