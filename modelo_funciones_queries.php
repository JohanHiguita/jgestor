<?php
  include_once("modelo_queries.php");
  function getQuery ($info_tabla){
    switch ($info_tabla) {
      case 'empleados':
        return query_empleados;
        break;
      case 'clientes':
        return query_clientes;
        break;
      case 'procedimientos':
        return query_procedimientos;
        break;
      case 'equipos_ext':
        return query_equipos_ext;
        break;
      case 'equipos_almacen':
        return query_equipos_almacen;
        break;
      case 'insumos_almacen':
          return query_insumos_almacen;
          break;
      case 'insumos_vendidos':
          return query_insumos_vendidos;
          break;
      case 'insumos_consignacion':
          return query_insumos_consignacion;
          break;

      default:
        return 0;
        break;
    }//swtch $nom_tabla
  }

?>
