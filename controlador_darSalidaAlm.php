<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Dar salida a equipo almacén</title>
    <link href="css/jgestor.css" rel="stylesheet">
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
  </head>
  <body class="bg-dark">
    <?php
      include("controlador_funciones.php");
      include("controlador_Usuarios.php");
      //Acceder a los campos y verificarlos:

      $serialAlm=test_input($_GET["inpSerialAlm"]);
      $nombre= test_input($_GET["inpNombre"]);
      $placa= test_input($_GET["inpPlaca"]);
      $marca= test_input($_GET["inpMarca"]);
      $modelo= test_input($_GET["inpModelo"]);
      $modalidad= test_input($_GET["inpModalidad"]);
      $cliente= test_input($_GET["inpCliente"]);
      $fechaCompra= test_input($_GET["inpFechaCompra"]);
      $fechaSalida= test_input($_GET["inpFechaSalida"]);
      $precioCompra= test_input($_GET["inpPrecioCompra"]);
      $precioSalida= test_input($_GET["inpPrecioVenta"]);
      $ubicacion=test_input($_GET["inpUbicacion"]);
      $garantia=test_input($_GET["inpFechaGarantia"]);
      $estado=test_input($_GET["inpEstado"]);
      /*Obtener codigo de cliente y modalidad para poder actualizar el registro
      del equipo ext*/
      $cod_cliente=getDataCodCliente($cliente)[0]; //codigo de cliente de acuerdo al nombre
      $cod_modalidad=getDataCodModalidad($modalidad)[0]; // codigo modalidad de acuerdo al nombre

      //almacenar datos en un array asociativo:
      $infoEquipo = array(

        
        "placa" =>$placa,
        "nombre" =>$nombre,
        "marca" =>$marca,
        "modelo" =>$modelo,
        "cod_mod" =>$cod_modalidad,
        "cod_cliente" =>$cod_cliente,
        "fc" =>$fechaCompra,
        "fs" =>$fechaSalida,
        "pc" =>$precioCompra,
        "ps" =>$precioSalida,
        "ubicacion" =>$ubicacion,
        "estado"=>$estado,
        "garantia"=>$garantia

      );

      if (isset($_POST["usuario_adm"]) && $_POST["psw_adm"]){
        $user=$_POST["usuario_adm"];
        $psw=$_POST["psw_adm"];
        $existe=userExiste($user); //booleano 1=existe, 0 no existe
        $accesoNegado=0;
        if ($existe) {
          $coinciden= verificarADM($user,$psw); //booleano 1=coincide, 2 no coincideuer
          if ($coinciden) {
            insertEquipoExt($infoEquipo); //Se agraga a equipos Ext
            deleteEquipoAlm($serialAlm);//y se elimina de equiposAlm
            $linkExito="view_PermitidoDarSalidaEquipoAlm.php";
            $linkExito="<script> window.open('".$linkExito."','_self')</script>";
            echo $linkExito;

          }else{
            $accesoNegado=1;
          }
        }else{
          $accesoNegado=1;
        }

        if ($accesoNegado==1) {
          $linkNoAcceso="view_NegadoDarSalidaEquipoAlm.php";

          $linkNoAcceso="<script> window.open('".$linkNoAcceso."','_self')</script>";
          echo $linkNoAcceso;
        }

      }

    ?>
    <div class="container">
      <div class="card card-login mx-auto mt-5">

        <div class="card-header text-center">
          <div class="text-center"><i class='fa fa-fw fa-lock' style='font-size:70px;color:gray;'></i></div>
          Ingrese usuario y contraseña de administardor para poder realizar los cambios
        </div>
        <div class="card-body">
          <form class="verificarADM_Form" method="POST">
            <div class="form-group">
              <label for="usuario_adm">Usuario</label>
              <input class="form-control" id="usuario_adm" name="usuario_adm" type="text" aria-describedby="emailHelp" placeholder="Ingrese usuario" required>
            </div>
            <div class="form-group">
              <label for="psw_adm">Contraseña</label>
              <input class="form-control" id="psw_adm" name="psw_adm" type="password" placeholder="Ingrese Contraseña" required>
            </div>

            <div class="text-center"><button class="btn btn-success " type="submit" name="enviar">Verificar</button></div>
          </form>

        </div>
      </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/jgestor.js"></script>
  </body>
</html>
