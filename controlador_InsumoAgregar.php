<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");


  $nombresInsumos=getTablaNombreInsumos(); //matriz con 3 columnas (Nombre y Apellidos)

  foreach ($nombresInsumos as $ins) { //convertir array (nombre, apellido 1, apellido 2) en String
    $arrayInsumos[] = implode(" ",$ins);
  }

  $matrizResultado=array($arrayInsumos);

  $myJSON = json_encode($matrizResultado);
  echo $myJSON;
?>
