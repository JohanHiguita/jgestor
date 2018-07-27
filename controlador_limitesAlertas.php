<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");

  $limites=getTablaLimitesAlertas();
  
  $myJSON = json_encode($limites);
  echo $myJSON;
?>
