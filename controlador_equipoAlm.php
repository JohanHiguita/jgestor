<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  $obj = json_decode($_GET["seralm"], false);
  $serialAlm=$obj->serial;
  $arrayEquipos=getRegistroEquipoAlm($serialAlm);
  $myJSON = json_encode($arrayEquipos);
  echo $myJSON;
?>
