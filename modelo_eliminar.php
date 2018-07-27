<?php
  include_once("modelo_conectar.php");
  //include_once("modelo_funciones_queries.php");
  class Eliminar_model{ //extrae la info
    private $db; // almacenar Conexión
    //private $resultTable;//almacenar los $empleados

    public function __construct(){//conectar con ls BD
      $this->db=Conectar::conexion();//asignar la variable $con (static)
      //$this->resultTable=array();
    }

    public function eliminar_Empleado($cod){ //Recibe un array con la info
      $query="CALL DELETE_EMPLEADO(".$cod.")";
      $consulta=$this->db->query($query);
    }
    public function eliminar_EquipoExt($cod){ //Recibe un array con la info
      $query="CALL DELETE_EQUIPOEXT(".$cod.")";
      $consulta=$this->db->query($query);
    }
    public function eliminar_EquipoAlm($cod){ //Recibe un array con la info
      $query="CALL DELETE_EQUIPOALM(".$cod.")";
      $consulta=$this->db->query($query);
    }
    public function eliminar_Procedimiento($cod){ //Recibe un array con la info
      $query="CALL DELETE_PROCEDIMIENTO(".$cod.")";
      $consulta=$this->db->query($query);
    }
    public function eliminar_cliente($cod){ //Recibe un array con la info
      $query="CALL DELETE_CLIENTE(".$cod.")";
      $consulta=$this->db->query($query);
    }
    public function eliminar_insumoAlmacen($cod){ //Recibe un array con la info
      $query="CALL DELETE_INSUMOALMACEN(".$cod.")";
      $consulta=$this->db->query($query);
    }





  }

 ?>
