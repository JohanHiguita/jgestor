<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  $obj1 = json_decode($_GET["cli"], false);
  $obj2 = json_decode($_GET["ins"], false);
  $nombreCliente=$obj1->cliente;
  $nombreInsumo=$obj2->insumo;
  $codcli=getDataCodCliente($nombreCliente);
  $cantidades=array(0,0,0,0,0,0,0,0,0,0,0,0); //cantidades en orden meses (0 - 11)(ene - dic)
   $rta=getTablaVentasInsumos($codcli[0],$nombreInsumo);
  for ($i=0; $i <count($rta) ; $i++) {
    $pos=intval($rta[$i][0])-1;
    $val=intval($rta[$i][1]);
    $cantidades[$pos]=$val;
  }

  $myJSON = json_encode($cantidades);
  echo $myJSON;
?>
