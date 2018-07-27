
<?php
  //General empleados
  define("query_empleados", "SELECT empleados.cedula, empleados.nombres,
  empleados.primer_apellido, empleados.segundo_apellido, cargos.cargo,
  empleados.correo, empleados.telefono FROM empleados INNER JOIN cargos ON
  cargos.cod_cargo = empleados.cod_cargo;");

  //General de clientes
  define("query_clientes", "SELECT clientes.cod_cliente, clientes.Nombre, clientes.Ciudad,
  clientes.Responsable FROM clientes;");

  //General de procedimientos
  define ("query_procedimientos","SELECT procedimientos.cod_procedimiento,
    tipo_procedimientos.Operacion, equipos_ext.NOMBRE, equipos_ext.SERIAL,
    clientes.Nombre, procedimientos.fecha,
    procedimientos.ejecutado FROM equipos_ext INNER JOIN clientes ON
    equipos_ext.COD_CLIENTE = clientes.cod_cliente INNER JOIN procedimientos on
    procedimientos.serial_equipo= equipos_ext.SERIAL INNER JOIN tipo_procedimientos
    ON procedimientos.cod_tipo_proc = tipo_procedimientos.cod_tipo_operacion");

  //General equipos externos
  define ("query_equipos_ext","SELECT equipos_ext.serial, equipos_ext.NOMBRE, clientes.Nombre, equipos_ext.ubicacion,
    equipos_ext.PLACA, equipos_ext.MARCA, equipos_ext.MODELO, equipos_ext.estado,
    modalidades.modalidad, equipos_ext.Fin_garantia from equipos_ext INNER JOIN clientes ON
    equipos_ext.COD_CLIENTE=clientes.cod_cliente INNER JOIN modalidades ON
    modalidades.cod_mod = equipos_ext.COD_MOD; ");

  define ("query_equipos_almacen","SELECT equipos_almacen.serial_alm,
    equipos_almacen.nombre, equipos_almacen.marca, equipos_almacen.modelo,
    equipos_almacen.fecha_compra, equipos_almacen.precio_compra FROM equipos_almacen;");

  define("query_insumos_almacen","SELECT * FROM insumos_almacen");

  define("query_insumos_vendidos","SELECT insumos_vendidos.CODIGO, insumos_vendidos.NOMBRE, insumos_vendidos.PRECIO_COMPRA,
    clientes.Nombre, insumos_vendidos.PRECIO_VENTA, insumos_vendidos.FECHA_VENTA, insumos_vendidos.CANTIDAD_PAQUETE
    from insumos_vendidos INNER JOIN clientes ON insumos_vendidos.COD_CLIENTE = clientes.cod_cliente");

  define("query_insumos_consignacion","SELECT insumos_consignacion.CODIGO, insumos_consignacion.NOMBRE, insumos_consignacion.PRECIO_COMPRA,
     		  clientes.Nombre, insumos_consignacion.F_ENTREGA, insumos_consignacion.CANTIDAD_PAQUETE, insumos_consignacion.FV
          from insumos_consignacion INNER JOIN clientes ON insumos_consignacion.COD_CLIENTE = clientes.cod_cliente");

?>
