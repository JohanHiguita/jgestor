<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  $obj = json_decode($_GET["cod"], false);
  $cc_empleado=$obj->cedula;
  $arrayEmpleado=getRegistroEmpleado($cc_empleado);
  $myJSON = json_encode($arrayEmpleado);
  echo $myJSON;
?>
