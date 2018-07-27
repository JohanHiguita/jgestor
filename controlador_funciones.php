  <?php
    include('modelo_tablas.php');
    include("modelo_actualizar.php");
    include ("modelo_eliminar.php");
    include ("modelo_agregar.php");



    //funciones GET:
    function getTabla($info_tabla){
      $tabla=new Tablas_model();

      $matriz = $tabla->getMatriz($info_tabla);
      return $matriz;
    }

    function getRegistroEquipoExt($id){
      $registro=new Tablas_model();
      $reg=$registro->getEquipoExt($id);
      return $reg;
    }

    function getRegistroEquipoAlm($id){
      $registro=new Tablas_model();
      $reg=$registro->getEquipoAlm($id);
      return $reg;
    }

    function getRegistroProcedimiento($id){
      $registro=new Tablas_model();
      $reg=$registro->getProcedimiento($id);
      return $reg;
    }

    function getRegistroCliente($id){
      $registro=new Tablas_model();
      $reg=$registro->getCliente($id);
      return $reg;
    }

    function getRegTelsCliente($id){
      $registro=new Tablas_model();
      $reg=$registro->getTelsCliente($id);
      return $reg;
    }

    function getRegCorreosCliente($id){
      $registro=new Tablas_model();
      $reg=$registro->getCorreosCliente($id);
      return $reg;
    }

    function getRegistroEmpleado($id){
      $registro=new Tablas_model();
      $reg=$registro->getEmpleado($id);
      return $reg;
    }

    function getTablaProcEquipo($info_tabla){
      $tabla=new Tablas_model();

      $matriz = $tabla->getProcEquipo($info_tabla);
      return $matriz;
    }

    function getTablaNombreClientes(){
      $tabla=new Tablas_model();

      $matriz = $tabla->getNombreClientes();
      return $matriz;
    }

    function getTablaNombreModalidades(){
      $tabla=new Tablas_model();

      $matriz = $tabla->getNombreModalidades();
      return $matriz;
    }

    function getTablaNombreIngenieros(){
      $tabla=new Tablas_model();

      $matriz = $tabla->getNombreIngenieros();
      return $matriz;
    }

    function getTablaNombreInsumos(){
      $tabla=new Tablas_model();

      $matriz = $tabla->getNombreInsumos();
      return $matriz;
    }

    function getTablaSerialesEquipoExt(){
      $tabla=new Tablas_model();

      $matriz = $tabla->getSerialesEquipoExt();
      return $matriz;
    }

    function getDataCodCliente($nombreCliente){
      $tabla=new Tablas_model();

      $data = $tabla->getCodigoCliente($nombreCliente);
      return $data;
    }

    function getDataCodModalidad($nombreModalidad){
      $tabla=new Tablas_model();

      $data = $tabla->getCodigoModalidad($nombreModalidad);
      return $data;
    }

    function getDataCodEmpleado($nombreEmpleado){
      $tabla=new Tablas_model();

      $data = $tabla->getCodigoEmpleado($nombreEmpleado);
      return $data;
    }

    function getDataNombreCliente($serialExt){//nombre del cliente de acuerdo al codigo del equipo
      $tabla=new Tablas_model();

      $data = $tabla->getNombreCliente($serialExt);
      return $data;
    }

    function getDataCodTipoProc($nombreProc){//codigo del tipoProc de acuerdo al nombre del proc
      $tabla=new Tablas_model();

      $data = $tabla->getCodTipoProc($nombreProc);
      return $data;
    }

    function getDataCodCargo($nombreCargo){//codigo del tipoProc de acuerdo al nombre del proc
      $tabla=new Tablas_model();

      $data = $tabla->getCodCargo($nombreCargo);
      return $data;
    }

    function getTablaCarga($tipoProc){
      $tabla=new Tablas_model();

      $matriz = $tabla->getCarga($tipoProc);
      return $matriz;
    }
    function getTablaCedulas(){
      $tabla=new Tablas_model();

      $matriz = $tabla->getCedulas();
      return $matriz;
    }

    function getTablaCorrsYear(){
      $tabla=new Tablas_model();

      $matriz = $tabla->getCorrsYear();
      return $matriz;
    }

    function getTablaCorrsMes(){
      $tabla=new Tablas_model();

      $matriz = $tabla->getCorrsMes();
      return $matriz;
    }

    function getTablaCorrsEquipo($serial){
      $tabla=new Tablas_model();

      $matriz = $tabla->getCorrsEquipo($serial);
      return $matriz;
    }

    function getDataSalidaYear($serial){//codigo del tipoProc de acuerdo al nombre del proc
      $tabla=new Tablas_model();

      $data = $tabla->getSalidaYear($serial);
      return $data;
    }

    function getRegistroInsumoAlm($id){
      $registro=new Tablas_model();
      $reg=$registro->getInsumoAlm($id);
      return $reg;
    }

    function getNombreInsumosVend(){
      $registro=new Tablas_model();
      $reg=$registro->getInsumosVend();
      return $reg;
    }

    function getTablaVentasInsumos($codCli,$insumo){
      $registro=new Tablas_model();
      $reg=$registro->getVentasInsumos($codCli,$insumo);
      return $reg;
    }

    function getTablaInsumosCliente($codCli,$insumo,$mes){
      $registro=new Tablas_model();
      $reg=$registro->getInsumosCliente($codCli,$insumo,$mes);
      return $reg;
    }

    function getTablaLimitesAlertas(){
      $tabla=new Tablas_model();
      $matrizAsoc=array();
      $matriz = $tabla->getLimitesAlertas();
      //organizarla en asociativa:
      foreach ($matriz as $value) {
        $matrizAsoc[$value[0]]=intval($value[1]);
      }
      return $matrizAsoc;
    }

    function getTablaCorrectivosAlertas(){
      $tabla=new Tablas_model();

      $matriz = $tabla->getCorrsAlertas();
      return $matriz;
    }

    function getTablaAlertasProcs($diasProcs){
      $tabla=new Tablas_model();

      $matriz = $tabla->getAlertasProcs($diasProcs);
      return $matriz;
    }

    function getTablaAlertasFV_alm($diasFV){
      $tabla=new Tablas_model();

      $matriz = $tabla->getAlertasFV_alm($diasFV);
      return $matriz;
    }

    function getTablaAlertasFV_cons($diasFV){
      $tabla=new Tablas_model();

      $matriz = $tabla->getAlertasFV_cons($diasFV);
      return $matriz;
    }

    //-----------------getHeaders:-------------------//
    function getHeadersEmpleados(){
      $header=array("Cédula", "Nombres", "Primer Apellido", "Segundo Apellido", "Cargo", "Correo", "Teléfono", "Acciones" );
      return $header;
    }

    function getHeadersClientes(){
      $header=array("Código", "Nombre", "Ciudad", "Responsable", "Acciones" );
      return $header;
    }

    function getHeadersProcedimientos(){
      $header=array("Código", "Tipo", "Equipo","Serial", "Cliente",  "Fecha", "ejecutado","Acciones" );
      return $header;
    }

    function getHeadersEquipos_ext(){
      $header=array("serial", "Equipo", "Cliente", "Ubicación", "Placa", "Marca", "Modelo", "Estado", "Modalidad","garantía","Acciones" );
      return $header;
    }

    function getHeadersEquipos_almacen(){
      $header=array("Serial (almacén)", "Equipo", "Marca", "Modelo", "Fecha de compra","Precio de compra","Acciones" );
      return $header;
    }

    function getHeadersCorrectivosYear(){
      $header=array("Serial", "Equipo", "Cliente","Modalidad", "Correctivos","Gráficos" );
      return $header;
    }

    function getHeadersInsumosAlm(){
      $header=array("Código", "Nombre", "Precio compra","cantidad/pack", "FV esterilización", "Trasladar");
      return $header;
    }

    function getHeadersInsumosVend(){
      $header=array("Código", "Nombre", "Precio compra","Cliente","Precio venta","Fecha venta","cantidad/pack");
      return $header;
    }

    function getHeadersInsumosCons(){
      $header=array("Código", "Nombre", "Precio compra","Cliente","Fecha entrega","cantidad/pack", "FV esterilización", "Trasladar");
      return $header;
    }


    //Funciones UPDATE:

    function updateEquipoExt($datosEquipo){
      $tabla=new Actualizar_model();

      $tabla->actualizar_EquipoExt($datosEquipo);

    }
    function updateEquipoAlm($datosEquipo){
      $tabla=new Actualizar_model();

      $tabla->actualizar_EquipoAlm($datosEquipo);
    }
    function updateProcedimiento($datosProcedimiento){
      $tabla=new Actualizar_model();

      $tabla->actualizar_Procedimiento($datosProcedimiento);
    }
    function updateCliente($datosCliente){
      $tabla=new Actualizar_model();

      $tabla->actualizar_Cliente($datosCliente);
    }
    function updateEmpleado($datosEmpleado){
      $tabla=new Actualizar_model();

      $tabla->actualizar_Empleado($datosEmpleado);
    }
    function updateLimitesAlertas($datosAlertas){
      $tabla=new Actualizar_model();

      $tabla->actualizar_Alertas($datosAlertas);
    }

    //Funciones ELIMINAR
    function deleteEmpleado($cod){
      $tabla=new Eliminar_model();

      $tabla->eliminar_Empleado($cod);
    }
    function deleteEquipoExt($cod){
      $tabla=new Eliminar_model();

      $tabla->eliminar_EquipoExt($cod);
    }
    function deleteEquipoAlm($cod){
      $tabla=new Eliminar_model();

      $tabla->eliminar_EquipoAlm($cod);
    }
    function deleteProcedimiento($cod){
      $tabla=new Eliminar_model();

      $tabla->eliminar_Procedimiento($cod);
    }
    function deleteCliente($cod){
      $tabla=new Eliminar_model();

      $tabla->eliminar_cliente($cod);
    }

    function deleteInsumoAlmacen($cod){
      $tabla=new Eliminar_model();

      $tabla->eliminar_insumoAlmacen($cod);
    }

    //funciones Agregar

    function insertEquipoExt($datosEquipo){
      $tabla=new Agregar_model();
      $tabla->agregar_EquipoExt($datosEquipo);
    }
    function insertEquipoAlm($datosEquipo){
      $tabla=new Agregar_model();
      $tabla->agregar_EquipoAlm($datosEquipo);
    }
    function insertProcedimiento($datosEquipo){
      $tabla=new Agregar_model();
      $tabla->agregar_Procedimiento($datosEquipo);
    }
    function insertCliente($datosCliente){
      $tabla=new Agregar_model();
      $tabla->agregar_Cliente($datosCliente);
    }
    function insertEmpleado($datosEmpleado){
      $tabla=new Agregar_model();
      $tabla->agregar_Empleado($datosEmpleado);
    }
    function insertInsumoAlm($datosInsumo){
      $tabla=new Agregar_model();
      $tabla->agregar_InsumoAlm($datosInsumo);
    }

    function insertInsumoVendido($datosInsumo){
      $tabla=new Agregar_model();
      $tabla->agregar_InsumoVendido($datosInsumo);
    }
    function insertInsumoConsignacion($datosInsumo){
      $tabla=new Agregar_model();
      $tabla->agregar_InsumoConsignacion($datosInsumo);
    }


    //verifica datos ingresados
    function test_input($data) {
      $data = trim($data); //Elimina espacios en blanco en el inicio y final de una cadena
      $data = stripslashes($data);//Quita las barras de un string con comillas escapadas
      $data = htmlspecialchars($data);/*Convierte caracteres especiales en entidades
      HTMLConvierte caracteres especiales en entidades HTML*/
    return $data;
    }

    function getMes($numMes){
      switch ($numMes) {
        case 1:
          $mes="Enero";
          break;
        case 2:
          $mes="Febrero";
          break;
        case 3:
          $mes="Marzo";
          break;
        case 4:
          $mes="Abril";
          break;
        case 5:
          $mes="Mayo";
          break;
        case 6:
          $mes="Junio";
          break;
          case 7:
            $mes="Julio";
            break;
          case 8:
            $mes="Agosto";
            break;
          case 9:
            $mes="Septiembre";
            break;
          case 10:
            $mes="Octubre";
            break;
          case 11:
            $mes="Noviembre";
            break;
          case 12:
            $mes="Diciembre";
            break;
        default:
          $mes="";
          break;
      }

      return $mes;
    }


  ?>
