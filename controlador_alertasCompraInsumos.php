<?php
  include("controlador_funciones.php");
  header("Content-Type: application/json; charset=UTF-8");
  $compras1MesAnt=array(); //compras mes anterior
  $compras2MesAnt=array();//compras dos meses atrás
  $insumosAsoc=array();
  $clientes=getTablaNombreClientes();
  $insumos=getNombreInsumosVend();
  $obj = json_decode($_GET["per"], false);
  $percent=$obj->porcentaje;
  $percent=$percent/100; //porcentaje de ventas para alarma
  $matAlertas=array();

  //se crea una dos "matriz asociativa"
  foreach ($insumos as $value) { //array asociativo de insumos
    $insumosAsoc[$value[0]]=array();
  }
  foreach ($clientes as $value) { //array asociativo de clientes
    $compras1MesAnt[$value[0]]=$insumosAsoc;
    $compras2MesAnt[$value[0]]=$insumosAsoc;
  }

  //LLenar las matrices
  $prueba=array();
  $cont=0;
  foreach ($compras1MesAnt as $keyCli => $cliente) {
    $codCli=getDataCodCliente($keyCli);
    foreach ($cliente as $keyIns => $insumo) {
        $cantidad1Mes=getTablaInsumosCliente($codCli[0],$keyIns,1);
        $cantidad2Mes=getTablaInsumosCliente($codCli[0],$keyIns,2);
        $compras1MesAnt[$keyCli][$keyIns]=$cantidad1Mes[0];
        $compras2MesAnt[$keyCli][$keyIns]=$cantidad2Mes[0];

        if ( (floatval($cantidad1Mes[0][0])) <($percent*floatval($cantidad2Mes[0][0])) ){ //mayor cantidad mes 2 que 1
          /*Generar matriz de Alertas:
            sí en el ultímo mes se vendió menos del 50% del mes anterior (penultimo)
          */
          $alarma=array("cliente"=>$keyCli,"insumo"=>$keyIns,"cant1"=>floatval($cantidad1Mes[0][0]),"cant2"=>floatval($cantidad2Mes[0][0]));
          array_push($matAlertas,$alarma);
        }



    }
  }

  $myJSON = json_encode($matAlertas);
  echo $myJSON;


?>
