<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  $obj = json_decode($_GET["ser"], false);
  $cod=$obj->serial;
  $arrayCliente=getRegistroCliente($cod);
  $arrayTels=getRegTelsCliente($cod);
  $arrayCorreos=getRegCorreosCliente($cod);
  $matrizDatos= array($arrayCliente,$arrayTels,$arrayCorreos);
  $myJSON = json_encode($matrizDatos);
  echo $myJSON;
?>
