<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  $obj = json_decode($_GET["ser"], false);
  $serialExt=$obj->serial;

  $arrayEquipos=getRegistroEquipoExt($serialExt);
  $arrayClientes=getTablaNombreClientes();
  $arrayModalidades=getTablaNombreModalidades();

  $matrizResultado=array($arrayEquipos,$arrayClientes,$arrayModalidades);

  $myJSON = json_encode($matrizResultado);
  echo $myJSON;
?>
