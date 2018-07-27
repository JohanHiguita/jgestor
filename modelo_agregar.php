<?php
  include_once("modelo_conectar.php");
  include_once("modelo_tablas.php");
  //include_once("modelo_funciones_queries.php");
  class Agregar_model{ //extrae la info
    private $db; // almacenar Conexión
    //private $resultTable;//almacenar los $empleados

    public function __construct(){//conectar con ls BD
      $this->db=Conectar::conexion();//asignar la variable $con (static)
      //$this->resultTable=array();
    }

    public function agregar_EquipoExt($datosEquipo){ //Recibe un array con la info

      //prepared statement y relacionamiento:
      $stmt=$this->db->prepare("CALL INSERT_EQUIPOEXT(:nombre,:marca,:modelo,:fc,:fs,
      :codmod,:codcli,:pc,:ps,:ubicacion,:garantia,:estado, :placa)");
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
      $ubicacion=$datosEquipo['ubicacion'];
      $garantia=$datosEquipo['garantia'];
      $estado=$datosEquipo['estado'];

      $stmt->execute();

      $this->db=null; //cerrar conexión


    }

    public function agregar_EquipoAlm($datosEquipo){ //Recibe un array con la info

      $stmt=$this->db->prepare("CALL INSERT_EQUIPOALM(:nombre,:marca,:modelo,:fc,:pc)");
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':marca', $marca);
      $stmt->bindParam(':modelo', $modelo);
      $stmt->bindParam(':fc', $fc);
      $stmt->bindParam(':pc', $pc);

      $nombre=$datosEquipo['nombre'];
      $marca=$datosEquipo['marca'];
      $modelo=$datosEquipo['modelo'];
      $fc=$datosEquipo['fc'];
      $pc=$datosEquipo['pc'];

      $stmt->execute();

      $this->db=null; //cerrar conexión


    }

    public function agregar_Procedimiento($datosProcedimiento){ //Recibe un array con la info

      //prepared statement y relacionamiento:
      $stmt=$this->db->prepare("CALL INSERT_PROCEDIMIENTO(:serialEquipo,:codTipoProc,
      :codCliente, :ccEmpleado,:fecha,:realizado)");

      $stmt->bindParam(':serialEquipo', $serialEquipo);
      $stmt->bindParam(':codTipoProc', $codTipoProc);
      $stmt->bindParam(':ccEmpleado', $ccEmpleado);
      $stmt->bindParam(':fecha', $fecha);
      $stmt->bindParam(':realizado', $realizado);
      $stmt->bindParam(':codCliente', $codCliente);

      $codTipoProc=$datosProcedimiento['codTipoProc'];
      $serialEquipo=$datosProcedimiento['serialEquipo'];
      $fecha=$datosProcedimiento['fecha'];
      $realizado=$datosProcedimiento['realizado'];
      $ccEmpleado=$datosProcedimiento['cedulaEmpleado'];
      $codCliente=$datosProcedimiento['cod_cliente'];

      $stmt->execute();
      $this->db=null; //cerrar conexión
    }

    public function agregar_Cliente($datosCliente){ //Recibe un array con la info

      $stmt=$this->db->prepare("CALL INSERT_CLIENTE(:nombre,:ciudad,:responsable)");
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':ciudad', $ciudad);
      $stmt->bindParam(':responsable', $responsable);

      $nombre=$datosCliente['nombre'];
      $ciudad=$datosCliente['ciudad'];
      $responsable=$datosCliente['responsable'];
      $tel1=$datosCliente['tel1'];
      $tel2=$datosCliente['tel2'];
      $correo1=$datosCliente['correo1'];
      $correo2=$datosCliente['correo2'];

      $stmt->execute();

      //Obtener el ultimo codigo de cliente
      $cods=new Tablas_model();
      $codigos=$cods->getCodigosClientes(); //array de arrays
      $codigosCliente=array();
      foreach ($codigos as $arrayCod) {
        array_push($codigosCliente,($arrayCod[0]+0));
      }
      $ultimoCod=max($codigosCliente);// ultimo codigo de cliente ingresado


      //obtener el ultimo codigo de cliente ingresado

      //ingresar uno o 2 teléfonos:
      $this->db->query("DELETE FROM tel_clientes WHERE tel_clientes.cod_cliente =".$ultimoCod); //eliminar registros
      if ($datosCliente['tel2']=="") {
        $this->db->query('INSERT INTO tel_clientes (tel_clientes.cod_cliente, tel_clientes.tel)
        VALUES ('.$ultimoCod.','.$tel1.')');
      }else{
        $this->db->query('INSERT INTO tel_clientes (tel_clientes.cod_cliente, tel_clientes.tel)
        VALUES ('.$ultimoCod.', '.$tel1.'); INSERT INTO tel_clientes (tel_clientes.cod_cliente, tel_clientes.tel)
        VALUES ('.$ultimoCod.', '.$tel2.')');
      }

      //ingresar uno o dos correos:
      $this->db->query("DELETE FROM correos_clientes WHERE correos_clientes.cod_cliente =".$ultimoCod); //eliminar registros
      if ($datosCliente['correo2']=="") {
        $this->db->query('INSERT INTO correos_clientes (correos_clientes.cod_cliente, correos_clientes.correo)
        VALUES ('.$ultimoCod.',"'.$correo1.'")');
      }else{
        $this->db->query('INSERT INTO correos_clientes (correos_clientes.cod_cliente, correos_clientes.correo)
        VALUES ('.$ultimoCod.', "'.$correo1.'"); INSERT INTO correos_clientes (correos_clientes.cod_cliente, correos_clientes.correo)
        VALUES ('.$ultimoCod.', "'.$correo2.'")');
      }

      $this->db=null; //cerrar conexión


    }

    public function agregar_Empleado($datosEmpleado){ //Recibe un array con la info

      $stmt=$this->db->prepare("CALL INSERT_EMPLEADO(:cc,:nombres,:apellido1,:apellido2,:codCargo,:tel,:correo)");
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

    public function agregar_InsumoAlm($datosInsumo){ //Recibe un array con la info

      $stmt=$this->db->prepare("CALL INSERT_INSUMO(:nombre,:pc,:cantidad,:fv)");
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':pc', $pc);
      $stmt->bindParam(':cantidad', $cantidad);
      $stmt->bindParam(':fv', $fv);



      $nombre=$datosInsumo['nombre'];
      $pc=$datosInsumo['pc'];
      $cantidad=$datosInsumo['cantidad'];
      $fv=$datosInsumo['fv'];
      $stmt->execute();
      $this->db=null; //cerrar conexión

    }

    public function agregar_InsumoVendido($datosInsumo){ //Recibe un array con la info

      $stmt=$this->db->prepare("CALL INSERT_INSUMOVENDIDO(:nombre,:pc,:cantidad,:pv,:fv,:codCli)");
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':pc', $pc);
      $stmt->bindParam(':cantidad', $cantidad);
      $stmt->bindParam(':pv', $pv);
      $stmt->bindParam(':fv', $fv);
      $stmt->bindParam(':codCli', $codCli);

      $nombre=$datosInsumo['nombre'];
      $pc=$datosInsumo['pc'];
      $cantidad=$datosInsumo['cantidad'];
      $pv=$datosInsumo['pv'];
      $fv=$datosInsumo['fVenta'];
      $codCli=$datosInsumo['codCli'];
      $stmt->execute();
      $this->db=null; //cerrar conexión

    }

    public function agregar_InsumoConsignacion($datosInsumo){ //Recibe un array con la info

      $stmt=$this->db->prepare("CALL INSERT_INSUMOCONSIGNACION(:nombre,:pc,:cantidad,:codCli, :fe, :fv)");
      $stmt->bindParam(':nombre', $nombre);
      $stmt->bindParam(':pc', $pc);
      $stmt->bindParam(':cantidad', $cantidad);
      $stmt->bindParam(':fe', $fe);
      $stmt->bindParam(':fv', $fv);
      $stmt->bindParam(':codCli', $codCli);

      $nombre=$datosInsumo['nombre'];
      $pc=$datosInsumo['pc'];
      $cantidad=$datosInsumo['cantidad'];
      $fv=$datosInsumo['fVencimiento'];
      $codCli=$datosInsumo['codCli'];
      $fe=$datosInsumo['fEntrega'];

      $stmt->execute();
      $this->db=null; //cerrar conexión

    }

  }

 ?>
