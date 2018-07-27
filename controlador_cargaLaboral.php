<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");

  $arrayPrevs=getTablaCarga(1);
  $arrayCorrs=getTablaCarga(2);
  $arrayCals=getTablaCarga(3);
  $cedulas=getTablaCedulas();
  $nombresIngenieros=getTablaNombreIngenieros();

  $matrizCarga=array($cedulas,$arrayPrevs,$arrayCorrs,$arrayCals,$nombresIngenieros);
  //$matrizCarga=array("PERRO","LOBO");

  $myJSON = json_encode($matrizCarga);
  echo $myJSON;
?>
