<?php
  include_once("modelo_conectar.php");
  include_once("modelo_funciones_queries.php");
  class Tablas_model{ //extrae la info
    private $db; // almacenar Conexión
    private $resultTable;//almacenar los $empleados

    public function __construct(){//conectar con ls BD


      $this->db=Conectar::conexion();//asignar la variable $con (static)
      $this->resultTable=array();
    }


    public function getMatriz($info_tabla){ //para tablas generales
      $query=getQuery($info_tabla);//obtiene el query_name
      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getEquipoExt($id){

      $query="CALL GET_EQUIPOEXT(".$id.")"; //consulta preparada
      $consulta=$this->db->query($query);
      $this->resultTable=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión

      return $this->resultTable;
    }

    public function getEquipoAlm($id){

      $query="CALL GET_EQUIPOALM(".$id.")"; //consulta preparada
      $consulta=$this->db->query($query);
      $this->resultTable=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getProcedimiento($id){

      $query="CALL GET_PROCEDIMIENTO(".$id.")"; //consulta preparada
      $consulta=$this->db->query($query);
      $this->resultTable=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCliente($id){

      $query="CALL GET_CLIENTE(".$id.")"; //consulta preparada
      $consulta=$this->db->query($query);
      $this->resultTable=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getTelsCliente($id){
      $query="CALL GET_TELS_CLIENTE(".$id.")"; //consulta preparada
      $consulta=$this->db->query($query);
      while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
        $this->resultTable[]=$row;
      }
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCorreosCliente($id){
      $query="CALL GET_CORREOS_CLIENTE(".$id.")"; //consulta preparada
      $consulta=$this->db->query($query);
      while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
        $this->resultTable[]=$row;
      }
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCodigosClientes(){
      $query="select clientes.cod_cliente FROM clientes";
      $consulta=$this->db->query($query);
      while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
        $this->resultTable[]=$row;
      }
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getEmpleado($id){

      $query="CALL GET_EMPLEADO(".$id.")"; //consulta preparada
      $consulta=$this->db->query($query);
      $this->resultTable=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getProcEquipo($id){
      $query="CALL GET_PROC_EQUIPO(".$id.")"; //consulta preparada
      $consulta=$this->db->query($query);
      while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
        $this->resultTable[]=$row;
      }
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getNombreClientes(){
      $query="CALL GET_NOMBRES_CLIENTES()"; //consulta preparada
      $consulta=$this->db->query($query);
      while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
        $this->resultTable[]=$row;
      }
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getNombreModalidades(){
      $query="CALL GET_NOMBRES_MODALIDADES()"; //consulta preparada
      $consulta=$this->db->query($query);
      while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
        $this->resultTable[]=$row;
      }
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getNombreIngenieros(){
      $query="CALL GET_NOMBRES_INGENIEROS()"; //consulta preparada
      $consulta=$this->db->query($query);
      while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
        $this->resultTable[]=$row;
      }
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getNombreInsumos(){
      $query="CALL GET_NOMBRES_INSUMOS()"; //consulta preparada
      $consulta=$this->db->query($query);
      while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
        $this->resultTable[]=$row;
      }
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getSerialesEquipoExt(){
      $query="CALL GET_SERIALES_EQUIPOEXT()"; //consulta preparada
      $consulta=$this->db->query($query);
      while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
        $this->resultTable[]=$row[0];
      }
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCodigoCliente($nombre){
      //$query="CALL GET_CODIGO_CLIENTE(".$nombre.")"; //consulta preparada
      $query="CALL GET_CODIGO_CLIENTE('".$nombre."')";
      $consulta=$this->db->query($query);
      $this->resultTable=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCodigoModalidad($nombre){
      //$query="CALL GET_CODIGO_CLIENTE(".$nombre.")"; //consulta preparada
      $query="CALL GET_CODIGO_MODALIDAD('".$nombre."')";
      $consulta=$this->db->query($query);
      $this->resultTable=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCodigoEmpleado($nombre){
      if (count($nombre)===3) {//un nombre
          $nombres=$nombre[0];
          $ap1=$nombre[1];
          $ap2=$nombre[2];
      }else{ //2 nombres
        $nombres=$nombre[0]." ".$nombre[1];
        $ap1=$nombre[2];
        $ap2=$nombre[3];
      }
      $query="CALL GET_CEDULA_EMPLEADO('".$nombres."','".$ap1."','".$ap2."')";
      $consulta=$this->db->query($query);
      $this->resultTable=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCodTipoProc($nombreproc){

      $query="CALL GET_CODIGO_TIPOPROC('".$nombreproc."')";
      $consulta=$this->db->query($query);
      $this->resultTable=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCodCargo($nombreCargo){

      $query="CALL GET_CODIGO_CARGO('".$nombreCargo."')";
      $consulta=$this->db->query($query);
      $this->resultTable=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getNombreCliente($serialExt){

      $query="CALL GET_NOMBRE_CLIENTE_SERIALEXT(".$serialExt.")";
      $consulta=$this->db->query($query);
      $this->resultTable=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCarga($tipoProc){ //para tablas generales
      $query="CALL GET_CARGA_LABORAL('".$tipoProc."')";
      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCedulas(){ //para tablas generales
      $query="SELECT empleados.cedula FROM empleados WHERE empleados.cod_cargo=4";
      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCorrsYear(){ //para tablas generales
      $query="CALL GET_CORRECTIVOS_YEAR()";
      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCorrsMes(){ //para tablas generales
      $query="CALL GET_CORRECTIVOS_MES()";
      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCorrsEquipo($serial){ //para tablas generales
      $query="CALL GET_CORRECTIVOS_EQUIPO_Y('".$serial."')";
      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getSalidaYear($serial){
      //$query="CALL GET_CODIGO_CLIENTE(".$nombre.")"; //consulta preparada
      $query="SELECT YEAR(equipos_ext.FECHA_SALIDA) FROM equipos_ext WHERE equipos_ext.SERIAL=".$serial;
      $consulta=$this->db->query($query);
      $this->resultTable=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getInsumoAlm($id){

      $query="CALL GET_INSUMOALM(".$id.")"; //consulta preparada
      $consulta=$this->db->query($query);
      $this->resultTable=$consulta->fetch(PDO::FETCH_NUM);
      $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getInsumosVend(){ //para tablas generales
      $query="CALL GET_INSUMOSVEND()";
      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getVentasInsumos($codCli,$insumo){ //para tablas generales
      $query="CALL GET_VENTAS_INSUMOS(".$codCli.",'".$insumo."')";
      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getInsumosCliente($codCli,$insumo,$mes){ //para tablas generales
      $query="CALL GET_COMPRA_INSUMOS_CLIENTE(".$codCli.",'".$insumo."',".$mes.")";
      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getLimitesAlertas(){ //para tablas generales
      $query="SELECT * FROM limites_alertas;";
      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getCorrsAlertas(){ //para tablas generales
      $query="CALL GET_CORRECTIVOS_ALERTA()";
      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getAlertasFV_alm($diasFV){ //para tablas generales
      $query="CALL GET_ESTERILIZACION_ALERTAS_ALMACEN('".$diasFV."')";

      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getAlertasFV_cons($diasFV){ //para tablas generales
      $query="CALL GET_ESTERILIZACION_ALERTAS_CONSIGNACION('".$diasFV."')";

      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }

    public function getAlertasProcs($diasProcs){ //para tablas generales
      $query="CALL GET_PROCEDIMIENTOS_ALERTAS('".$diasProcs."')";

      $consulta=$this->db->query($query);
        while ($row=$consulta->fetch(PDO::FETCH_NUM)) {
          $this->resultTable[]=$row;
        }
        $this->db=null; //cerrar conexión
      return $this->resultTable;
    }



  }

 ?>
