<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Permiso de administrador</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <?php
  include("controlador_funciones.php");
  include ("controlador_Usuarios.php");

  $cc= test_input($_GET["inpCedula"]);
  $nombres= test_input($_GET["inpNombre"]);
  $apellido1= test_input($_GET["inpApellido1"]);
  $apellido2= test_input($_GET["inpApellido2"]);
  $cargo= test_input($_GET["inpCargo"]);
  $tel= test_input($_GET["inpTel"]);
  $correo= test_input($_GET["inpCorreo"]);

  $codCargo=getDataCodCargo($cargo)[0];


  //almacenar datos en un array asociativo:
  $infoEmpleado = array(
    "cc" => $cc,
    "nombres" =>$nombres,
    "apellido1" =>$apellido1,
    "apellido2" =>$apellido2,
    "codCargo"=>$codCargo,
    "tel" =>$tel,
    "correo" =>$correo
  );

  if (isset($_POST["usuario_adm"]) && $_POST["psw_adm"]){
    $user=$_POST["usuario_adm"];
    $psw=$_POST["psw_adm"];
    $existe=userExiste($user); //booleano 1=existe, 0 no existe
    $accesoNegado=0;
    if ($existe) {
      $coinciden= verificarADM($user,$psw); //booleano 1=coincide, 2 no coincideuer
      if ($coinciden) {
        updateEmpleado($infoEmpleado);
        $linkExito="view_PermitidoEditarEmpleado.php?nombres=" .$nombres. "&".
        "ap1=" .$apellido1. "&" ."ap2=".$apellido2;
        $linkExito="<script> window.open('".$linkExito."','_self')</script>";
        echo $linkExito;
      }else{
        $accesoNegado=1;
      }
    }else{
      $accesoNegado=1;
    }

    if ($accesoNegado==1) {
      $linkNoAcceso="view_NegadoEditarEmpleado.php?nombres=" .$nombres. "&".
      "ap1=" .$apellido1. "&" ."ap2=".$apellido2;
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
  <script src="js/jgestor.js"></script>

</body>

</html>
