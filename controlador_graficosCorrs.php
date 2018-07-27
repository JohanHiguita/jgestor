<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");

  $obj = json_decode($_GET["ser"], false);
  $serialExt=$obj->serial;
  $arrayCorrectivos=getTablaCorrsEquipo($serialExt);//(años/cantidad)

  $salidaYear=intval(getDataSalidaYear($serialExt)[0]);
  //adecuar array de daño
  $actualYear=intval(date("Y"));
  $years=array();
  for ($i=0; $i <=($actualYear - $salidaYear); $i++) {
    $years[$i]=$salidaYear+$i; //años desde salida hasta actual
  }
  //adecuar $arrayCorrectivos
  $arrayAsoc=array();
  foreach ($arrayCorrectivos as $value) {
    $arrayAsoc[$value[0]]=$value[1];
  }
  $corrsEquipo=array();
for ($i=0; $i <count($years) ; $i++) {

    if (array_key_exists((string)$years[$i], $arrayAsoc)) {
      $corrsEquipo[$i]=(int)$arrayAsoc[(string)$years[$i]]; //cantidad de corrs (coincide con año)
    }else{
      $corrsEquipo[$i]=0;
    }
  }


  $matrizCorrsEquipo=array($years,$corrsEquipo);
  $myJSON = json_encode($matrizCorrsEquipo);
  echo $myJSON;
?>
