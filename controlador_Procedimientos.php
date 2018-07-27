<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  $obj = json_decode($_GET["cod"], false);
  $cod=$obj->codigo;
  $arrayEquipos=getRegistroProcedimiento($cod);
  $myJSON = json_encode($arrayEquipos);
  echo $myJSON;
?>
