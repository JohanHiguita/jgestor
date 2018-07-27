<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  //alertas de equipos que han superado el limite anual
  //1. obtener tabla de los procedimientos del ultimo año
  //2. verificar cuales superan el limite
  $matResult=getTablaCorrectivosAlertas();
  $matLimites=getTablaLimitesAlertas();
  $prueba=array();
  $matAlertas=array();
  $alerta=array();
  $limite=0;
  foreach ($matResult as $datosEquipo) {
    //$datosEquipo[4]=intval($datosEquipo[4]);
    $limite=$matLimites[$datosEquipo[1]];
    //array_push($prueba,$limite);
    if (intval($datosEquipo[4])>$limite) {
      $alerta=array(
        "serial"=>$datosEquipo[0],
        "nombre"=>$datosEquipo[1],
        "cliente"=>$datosEquipo[2],
        "modalidad"=>$datosEquipo[3],
        "cantidad"=>intval($datosEquipo[4])
      );
     array_push($matAlertas,$alerta);
    }

  }


  $myJSON = json_encode($matAlertas);
  echo $myJSON;
?>
