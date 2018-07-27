<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");

  $matriz=getTablaLimitesAlertas();
  $myJSON = json_encode($matriz);
  echo $myJSON;
?>
