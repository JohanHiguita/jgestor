<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  $obj = json_decode($_GET["ser"], false);
  $cc=$obj->serial;
  $arrayEmpleado=getRegistroEmpleado($cc);
  $myJSON = json_encode($arrayEmpleado);
  echo $myJSON;
?>
