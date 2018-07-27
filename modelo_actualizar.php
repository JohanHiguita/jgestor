<?php
  include_once("modelo_conectar.php");
  //include_once("modelo_funciones_queries.php");
  class Actualizar_model{ //extrae la info
    private $db; // almacenar Conexión
    //private $resultTable;//almacenar los $empleados

    public function __construct(){//conectar con ls BD
      $this->db=Conectar::conexion();//asignar la variable $con (static)
      //$this->resultTable=array();
    }

    public function actualizar_EquipoExt($datosEquipo){ //Recibe un array con la info

      //prepared statement y relacionamiento:
      $stmt=$this->db->prepare("CALL UPDATE_EQUIPOEXT(:placa,:nombre,:marca,:modelo,:fc,:fs,:codmod,:codcli,:pc,:ps,:serial,:ubicacion,:garantia,:estado)");
      $stmt->bindParam(':placa', $placa);
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':marca', $marca);
      $stmt->bindParam(':modelo', $modelo);
      $stmt->bindParam(':fc', $fc);
      $stmt->bindParam(':fs', $fs);
      $stmt->bindParam(':codmod', $codmod);
      $stmt->bindParam(':codcli', $codcli);
      $stmt->bindParam(':pc', $pc);
      $stmt->bindParam(':ps', $ps);
      $stmt->bindParam(':serial',$serial);
      $stmt->bindParam(':ubicacion',$ubicacion);
      $stmt->bindParam(':garantia',$garantia);
      $stmt->bindParam(':estado',$estado);

      $placa=$datosEquipo['placa'];
      $nombre=$datosEquipo['nombre'];
      $marca=$datosEquipo['marca'];
      $modelo=$datosEquipo['modelo'];
      $fc=$datosEquipo['fc'];
      $fs=$datosEquipo['fs'];
      $codmod=$datosEquipo['cod_mod'];
      $codcli=$datosEquipo['cod_cliente'];
      $pc=$datosEquipo['pc'];
      $ps=$datosEquipo['ps'];
      $serial=$datosEquipo['serial'];
      $ubicacion=$datosEquipo['ubicacion'];
      $garantia=$datosEquipo['garantia'];
      $estado=$datosEquipo['estado'];

      $stmt->execute();

      $this->db=null; //cerrar conexión


    }

    public function actualizar_EquipoAlm($datosEquipo){ //Recibe un array con la info

      $stmt=$this->db->prepare("CALL UPDATE_EQUIPOALM(:serial,:nombre,:marca,:modelo,:fc,:pc)");
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':marca', $marca);
      $stmt->bindParam(':modelo', $modelo);
      $stmt->bindParam(':fc', $fc);
      $stmt->bindParam(':pc', $pc);
      $stmt->bindParam(':serial', $serial);

      $serial=$datosEquipo['serial'];
      $nombre=$datosEquipo['nombre'];
      $marca=$datosEquipo['marca'];
      $modelo=$datosEquipo['modelo'];
      $fc=$datosEquipo['fc'];
      $pc=$datosEquipo['pc'];

      $stmt->execute();

      $this->db=null; //cerrar conexión


    }

    public function actualizar_Procedimiento($datosProcedimiento){ //Recibe un array con la info

      //prepared statement y relacionamiento:
      $stmt=$this->db->prepare("CALL UPDATE_PROCEDIMIENTO(:codigo,:serialEquipo,:codTipoProc,
      :ccEmpleado,:fecha,:realizado,:codCliente)");
      $stmt->bindParam(':codigo', $codigo);
      $stmt->bindParam(':serialEquipo', $serialEquipo);
      $stmt->bindParam(':codTipoProc', $codTipoProc);
      $stmt->bindParam(':ccEmpleado', $ccEmpleado);
      $stmt->bindParam(':fecha', $fecha);
      $stmt->bindParam(':realizado', $realizado);
      $stmt->bindParam(':codCliente', $codCliente);


      $codigo=$datosProcedimiento['codigo'];
      $codTipoProc=$datosProcedimiento['codTipoProc'];
      $serialEquipo=$datosProcedimiento['serialEquipo'];
      $fecha=$datosProcedimiento['fecha'];
      $realizado=$datosProcedimiento['realizado'];
      $ccEmpleado=$datosProcedimiento['cedulaEmpleado'];
      $codCliente=$datosProcedimiento['cod_cliente'];


      $stmt->execute();

      $this->db=null; //cerrar conexión


    }

    public function actualizar_Cliente($datosCliente){ //Recibe un array con la info

      $stmt=$this->db->prepare("CALL UPDATE_CLIENTE(:nombre,:ciudad,:responsable,:codigo)");
      $stmt->bindParam(':codigo', $codigo);
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':ciudad', $ciudad);
      $stmt->bindParam(':responsable', $responsable);


      $codigo=$datosCliente['codigo'];
      $nombre=$datosCliente['nombre'];
      $ciudad=$datosCliente['ciudad'];
      $responsable=$datosCliente['responsable'];
      $tel1=$datosCliente['tel1'];
      $tel2=$datosCliente['tel2'];
      $correo1=$datosCliente['correo1'];
      $correo2=$datosCliente['correo2'];

      $stmt->execute();

      //ingresar uno o 2 teléfonos:
      $this->db->query("DELETE FROM tel_clientes WHERE tel_clientes.cod_cliente =".$codigo); //eliminar registros
      if ($datosCliente['tel2']=="") {
        $this->db->query('INSERT INTO tel_clientes (tel_clientes.cod_cliente, tel_clientes.tel)
        VALUES ('.$codigo.','.$tel1.')');
      }else{
        $this->db->query('INSERT INTO tel_clientes (tel_clientes.cod_cliente, tel_clientes.tel)
        VALUES ('.$codigo.', '.$tel1.'); INSERT INTO tel_clientes (tel_clientes.cod_cliente, tel_clientes.tel)
        VALUES ('.$codigo.', '.$tel2.')');
      }

      //ingresar uno o dos correos:
      $this->db->query("DELETE FROM correos_clientes WHERE correos_clientes.cod_cliente =".$codigo); //eliminar registros
      if ($datosCliente['correo2']=="") {
        $this->db->query('INSERT INTO correos_clientes (correos_clientes.cod_cliente, correos_clientes.correo)
        VALUES ('.$codigo.',"'.$correo1.'")');
      }else{
        $this->db->query('INSERT INTO correos_clientes (correos_clientes.cod_cliente, correos_clientes.correo)
        VALUES ('.$codigo.', "'.$correo1.'"); INSERT INTO correos_clientes (correos_clientes.cod_cliente, correos_clientes.correo)
        VALUES ('.$codigo.', "'.$correo2.'")');
      }

      $this->db=null; //cerrar conexión


    }

    public function actualizar_Empleado($datosEmpleado){ //Recibe un array con la info

      $stmt=$this->db->prepare("CALL UPDATE_EMPLEADO(:cc,:nombres,:apellido1,:apellido2,:codCargo,:tel,:correo)");
      $stmt->bindParam(':nombres', $nombres);
      $stmt->bindParam(':apellido1', $apellido1);
      $stmt->bindParam(':apellido2', $apellido2);
      $stmt->bindParam(':codCargo', $codCargo);
      $stmt->bindParam(':tel', $tel);
      $stmt->bindParam(':correo', $correo);
      $stmt->bindParam(':cc', $cc);

      $cc=$datosEmpleado['cc'];
      $nombres=$datosEmpleado['nombres'];
      $apellido1=$datosEmpleado['apellido1'];
      $apellido2=$datosEmpleado['apellido2'];
      $codCargo=$datosEmpleado['codCargo'];
      $tel=$datosEmpleado['tel'];
      $correo=$datosEmpleado['correo'];

      $stmt->execute();

      $this->db=null; //cerrar conexión


    }

    public function actualizar_Alertas($datosAlertas){ //Recibe un array con la info

      //Porcentaje Compra insumos
      $stmt=$this->db->prepare("CALL UPDATE_LIMITES_ALERTAS(:valor,:limite)");
      $stmt->bindParam(':valor', $lim_perc);
      $stmt->bindParam(':limite',$limite);
      $lim_perc=$datosAlertas['lim_perc'];
      $limite='venta_insumos_perc';
      $stmt->execute();

      //Cantidad carga laboral
      $stmt2=$this->db->prepare("CALL UPDATE_LIMITES_ALERTAS(:valor,:limite)");
      $stmt2->bindParam(':valor', $lim_cl);
      $stmt2->bindParam(':limite',$limite);
      $lim_cl=$datosAlertas['lim_cl'];
      $limite='carga_laboral';
      $stmt2->execute();

      //Cantidad carga laboral
      $stmt3=$this->db->prepare("CALL UPDATE_LIMITES_ALERTAS(:valor,:limite)");
      $stmt3->bindParam(':valor', $lim_procs);
      $stmt3->bindParam(':limite',$limite);
      $lim_procs=$datosAlertas['lim_procs'];
      $limite='dias_procedimientos';
      $stmt3->execute();

      //dias fecha vencimiento esterilización
      $stmt4=$this->db->prepare("CALL UPDATE_LIMITES_ALERTAS(:valor,:limite)");
      $stmt4->bindParam(':valor', $lim_fv);
      $stmt4->bindParam(':limite',$limite);
      $lim_fv=$datosAlertas['lim_fv'];
      $limite='dias_esterilizacion';
      $stmt4->execute();

      //correctivos de equipo
      $stmt4=$this->db->prepare("CALL UPDATE_LIMITES_ALERTAS(:valor,:limite)");
      $stmt4->bindParam(':valor', $lim_correctivos);
      $stmt4->bindParam(':limite',$limite);
      $lim_correctivos=$datosAlertas['lim_correctivos'];
      $limite=$datosAlertas['equipo'];
      $stmt4->execute();


      $this->db=null; //cerrar conexión

    }

  }

 ?>
