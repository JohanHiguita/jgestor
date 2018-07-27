<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  $obj = json_decode($_GET["dias"], false);
  $diasFV=$obj->dias_esterilizacion;
  $matAlertas=array();
  $matAlmacen=array();
  $matConsignacion=array();
  //alertas de las fechas de vencimiento de los insumos en almacén y consignación
  //1. Obtener 2 tablas: una para almacén y otra para consignación
  //2. Unir las tablas en un array asociativo: codigo, nombre, ubicación (almacen - consignación)
      //cliente (par consignación, "-" para almacén), Fecha de vencimientoh
  $matAlmacen=getTablaAlertasFV_alm($diasFV);
  $matConsignacion=getTablaAlertasFV_cons($diasFV);

  foreach ($matAlmacen as $value) {
      $alerta=array(
        "codigo"=>$value[0],
        "nombre"=>$value[1],
        "ubicacion"=>"Almacén",
        "cliente"=>"-",
        "FV"=>$value[2],
      );
     array_push($matAlertas,$alerta);
  }
  foreach ($matConsignacion as $value) {
      $alerta=array(
        "codigo"=>$value[0],
        "nombre"=>$value[1],
        "ubicacion"=>"Consignación",
        "cliente"=>$value[2],
        "FV"=>$value[3],
      );
     array_push($matAlertas,$alerta);
  }
  $myJSON = json_encode($matAlertas);
  echo $myJSON;
?>
