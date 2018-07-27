<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>jGestor - dar salida equipo</title>
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
    $serialAlm=$_GET['serial'];
    $nombre=$_GET['nombre'];
    $marca=$_GET['marca'];
    $modelo=$_GET['modelo'];
    $fc=$_GET['fc'];
    $pc=$_GET['pc'];
  ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav"> <!-- barra navegación -->
    <a class="navbar-brand" href="index.php">jGestor</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span> <!-- boton menu (responsive) -->
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive"> <!-- contenedor derecho del nav -->
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion"> <!-- navegador izq -->
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Bases de datos">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseBD" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-database"></i>
            <span class="nav-link-text">Bases de datos</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseBD">
            <li>
              <a href="tabla_equipos_externos.php">
                <i class="fa fa-fw fa-table"></i>
                <span>Equipos externos</span>
              </a>
            </li>
            <li>
              <a href="tabla_equipos_almacen.php">
                <i class="fa fa-fw fa-table"></i>
                <span>Equipos en almacén</span>
              </a>
            </li>
            <li>
              <a href="tabla_procedimientos.php">
                <i class="fa fa-fw fa-table"></i>
                <span>Procedimientos</span>
              </a>
            </li>
            <li>
              <a href="tabla_clientes.php">
                <i class="fa fa-fw fa-table"></i>
                <span>Clientes</span>
              </a>
            </li>
            <li>
              <a href="tabla_empleados.php">
                <i class="fa fa-fw fa-table"></i>
                <span>Empleados</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Ingresar información">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseADD" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-plus-circle"></i>
            <span class="nav-link-text">Ingresar información</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseADD">
            <li>
              <a class="btn_AddEquipoExt"data-toggle="modal" href="#agregarEquipoExtModal">
                <i class="fa fa-fw fa-desktop"></i>
                <span>Equipos externos</span>
              </a>
            </li>
            <li>
              <a class="btn_AddEquipoAlm"data-toggle="modal" href="#agregarEquipoAlmModal">
                <i class="fa fa-fw fa-laptop"></i>
                <span>Equipos en almacén</span>
              </a>
            </li>
            <li>
              <a class="btn_AddProcedimiento" data-toggle="modal" href="#agregarProcedimientoModal">
                <i class="fa fa-fw fa-wrench"></i>
                <span>Procedimientos</span>
              </a>
            </li>
            <li>
              <a class="btn_AddCliente"data-toggle="modal" href="#agregarClienteModal">
                <i class="fa fa-fw fa-briefcase"></i>
                <span>Clientes</span>
              </a>
            </li>
            <li>
              <a class="btn_AddEmpleado"data-toggle="modal" href="#agregarEmpleadoModal">
                <i class="fa fa-fw fa-users"></i>
                <span>Empleados</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Cronograma">
          <a class="nav-link" href="charts.html">
            <i class="fa fa-fw fa-calendar"></i>
            <span class="nav-link-text">Cronograma</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Gráficos">
          <a class="nav-link" href="charts.html">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Gráficos</span>
          </a>
        </li>

      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul> <!-- nav izq (toogle) -->
      <ul class="navbar-nav ml-auto"> <!-- nav superior -->
        <li class="nav-item dropdown"> <!--  mensajes -->
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">Ver todos los mensajes</a>
          </div>
        </li>
        <li class="nav-item dropdown"><!--  Alertas-->
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alertas
              <span class="badge badge-pill badge-warning">6 New</span> <!--  responsive -->
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">Nuevas Alertas:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Calibración Monitor de signos vitales</strong>
              </span>
              <span class="small float-right text-muted">3 Marzo 2018</span>
              <div class="dropdown-message small">Cliente: Hospital General / Hora: 8:00 </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Mantenimiento preventivo Electrobisturí</strong>
              </span>
              <span class="small float-right text-muted">8 Marzo 2018</span>
              <div class="dropdown-message small">Cliente: Hospital Pablo Tobón / Hora: 15:00 </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Capacitación manejo ventilador mecánico</strong>
              </span>
              <span class="small float-right text-muted">12 Marzo 2018</span>
              <div class="dropdown-message small">Lugar: IPS universitaria / Hora: 10:00 </div>
            </a>

            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">Ver todas las alertas</a>
          </div>
        </li>
        <li class="nav-item"> <!-- Buscador -->
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Buscar...">
              <span class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li><!-- Buscador nav -->
        <li class="nav-item"> <!-- LogOut -->
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Salir</a>
        </li>
      </ul> <!--nav top  -->
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Dar salida equipo almacen</li>
      </ol>

      <div class="card mb-3">
        <div class="row">
            <div class="col-lg-6">
                <form role="form" class="agregarEquipoExtForm" id="formDarSalida" action="controlador_darSalidaAlm.php">
                  <div class="form-group">
                    <label><b>Serial (alm):</b></label>
                    <input class="form-control" type="text" name="inpSerialAlm" id="inpSerialAlm" value='<?php echo $serialAlm; ?>' readonly>

                  </div>
                    <div class="form-group">
                      <label><b>Nombre</b></label>
                      <input class="form-control" type="text" name="inpNombre" id="inpNombre" value='<?php echo $nombre; ?>' readonly>

                    </div>
                    <div class="form-group">
                        <label><b>Placa</b></label>
                        <input class="form-control" type="text" name="inpPlaca" id="inpPlaca" placeholder="Número de placa">
                      </div>
                    <div class="form-group">
                        <label><b>Marca</b></label>
                        <input class="form-control" input type="text" name="inpMarca" id="inpMarca" value='<?php echo $marca; ?>' readonly>
                    </div>
                    <div class="form-group">
                        <label><b>Modelo</b></label>
                        <input class="form-control" type="text" name="inpModelo" id="inpModelo" value='<?php echo $modelo; ?>' readonly>
                    </div>
                    <div class="form-group">
                        <label><b>Estado</b></label>
                        <input class="form-control" type="text" name="inpEstado" id="inpEstado" placeholder="Estado del equipo">
                    </div>
                    <div class="form-group">
                        <label><b>Ubicación</b></label>
                        <input class="form-control" type="text" name="inpUbicacion" id="inpUbicacion" placeholder="Ubicación del equipo">
                    </div>


                </form>
            </div>
            <div class="col-lg-6">
              <div class="darSalida">
                  <div class="form-group">
                      <label for="inpModalidad"><b>Modalidad</b></label>

                  </div>
                  <select class="form-control" type="text" name="inpModalidad" id="inpModalidad" form="formDarSalida"></select>
                  <div class="form-group">
                      <label for="inpCliente"><b>Cliente</b></label>
                      <select class="form-control inpCliente2" type="text" name="inpCliente" id="inpCliente" form="formDarSalida"></select>

                  </div>
                  <div class="form-group">
                    <label><b>Fecha fin de garantía</b></label>
                    <input class="form-control" type="date" name="inpFechaGarantia" id="inpFechaGarantia" form="formDarSalida">
                    <!-- <input class="form-control" placeholder="Nombre del equipo"> -->
                  </div>
                  <div class="form-group">
                    <label><b>Fecha de compra</b></label>
                    <input class="form-control" type="date" name="inpFechaCompra" id="inpFechaCompra" value='<?php echo $fc; ?>' readonly form="formDarSalida">
                    <!-- <input class="form-control" placeholder="Nombre del equipo"> -->
                  </div>
                  <div class="form-group">
                    <label><b>Fecha de salida</b></label>
                    <input class="form-control" type="date" name="inpFechaSalida" id="inpFechaSalida" form="formDarSalida">
                    <!-- <input class="form-control" placeholder="Nombre del equipo"> -->
                  </div>
                  <div class="form-group">
                    <label><b>Precio de compra ($)</b></label>
                    <input class="form-control" type="number" name="inpPrecioCompra" id="inpPrecioCompra" value='<?php echo $pc; ?>' readonly form="formDarSalida">
                    <!-- <input class="form-control" placeholder="Nombre del equipo"> -->
                  </div>
                  <div class="form-group">
                    <label><b>Precio de salida ($)</b></label>
                    <input class="form-control" type="number" name="inpPrecioVenta" id="inpPrecioVenta" form="formDarSalida">
                    <!-- <input class="form-control" placeholder="Nombre del equipo"> -->
                  </div>
              </div>

            </div>
            <div class="col-lg-12" align="center">
              <a class="btn btn-default btn-lg" href="index.php" role="button">Cancelar</a>
              <button type="submit" class="btn btn-primary btn-lg" form="formDarSalida">Dar Salida</button>
            </div>
        </div></br>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Johan Esteban Higuita 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Detalles Modal-->
    <div class="modal fade" id="detallesModal" tabindex="-1" role="dialog" aria-labelledby="ProcedimientosModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ProcedimientosModalLabel">Procedimientos</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 id='nombre_proc'></h5><br/>
            <h5><b>Código: </b></h5>
            <span  id='cod_proc'></span><br/>
            <h5><b>Serial equipo: </b></h5>
            <span  id='serial_proc'></span><br/>
            <h5><b>Equipo: </b></h5>
            <span  id='equipo_proc'></span><br/>
            <h5 ><b>Fecha: </b></h5>
            <span id='fecha_proc'></span><br/>
            <h5 ><b>Cliente: </b></h5>
            <span id='cliente_proc'></span><br/>
            <h5 ><b>Realizado: </b></h5>
            <span id='ejec_proc'></span><br/>
            <h5 ><b>Ingeniero encargado: </b></h5>
            <span id='empleado_proc'></span><br/>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-dismiss="modal">OK</button>

          </div>
        </div>
      </div>
    </div>
    <!--Editar Modal  -->
    <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="EditarModalLabel" aria-hidden="true">
      <div  class="modal-dialog" role="document">
        <div class="modal-content" id="modalContentEditar">
          <div class="modal-header">
            <h5 class="modal-title" id="EditarModalLabel">Editar Procedimiento</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="contEditarForm">
              <form id="formEditProcedimiento" class="editarProcedimientoForm" action="controlador_editarProcedimiento.php" method="get">
                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpCodigo">Código:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="inpCodigo" id="inpCodigo" readonly></input><br/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpTipo">Tipo:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="radio" name="tipoProc" value="M. Preventivo">M. Preventivo</input><br/>
                    <input type="radio" name="tipoProc" value="M. Correctivo">M. Correctivo</input><br/>
                    <input type="radio" name="tipoProc" value="Calibración">Calibración</input><br/>

                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpSerialEquipo"> Serial del equipo:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="inpSerialEquipo" id="inpSerialEquipo" autocomplete="off" onkeyup="verificarSerial(this.value)"><br/>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpFecha">Fecha:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="date" name="inpFecha" id="inpFecha"></input><br>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpCliente">Cliente:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="inpCliente" id="inpCliente" readonly></input><br>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpRealizado">Realizado:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="checkbox" name="inpRealizado" id="inpRealizado" value="1"> </input><br/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpIngeniero">Ingeniero:</label>
                  </div>
                  <div class="col-sm-6">
                    <select type="text" name="inpIngeniero" id="inpIngeniero"></select><br>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <input type="submit" name="enviar" value="Editar" form="formEditEquipoExt"></input> -->
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-success" type="submit" name="enviar" id="btn_actualizar_procedimiento" form="formEditProcedimiento">Actualizar</button>
            <!-- <a class="btn btn-primary" href="login.html">Logout</a> -->
          </div>
        </div>
      </div>
    </div>
    <!--Eliminar Modal   -->
    <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="eliminarModalLabel">Eliminar registro de procedimiento</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body text-center">
            ¿Está seguro de eliminar el registro del procedimiento
            <em><span id='codigo_eliminar'></span></em>?
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-danger btn_eliminarReg">Eliminar</a>
          </div>
        </div>
      </div>
    </div>

    <!-- agregarEquipoExt Modal-->
    <div class="modal fade" id="agregarEquipoExtModal" tabindex="-1" role="dialog" aria-labelledby="AgregarModalLabel" aria-hidden="true">
      <div  class="modal-dialog" role="document">
        <div class="modal-content" id="modalContentAgregar">
          <div class="modal-header">
            <h5 class="modal-title" id="AgregarModalLabel">Agregar equipo externo</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="contAgregarForm">
                <form id="formAgregarEquipoExt" class="agregarEquipoExtForm" action="controlador_AgregarEquipoExt.php" method="get">

                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpNombre">Nombre del Equipo:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="inpNombre" id="inpNombre" placeholder="Nombre del equipo" required></input><br>
                  </div>
                </div>

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
                    <input type="text" name="inpMarca" id="inpMarca" placeholder="Marca"></input><br>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpModelo">Modelo:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="inpModelo" id="inpModelo" placeholder="Modélo"></input><br>
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
                    <input type="date" name="inpFechaCompra" id="inpFechaCompra" required></input><br>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpFechaSalida">Fecha de salida:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="date" name="inpFechaSalida" id="inpFechaSalida" required></input><br>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpPrecioCompra">Precio de compra ($):</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="number" name="inpPrecioCompra" id="inpPrecioCompra" placeholder="Precio de compra" required></input><br>
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

              </form>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <input type="submit" name="enviar" value="Editar" form="formEditEquipoExt"></input> -->
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-success" type="submit" name="enviar" form="formAgregarEquipoExt">Agregar</button>
            <!-- <a class="btn btn-primary" href="login.html">Logout</a> -->
          </div>
        </div>
      </div>
    </div>
    <!-- agregarEquipoAlm Modal-->
    <div class="modal fade" id="agregarEquipoAlmModal" tabindex="-1" role="dialog" aria-labelledby="AgregarModalLabel" aria-hidden="true">
      <div  class="modal-dialog" role="document">
        <div class="modal-content" id="modalContentAgregar">
          <div class="modal-header">
            <h5 class="modal-title" id="AgregarModalLabel">Agregar equipo en almacén</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="contAgregarForm">
                <form id="formAgregarEquipoAlm" class="agregarEquipoAlmForm" action="controlador_AgregarEquipoAlm.php" method="get">

                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpNombre">Equipo:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="inpNombre" id="inpNombre" required></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpMarca">Marca:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="inpMarca" id="inpMarca" required></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpModelo">Modelo:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="inpModelo" id="inpModelo" required></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpFechaCompra">Fecha de Compra:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="date" name="inpFechaCompra" id="inpFechaCompra" required></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpPrecioCompra">Precio de compra ($):</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="number" name="inpPrecioCompra" id="inpPrecioCompra" required></input><br>
                    </div>
                  </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <input type="submit" name="enviar" value="Editar" form="formEditEquipoExt"></input> -->
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-success" type="submit" name="enviar" form="formAgregarEquipoAlm">Agregar</button>
            <!-- <a class="btn btn-primary" href="login.html">Logout</a> -->
          </div>
        </div>
      </div>
    </div>
    <!--agregar Procedimiento Modal  -->
    <div class="modal fade" id="agregarProcedimientoModal" tabindex="-1" role="dialog" aria-labelledby="AgregarModalLabel" aria-hidden="true">
      <div  class="modal-dialog" role="document">
        <div class="modal-content" id="modalContentAgregar">
          <div class="modal-header">
            <h5 class="modal-title" id="AgregarModalLabel">Agregar Procedimiento</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="contAgregarForm">
              <form id="formAgregarProcedimiento" class="agregarProcedimientoForm" action="controlador_AgregarProcedimiento.php" method="get">

                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpTipo">Tipo:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="radio" name="tipoProc" value="M. Preventivo">M. Preventivo</input><br/>
                    <input type="radio" name="tipoProc" value="M. Correctivo">M. Correctivo</input><br/>
                    <input type="radio" name="tipoProc" value="Calibración">Calibración</input><br/>

                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpSerialEquipo"> Serial del equipo:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="inpSerialEquipo" id="inpSerialEquipo" autocomplete="off" onkeyup="verificarSerial(this.value)" required><br/>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpFecha">Fecha:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="date" name="inpFecha" id="inpFecha" required></input><br>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpCliente">Cliente:</label>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="inpCliente" id="inpCliente" readonly></input><br>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label for="inpIngeniero">Ingeniero:</label>
                  </div>
                  <div class="col-sm-6">
                    <select type="text" name="inpIngeniero" id="inpIngeniero"></select><br>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <input type="submit" name="enviar" value="Editar" form="formEditEquipoExt"></input> -->
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-success" type="submit" name="enviar" id="btn_agregar_procedimiento" form="formAgregarProcedimiento">Actualizar</button>
            <!-- <a class="btn btn-primary" href="login.html">Logout</a> -->
          </div>
        </div>
      </div>
    </div>
    <!--agregar Cliente Modal  -->
    <div class="modal fade" id="agregarClienteModal" tabindex="-1" role="dialog" aria-labelledby="AgregarModalLabel" aria-hidden="true">
      <div  class="modal-dialog" role="document">
        <div class="modal-content" id="modalContentAgregar">
          <div class="modal-header">
            <h5 class="modal-title" id="AgregarModalLabel">Agregar nuevo cliente</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="contAgregarForm">
                <form id="formAgregarCliente" class="agregarClienteForm" action="controlador_AgregarCliente.php" method="get">
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpNombre">Nombre:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="inpNombre" id="inpNombre" required></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpCiudad">Ciudad:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="inpCiudad" id="inpCiudad" required></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpMarca">Responsable:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="inpResponsable" id="inpResponsable" required></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpTel1">Teléfono 1:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="inpTel1" id="inpTel1" required></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpTel2">Teléfono 2:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="inpTel2" id="inpTel2"></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpCorreo">e-mail:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="email" name="inpCorreo" id="inpCorreo" required></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpCorreo2">e-mail 2:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="email" name="inpCorreo2" id="inpCorreo2"></input><br>
                    </div>
                  </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <input type="submit" name="enviar" value="Editar" form="formEditEquipoExt"></input> -->
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-success" type="submit" name="enviar" id="btn_agregar_cliente" form="formAgregarCliente">Actualizar</button>
            <!-- <a class="btn btn-primary" href="login.html">Logout</a> -->
          </div>
        </div>
      </div>
    </div>
    <!--agregar Empleado Modal  -->
    <div class="modal fade" id="agregarEmpleadoModal" tabindex="-1" role="dialog" aria-labelledby="AgregarModalLabel" aria-hidden="true">
      <div  class="modal-dialog" role="document">
        <div class="modal-content" id="modalContentAgregar">
          <div class="modal-header">
            <h5 class="modal-title" id="AgregarModalLabel">Agregar nuevo empleado</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="contAgregarForm">
                <form id="formAgregarEmpleado" class="agregarEmpleadoForm" action="controlador_AgregarEmpleado.php" method="get">
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpCedula">Cédula:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="inpCedula" id="inpCedula"></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpNombre">Nombres:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="inpNombre" id="inpNombre"></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpApellido1">Primer Apellido:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="inpApellido1" id="inpApellido1"></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpApellido2">Segundo Apellido:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="inpApellido2" id="inpApellido2"></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpCargo">Cargo:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" name="inpCargo" id="inpCargo" value="Ingeniero"></input><br>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpTel">Teléfono:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="tel" name="inpTel" id="inpTel"></input><br>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <label for="inpCorreo">e-mail:</label>
                    </div>
                    <div class="col-sm-6">
                      <input type="email" name="inpCorreo" id="inpCorreo"></input><br>
                    </div>
                  </div>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <input type="submit" name="enviar" value="Editar" form="formEditEquipoExt"></input> -->
            <button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
            <button class="btn btn-success" type="submit" name="enviar" id="btn_agregar_empleado" form="formAgregarEmpleado">Agregar</button>
            <!-- <a class="btn btn-primary" href="login.html">Logout</a> -->
          </div>
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

  </div>

</body>

</html>
