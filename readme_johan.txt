MODELS:
conectar.php		--> contiene una clase con una función static que retorna la conexión $con
tablas_model.php 	-->contiene una clase (Tablas_model), cuyo constructor ejecuta la clase conexión de conectar.php
			   y un metodo getEmpleados que ejecuta la consulta a la BD y retorna la matrix con los resultados de los empleados					

CONTROLLERS:
funciones_controlador.php	-->funciones que acceden a los datos, otras que devuelven los Headers


ACCESO A LAS TABLAS GENERALES (NAV IZQUIERDO > BASES DE DATOS > *)

en el bloque de codigo php se llaman a las funciones:

getHeader_: 	devuelve los encabezados de acuerdo a funciones_controlador.php
getTabla:	devuelve la matriz con los datos de la tabla, se le ingresa el nombre de la tabla.
		la funcion getQuery (funciones_queries.php de Models) asigna un query_nombre de acuerdo al nombre de la tabla
		el archivo queries.php de Models, define el query para cada funcion query_name		
insertTable:	ubica la tabla correspondiente, ubicada en funciones_view.php (tambien aplica capitalize a los datos)
		escribe las etiquetas HTML mediante echo
		Basado en el archivo original de Admin SB y ejemplos w3schools -> https://www.w3schools.com/php/php_mysql_select.asp)

ACCESO AL MODAL QUE MUESTRA LOS DETALLES DEL REGISTRO (TABLA > COLUMNA ACCIONES > VER )

insertTable:		recibe un tercer parametro que especifica la tabla en la cual se esta trabajando, de acuerdo a este valor ingresado asigna un nombre para la clase
			de la ultima celda de la tabla ($cell_link), para que en el archivo jgestor.js se realice el diseño del modal para cada tabla.
jgestor.js:		contiene los llamados al evento clic de cada celda de la columna detalles de cada tabla, los nombres de las clases fueron asignados en view_funciones-inserTable()
			accede al nombre del id mediante el atributo id de la primera columna de la tabla, haciendo uso de la tecnología AJAX y JSON, envia por medio del metodo GET ese
			id a cada archivo .php del controlador dependiendo la tabla (controlador_equipoExt.php para la tabla de equipos externos, por ejemplo) .
			Recibe un array con la info del registro, mediate el id asignado en el .php de cada tabla, en el modal se muestran los valores obtenidos.
controlador_tabla*.php:	recibe por URL el id necesario para realizar la consulta. se tiene una funcion getRegistroTabla* para cada tabla en el archivo controlador_funciones.php
			que a su vez llama a una función metodo de la clase tablas_model que realiza la consulta.
getTabla*:		metodos de la clase tablas model para obtener los registros de cierta tabla, mediante el uso de consultas preparadas que solo reciben el id de cada tabla.
Nota:			Para mostrar los detalles de cliente se realizan algunas operaciones diferentes, dado que estos tienen una relación con tablas de teléfonos y correos
			diferencias, en controlador_funciones hay 2 funciones adicionales para este objetivo (getRegTelsCliente y getRegCorreosCliente), de igual manera, otros 2 metodos a 
			la clase Tablas_model, estos metodos trabajan con si devolvieran una matriz, ya que cada tel o correo es un registro en el resultado.
			controlador_cliente.php obtiene 3 registros (la info del cliente, los telefonos y los correos), y los envia como matriz a jgestor.js.
			jgestor.js recibe una matriz en lugar de un registro, los separa para poder mostrar los datos en el modal.


EDITAR INFORMACIÓN DE CADA TABLA (TABLA>COLUMNA ACCIONES > ACTUALIZAR)

modal en la tabla:	tiene un formulario en el cual se ingresan los datos a modificar.

jgestor.js:		contiene llamados al evento clic de cada celda de editar, funcionamiento similar al evento para ver detalles. la idea es rellenar los campos con la información actual.
			hace uso de JSON:
controlador_editar*:	es el action de cada formulario, tiene eqtiquetas html para mostrar el pagina de insgreso de datos para permitir los cambios.
			accede a los campos del modal, (algunas tablas haceb operaciones adicionales para construir un array con la información correcta para actualizar las tablas. 
			Por ejemplo para procedimientos se deben llamar funciones que obtengan la cedula del empleado con base en el nombre, 
			el codigo del tipo de procedimientos con base en el nombre del procedimiento, y el codigo del cliente con base en el nombre) los guarda 
			en un array asocioativo. luego se verifica si la información ingresada (user-psw) es correcta
			mediante las funciones userExiste y verificarADM, Si existe y coinciden se llama la función update* a la cual se le pasa el array asociativo
			y luego se abren paginas view(Permitido/Negado)Editar*.php que muestra mensaje de exito o error.
			

VER PROCEDIMIENTOS DE EQUIPO EXTERNO EN EL MODAL DETALLES (TABLA> COLUMNA DETALLES > VER > BOTÓN VER PROCEDIMIENTOS)

jgestor.js:		atiende el evento de clic del botón, accede al serial del array regEquipoExt ya que este está definido como global en la función que muestra los detalles
			mediante wondow.open abre el archivo tablaProcEquipos.php que muestra los procedimientos del equipo correspondiente, envía el seriar por la URL.
tabla_procEquipos:	contiene la misma estructura de las paginas que muestran tablas, obtiene el valor serial pasado por URL. Obtiene los mismos headers de procedimientos,
			se obtiene una matriz con los procedimientos  usando la función getTablaProcEquipo ubicado en controladorFunciones.php
getTablaProcEquipo:	crea un objeto tablas_model, accediendo  al metodo getProcEquipo en modelo_tablas.php
getProcEquipo:		llama un procedimiento almacenado en la BD (GET_PROC_EQUIPO)
insertTable:		el tercer argumento es el mismo que hay en tabla_procedimientos.php c



 					





