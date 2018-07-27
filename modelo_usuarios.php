<?php
  include_once("modelo_conectar.php");

  class usuario_model{ //extrae la info
    private $db; // almacenar Conexión
    private $resultTable;//almacenar

    public function __construct(){//conectar con ls BD
      $this->db=Conectar::conexion();//asignar la variable $con (static)
      $this->resultTable=array();
    }

    public function getUsuario($user){

      $query="CALL GET_USUARIO('".$user."')"; //consulta preparada
      $consulta=$this->db->query($query);
      $this->result=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión
      return $this->result;
    }

  }

 ?>
