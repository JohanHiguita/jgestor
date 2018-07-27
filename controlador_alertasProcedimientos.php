<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  $obj = json_decode($_GET["dias"], false);
  $diasProcs=$obj->dias_proc;
  $matAlertas=array();
  //alertas de los próximos procedimientos
  //1. crear las funciones con conexión a la BD
  $matResult=getTablaAlertasProcs($diasProcs);
  foreach ($matResult as $value) {
      $alerta=array(
        "codigo"=>$value[0],
        "serial"=>$value[1],
        "nombre"=>$value[2],
        "cliente"=>$value[3],
        "modalidad"=>$value[4],
        "fecha"=>$value[5],
        "empleado"=>$value[6],
        "procedimiento"=>$value[7],
        "fecha"=>$value[5],
      );
     array_push($matAlertas,$alerta);
  }
  $myJSON = json_encode($matAlertas);
  echo $myJSON;
?>
