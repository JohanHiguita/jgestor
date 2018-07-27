<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  $obj = json_decode($_GET["cod"], false);
  $codigo=$obj->codigo;

  $arrayProcedimiento=getRegistroProcedimiento($codigo);

  $ingenieros=getTablaNombreIngenieros(); //matriz con 3 columnas (Nombre y Apellidos)

  foreach ($ingenieros as $ing) { //convertir array (nombre, apellido 1, apellido 2) en String
    $arrayIngenieros[] = implode(" ",$ing);
  }

  $matrizResultado=array($arrayProcedimiento,$arrayIngenieros);

  $myJSON = json_encode($matrizResultado);
  echo $myJSON;
?>
