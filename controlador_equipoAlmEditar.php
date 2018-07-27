<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  $obj = json_decode($_GET["ser"], false);
  $serialAlm=$obj->serial;
  $arrayEquipo=getRegistroEquipoAlm($serialAlm);
  $myJSON = json_encode($arrayEquipo  );
  echo $myJSON;
?>
