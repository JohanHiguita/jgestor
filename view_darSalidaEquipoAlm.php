<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/jgestor.css" rel="stylesheet">
  <?php
    $serial=$_GET['serial'];
    $nombre=$_GET['nombre'];
    $marca=$_GET['marca'];
    $modelo=$_GET['modelo'];
    $fc=$_GET['fc'];
    $pc=$_GET['pc'];
  ?>
</head>


<body class="bg-dark">
  <div class="modal-content" >
    <div>
      <div>Dar salida al equipo</div>
      <div>
        <form class="agregarEquipoExtForm" action="controlador_AgregarEquipoExt.php" method="get">

          <div class="row">
            <div class="col-sm-6">
              <label for="inpPlaca">Placa:</label>
            </div>
            <div class="col-sm-6">
              <input type="text" name="inpPlaca" id="inpPlaca" placeholder="Número de placa"></input> <br>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="inpMarca">Marca:</label>
            </div>
            <div class="col-sm-6">
              <input type="text" name="inpMarca" id="inpMarca" value=<?php echo $marca?> readonly></input><br>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="inpModelo">Modelo:</label>
            </div>
            <div class="col-sm-6">
              <input type="text" name="inpModelo" id="inpModelo" value=<?php echo $modelo?> readonly></input><br>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="inpNombre">Nombre del Equipo:</label>
            </div>
            <div class="col-sm-6">
              <input type="text" name="inpNombre" id="inpNombre" value=<?php echo $nombre?> readonly></input><br>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="inpEstado">Estado:</label>
            </div>
            <div class="col-sm-6">
              <input type="text" name="inpEstado" id="inpEstado" placeholder="Estado"></input><br>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="inpUbicacion">Ubicación:</label>
            </div>
            <div class="col-sm-6">
              <input type="text" name="inpUbicacion" id="inpUbicacion" placeholder="Ubicación" required></input><br>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="inpModalidad">Modalidad:</label>
            </div>
            <div class="col-sm-6">
              <select type="text" name="inpModalidad" id="inpModalidad" required></select><br>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="inpCliente">Cliente:</label>
            </div>
            <div class="col-sm-6">
              <select type="text" name="inpCliente" id="inpCliente" required></select><br>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="inpFechaGarantia">Fecha fin de garantía:</label>
            </div>
            <div class="col-sm-6">
              <input type="date" name="inpFechaGarantia" id="inpFechaGarantia" required></input><br>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="inpFechaCompra">Fecha de Compra:</label>
            </div>
            <div class="col-sm-6">
              <input type="date" name="inpFechaCompra" id="inpFechaCompra" value=<?php echo $fc?> readonly></input><br>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="inpFechaSalida">Fecha de salida:</label>
            </div>
            <div class="col-sm-6">
              <input type="date" name="inpFechaSalida" id="inpFechaSalida" value=<?php echo "Obtener fecha de hoy"?> readonly></input><br>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="inpPrecioCompra">Precio de compra ($):</label>
            </div>
            <div class="col-sm-6">
              <input type="number" name="inpPrecioCompra" id="inpPrecioCompra" value=<?php echo $pc?> readonly></input><br>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="inpPrecioVenta">Precio de venta ($):</label>
            </div>
            <div class="col-sm-6">
              <input type="number" name="inpPrecioVenta" id="inpPrecioVenta" placeholder="Precio de venta" required></input><br>
            </div>
          </div>
          <div></br>
            <button class="btn btn-default" type="button">Cancelar</button>
            <button class="btn btn-success" type="submit">Dar salida</button>
          </div>

      </form>

      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
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
