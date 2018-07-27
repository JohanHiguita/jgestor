<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  $obj = json_decode($_GET["cod"], false);
  $cod_cliente=$obj->codigo;
  $arrayCliente=getRegistroCliente($cod_cliente);
  $arraytels=getRegTelsCliente($cod_cliente);
  $arrayCorreos=getRegCorreosCliente($cod_cliente);

  $matrizCliente=array($arrayCliente,$arraytels,$arrayCorreos);

  $myJSON = json_encode($matrizCliente);
  echo $myJSON;
?>
