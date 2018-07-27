<?php
// Array with seriales
include_once("controlador_funciones.php");
$nombreCliente=array();
$seriales=getTablaSerialesEquipoExt();
// get the q parameter from URL
$q = $_REQUEST["q"];



  if (in_array($q, $seriales)) {
    $nombreCliente=getDataNombreCliente($q)[0];
    echo $nombreCliente;
    //echo implode("", $nombreCliente);
  }else{
    echo 1;
  }

  //var_dump($nombreCliente);

  //$arrayRespuesta=array($hint,$nombreCliente[0]);

//echo $arrayRespuesta;
