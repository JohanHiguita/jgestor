<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");

  $arrayClientes=getTablaNombreClientes();
  $arrayModalidades=getTablaNombreModalidades();

  $matrizResultado=array($arrayClientes,$arrayModalidades);

  $myJSON = json_encode($matrizResultado);
  echo $myJSON;
?>
