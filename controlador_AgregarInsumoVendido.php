<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Traslado de insumos</title>
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
  <body class="bg-dark" >
    <?php
      include("controlador_funciones.php");
      include ("controlador_Usuarios.php");
      //Acceder a los campos y verificarlos:

      $cod= test_input($_GET["inpCod"]);
      $nombre= test_input($_GET["inpNombre"]);
      $pc= test_input($_GET["inpPC"]);
      $cantidad= test_input($_GET["inpCantidad"]);
      $fVencimiento= test_input($_GET["inpFvencimiento"]);
      $pv= test_input($_GET["inpPV"]);
      $fVenta= test_input($_GET["inpFventa"]);
      $cliente=test_input($_GET["inpCliente"]);
      $codCli=getDataCodCliente($cliente)[0];

      $infoInsumo = array(
        "cod"=>$cod,
        "nombre" =>$nombre,
        "cantidad"=>$cantidad,
        "fVencimiento"=>$fVencimiento,
        "fVenta"=>$fVenta,
        "pv"=>$pv,
        "pc" =>$pc,
        "codCli"=>$codCli
      );

      if (isset($_POST["usuario_adm"]) && $_POST["psw_adm"]){

        $user=$_POST["usuario_adm"];
        $psw=$_POST["psw_adm"];
        $existe=userExiste($user); //booleano 1=existe, 0 no existe
        $accesoNegado=0;
        if ($existe) {
          $coinciden= verificarADM($user,$psw); //booleano 1=coincide, 2 no coincideuer
          if ($coinciden) {
            insertInsumoVendido($infoInsumo);
            deleteInsumoAlmacen($cod);
            $linkExito="view_PermitidoTrasladarInsumo.php";
            $linkExito="<script> window.open('".$linkExito."','_self')</script>";
            echo $linkExito;
          }else{
            $accesoNegado=1;
          }
        }else{
          $accesoNegado=1;
        }

        if ($accesoNegado==1) {
          $linkNoAcceso="view_NegadoTrasladarInsumo.php";
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
