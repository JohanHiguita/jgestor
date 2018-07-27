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
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/jgestor.js"></script>
  <?php
  include "controlador_Usuarios.php";
  if (isset($_POST["usuario_adm"]) && $_POST["psw_adm"]){
    $user=$_POST["usuario_adm"];
    $psw=$_POST["psw_adm"];
    var_dump($user);
    var_dump($psw);

    $existe=userExiste($user); //booleano 1=existe, 0 no existe
    var_dump($existe);
    if ($existe) {
      $coinciden= verificarADM($user,$psw); //booleano 1=coincide, 2 no coincideuer
      var_dump($coinciden);
    }




  }

  ?>
</body>

</html>
