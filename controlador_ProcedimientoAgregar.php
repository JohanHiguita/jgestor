<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");


  $ingenieros=getTablaNombreIngenieros(); //matriz con 3 columnas (Nombre y Apellidos)

  foreach ($ingenieros as $ing) { //convertir array (nombre, apellido 1, apellido 2) en String
    $arrayIngenieros[] = implode(" ",$ing);
  }

  $matrizResultado=array($arrayIngenieros);

  $myJSON = json_encode($matrizResultado);
  echo $myJSON;
?>
