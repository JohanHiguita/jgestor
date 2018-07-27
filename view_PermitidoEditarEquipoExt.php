<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Permiso de administrador</title>
    <link href="css/jgestor.css" rel="stylesheet">
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <title></title>
  </head>
  <body>
    <?php
    $nombre=$_GET["nombre"];
    $serial=$_GET["serial"];

    echo "<div class='contenedor_MensajeEnvio'><br/><br/><br/><br/>
            <div class='MensajeEnvio'>
              <div><i class='fa fa-fw fa-check-circle' style='font-size:100px;color:green;'></i></div>
              <h3>El Equipo ".$nombre." de serial <em>".$serial." </em> ha sido modificado</h3>
              <div class='contenidoMensaje'>

              <div class='footer_mensajeEnvio'>
                <a href='tabla_equipos_externos.php' class='btn btn-success' role='button'>OK</a>
              </div>



            </div>
          </div>";


    ?>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/jgestor.js"></script>
  </body>
</html>
