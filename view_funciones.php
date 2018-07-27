<?php

function insertTable($headers,$matrizDatos,$nomTabla) { //insertar tabla (tablas principales de la BD)
   //verificar tabla a insertar (posteriormente puede ser una funcion):
   $cell_link=setNombreClase($nomTabla);//asigna un valor de nombre de clase segun la tabla a mostrar



  echo '<div class="card-body">
        <div class="table-responsive" >
          <table class="table table-bordered dataTableClase" id="dataTable" width="100%" cellspacing="0">'; //apertura de etiquetas
  //rellenar head:
  echo '<thead><tr>';
  foreach ($headers as $hd) {
    echo "<th>".$hd."</th>";
  }
  echo'</tr></thead>';
  //rellenar el footer:
  echo '<tfoot><tr>';
  foreach ($headers as $hd) {
    echo "<th>".$hd."</th>";
  }
  echo'</tr></tfoot>';
  echo '<tbody>';
  foreach ($matrizDatos as $reg) {
    echo "<tr>";
    foreach ($reg as $cell) {

      echo "<td>".$cap = ucfirst(mb_strtolower($cell))."</td>"; // Capitalize
    }
    //el nombre de la clase para las celdas de la ultima columna de la tabla dependen de la tabla a mostrar
      echo"<td class=".$cell_link.">";
      echo "<a  class='".$reg[0]." detalles' data-toggle='modal' href= '#detallesModal' title='Ver detalles'><i  class='fa fa-fw fa-eye'></i></a>"; //el data-target debe variar segun la tabla
      echo "<a  class='".$reg[0]." editar' data-toggle='modal' href='#editarModal' title='Actualizar'><i class='fa fa-fw fa-edit'></i></a>";
      echo "<a  class='".$reg[0]." eliminar' data-toggle='modal' href='#eliminarModal' title='Eliminar'><i class='fa fa-fw fa-trash'></i></a>";
      echo "</td></tr>"; //".$reg[0]."
  }
  echo '</tbody></table></div></div>'; //cierre etiquetas tabla
}

function insertTable2($headers,$matrizDatos,$nomTabla) { //insertar tabla (tablas de correctivos anuales y mensuales)
   //verificar tabla a insertar (posteriormente puede ser una funcion):
   $cell_link=setNombreClase($nomTabla);//asigna un valor de nombre de clase segun la tabla a mostrar



  echo '<div class="card-body">
        <div class="table-responsive" >
          <table class="table table-bordered dataTableClase"  width="100%" cellspacing="0">'; //apertura de etiquetas
  //rellenar head:
  echo '<thead><tr>';
  foreach ($headers as $hd) {
    echo "<th>".$hd."</th>";
  }
  echo'</tr></thead>';
  //rellenar el footer:
  echo '<tfoot><tr>';
  foreach ($headers as $hd) {
    echo "<th>".$hd."</th>";
  }
  echo'</tr></tfoot>';
  echo '<tbody>';
  foreach ($matrizDatos as $reg) {
    echo "<tr>";
    foreach ($reg as $cell) {

      echo "<td>".$cap = ucfirst(mb_strtolower($cell))."</td>"; // Capitalize
    }
    //el nombre de la clase para las celdas de la ultima columna de la tabla dependen de la tabla a mostrar
      echo"<td class=".$cell_link.">";
      echo "<a  class='".$reg[0]." graficos' data-toggle='modal' href= '#graficosCorrsModal' title='Ver Gráficos'><i  class='fa fa-fw fa-line-chart'></i></a>"; //el data-target debe variar segun la tabla
      echo "</td></tr>";
  }
  echo '</tbody></table></div></div>'; //cierre etiquetas tabla
}

function insertTableInsumosVendidos($headers,$matrizDatos) { //insertar tabla (tablas de correctivos anuales y mensuales)
   //verificar tabla a insertar (posteriormente puede ser una funcion):




  echo '<div class="card-body">
        <div class="table-responsive" >
          <table class="table table-bordered dataTableClase"  width="100%" cellspacing="0">'; //apertura de etiquetas
  //rellenar head:
  echo '<thead><tr>';
  foreach ($headers as $hd) {
    echo "<th>".$hd."</th>";
  }
  echo'</tr></thead>';
  //rellenar el footer:
  echo '<tfoot><tr>';
  foreach ($headers as $hd) {
    echo "<th>".$hd."</th>";
  }
  echo'</tr></tfoot>';
  echo '<tbody>';
  foreach ($matrizDatos as $reg) {
    echo "<tr>";
    foreach ($reg as $cell) {
      echo "<td>".$cap = ucfirst(mb_strtolower($cell))."</td>"; // Capitalize
    }
      echo "</tr>";
  }
  echo '</tbody></table></div></div>'; //cierre etiquetas tabla
}

function insertTableInsumos($headers,$matrizDatos,$nomTabla) { //insertar tabla (tablas de correctivos anuales y mensuales)
   //verificar tabla a insertar (posteriormente puede ser una funcion):
   $cell_link=setNombreClase($nomTabla);

  echo '<div class="card-body">
        <div class="table-responsive" >
          <table class="table table-bordered dataTableClase"  width="100%" cellspacing="0">'; //apertura de etiquetas
  //rellenar head:
  echo '<thead><tr>';
  foreach ($headers as $hd) {
    echo "<th>".$hd."</th>";
  }
  echo'</tr></thead>';
  //rellenar el footer:
  echo '<tfoot><tr>';
  foreach ($headers as $hd) {
    echo "<th>".$hd."</th>";
  }
  echo'</tr></tfoot>';
  echo '<tbody>';
  foreach ($matrizDatos as $reg) {
    echo "<tr>";
    foreach ($reg as $cell) {
      echo "<td>".$cap = ucfirst(mb_strtolower($cell))."</td>"; // Capitalize
    }
    //el nombre de la clase para las celdas de la ultima columna de la tabla dependen de la tabla a mostrar
      echo"<td class=".$cell_link.">";
      echo "<b><a  class='".$reg[0]." t-vendidos' data-toggle='modal' href= '#trasladoInsumosVendModal' title='Trasladar a vendidos'>V</a></b>"; //el data-target debe variar segun la tabla
      echo "<b><a  class='".$reg[0]." t-consignacion' data-toggle='modal' href='#trasladoInsumosConsModal' title='Trasladar a consignación'>C</a></b>";
      echo "</td></tr>"; //".$reg[0]."
  }
  echo '</tbody></table></div></div>'; //cierre etiquetas tabla
}

function setNombreClase($nomTabla){
  if ($nomTabla=="equiposExternos") {
   $cell_link="equipos_ext_link";
  }elseif ($nomTabla=="equiposAlm") {
   $cell_link="equipos_alm_link";
  }elseif ($nomTabla=="procedimientos") {
   $cell_link="procedimientos_link";
  }elseif ($nomTabla=="clientes") {
    $cell_link="clientes_link";
  }elseif ($nomTabla=="empleados") {
    $cell_link="empleado_link";
  }elseif ($nomTabla=="no link") {
    $cell_link="no link";
  }elseif ($nomTabla=="corrsY") {
    $cell_link="corrsY_link";
  }elseif ($nomTabla=="corrsM") {
    $cell_link="corrsM_link";
  }elseif ($nomTabla=="insumos") {
    $cell_link="insumos_link";
  }
  return $cell_link;
}

 ?>
