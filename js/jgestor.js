var cedulas=[];
var nombresIngenieros=[];
var cantidadPrevs=[];
var cantidadCorrs=[];
var cantidadCals=[];
var cantidadTotales=[];

//matrices Alertas:
var limitesAlertas=[];
var matAlertasVentaInsumos=[];
var matAlertasCL=[];
var matAlertasCorrs=[];
var matAlertasProcs=[];
var matAlertasEsterilizacion=[];


$(document).ready(function(){

  ingresosEditar=0;//variable global que permite ingresar una sola vez a un bloque (Evitar rellenar el select Cliente)
  ingresosEditar2=0;
  ingresosAddInsumo=0;
  ingresosTrasladoIns=0;
  ingresosTrasladoIns2=0;
  ingresosSelectsIns=0;

  setOptions(); //llenar las opciones del select al dar salida a equipo alm -> ext

  //Cargar matrices de alertas:
  cargarLimitesAlertas(); //umbrales de todas las alertas
  cantProcs=limitesAlertas.carga_laboral;
  cargaLaboral(cantProcs);
  porcentaje=limitesAlertas.venta_insumos_perc;
  alertasComprasInsumos(porcentaje);//matriz alertas de compras insumos
  alertasCorrectivos(); //matriz de correctivos en el ultimo año
  dias_procedimientos=limitesAlertas.dias_procedimientos;//dias para próximos procedimientos
  alertasProcsProximos(dias_procedimientos);
  dias_esterilizacion=limitesAlertas.dias_esterilizacion;
  alertasEsterilizacion(dias_esterilizacion);

  //mostrar tablas de alertas:

  tablaAlertasInsumos(matAlertasVentaInsumos);
  tablaAlertasCargaLaboral(matAlertasCL);
  tablaAlertasCorrectivos(matAlertasCorrs);
  tablaAlertasProcedimientos(matAlertasProcs);
  tablaAlertasEsterilizacion(matAlertasEsterilizacion);
  setOptionsInsumos();

  $(".detallesEquipoExt #btn_proc").click(function(e){
   var serial=regEquipoExt[0]; //regEquipoExt es variable global
   window.open("tabla_procEquipos.php?serial="+serial, "_self");

 }); // ver los procedimientos de cada equipo

   //funciones primarias:
   function setOptions(){ // establece las opciones del select en dar salida alm->ext
     var xmlhttp2 = new XMLHttpRequest();
     xmlhttp2.onreadystatechange = function() {

       if (this.readyState == 4 && this.status == 200) {

         matEquipoExtAgregar2 = JSON.parse(this.responseText);

         if(ingresosEditar2==0){//primera vez que ingreso al modal Editar (Evitar rellenar el select Cliente)



           matEquipoExtAgregar2[0].forEach(function(cliente) {//select clientes
            //alert(cliente); //verificar el correcto funcionamiento del "forEach"
            $(".darSalida #inpCliente").append("<option value='"+cliente+"'>"+cliente+"</option>");

           });

           matEquipoExtAgregar2[1].forEach(function(modalidad) {//select modalidades
            //alert(modalidad); //verificar el correcto funcionamiento del "forEach"
            $(".darSalida #inpModalidad").append("<option value='"+modalidad+"'>"+modalidad+"</option>");

           });

           ingresosEditar2++;
         }//if ingresosDatos==0

       }
     };

     //xmlhttp.open("GET", "controlador_equipoExtAgregar.php", true);
     xmlhttp2.open("GET", "controlador_equipoExtAgregar.php", true);
     xmlhttp2.send();
   }//llenar las opciones del select al dar salida a equipo alm -> ext
   function setOptionsInsumos(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          //alert("state: "+this.readyState+" \n"+"response: "+this.status);
          if (this.readyState == 4 && this.status == 200) {
            matClientesInsumos = JSON.parse(this.responseText);


           if(ingresosSelectsIns==0){//primera vez que ingreso al modal Editar (Evitar rellenar el select  ingenieros)

              matClientesInsumos[0].forEach(function(cliente) {//select Ingenieros
               $(".formComprasInsumos #inpCliente").append("<option value='"+cliente[0]+"'>"+cliente[0]+"</option>");
              });
              matClientesInsumos[1].forEach(function(insumo) {//select Ingenieros
               $(".formComprasInsumos #inpInsumo").append("<option value='"+insumo[0]+"'>"+insumo[0]+"</option>");
              });
              ingresosSelectsIns++;
           }

          }
        };

        xmlhttp.open("GET", "controlador_insumoSelects.php", true); //si no es false, no entra (solo para insumos grafs)
        xmlhttp.send();
   }
   function cargaLaboral(cantProcs){//matAlertaCL inserta valores a los vectores de carga laboral (cedulas, prevs, corrs, cals)

     var xmlhttp3 = new XMLHttpRequest();
     xmlhttp3.onreadystatechange = function() {

       if (this.readyState == 4 && this.status == 200) {
         var matriz_CargaLaboral;
         matriz_CargaLaboral = JSON.parse(this.responseText);//[[cc], [cc,prevs],[cc,corrs],[cc,cals]]
         cedulas=matriz_CargaLaboral[0]; //OK
         cedulas=ccArraytoString(cedulas);
         nombresIngenieros=matriz_CargaLaboral[4]; //OK
         prevs=matriz_CargaLaboral[1];
         corrs=matriz_CargaLaboral[2];
         cals=matriz_CargaLaboral[3];
         ccPrevs=getColumns(prevs);
         ccCorrs=getColumns(corrs);
         ccCals=getColumns(cals);
         for (var i = 0; i < cedulas.length; i++) {
           //Prevs:
           if(ccPrevs.indexOf(cedulas[i])!=(-1)){//está
             cantidadPrevs[i]=prevs[ccPrevs.indexOf(cedulas[i])][1];
             cantidadPrevs[i]=parseInt(cantidadPrevs[i]);
           }else{
             cantidadPrevs[i]=0;
           }
           //Corrs:
           if(ccCorrs.indexOf(cedulas[i])!=(-1)){//está
             cantidadCorrs[i]=corrs[ccCorrs.indexOf(cedulas[i])][1];
             cantidadCorrs[i]=parseInt(cantidadCorrs[i]);
           }else{
             cantidadCorrs[i]=0;
           }
           //Cals:
           if(ccCals.indexOf(cedulas[i])!=(-1)){//está
             cantidadCals[i]=cals[ccCals.indexOf(cedulas[i])][1];
             cantidadCals[i]=parseInt(cantidadCals[i]);
           }else{
             cantidadCals[i]=0;
           }
         }
         for(i = 0; i < cantidadCals.length; i++){
           cantidadTotales[i] =cantidadCals[i]+cantidadPrevs[i]+cantidadCorrs[i];
         }
         //matriz Alerta:

         var nombreIng;
         for (i = 0; i < cantidadTotales.length; i++) {
           if (cantidadTotales[i]>=cantProcs) {
             nombreIng=nombresIngenieros[i];
             nombreIng=nombreIng.toString();
             nombreIng=nombreIng.replace(/,/gi, " ");
             matAlertasCL[nombreIng]=cantidadTotales[i];

           }
         }


         //Gráficos:
         GraficoCLTodos();// Carga laboral todos
         GraficoCLTotal();//Carga Laboral Total:

       }
     };
     xmlhttp3.open("GET", "controlador_cargaLaboral.php", false);
     xmlhttp3.send();
   }
   function cargarLimitesAlertas(){
     var xmlhttp2 = new XMLHttpRequest();

     var x=this.readyState;
     var y=this.status;
     xmlhttp2.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
              limitesAlertas = JSON.parse(this.responseText);
          }

       };


       xmlhttp2.open("GET", "controlador_limitesAlertas.php", false);
       xmlhttp2.send();


   }
   function alertasComprasInsumos(porcentaje){//matAlertaVentaInsumos

        obj1={"porcentaje":porcentaje};
        objPerc = JSON.stringify(obj1);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            matAlertasVentaInsumos = JSON.parse(this.responseText); //matriz alertas compras insumos
          }
        };
        xmlhttp.open("GET", "controlador_alertasCompraInsumos.php?per="+objPerc, false);
        xmlhttp.send();
   }
   function alertasCorrectivos(){//matAlertaVentaInsumos
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            matAlertasCorrs = JSON.parse(this.responseText); //matriz alertas compras insumos
            var t=0;
          }
        };
        xmlhttp.open("GET", "controlador_alertasCorrectivos.php", false);
        xmlhttp.send();
   }
   function alertasProcsProximos(dias_procedimientos){//matAlertasProcs
        obj1={"dias_proc":dias_procedimientos};
        objDias = JSON.stringify(obj1);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            matAlertasProcs = JSON.parse(this.responseText); //matriz alertas compras insumos
            var t=0;
          }
        };
        xmlhttp.open("GET", "controlador_alertasProcedimientos.php?dias="+objDias, false);
        xmlhttp.send();
   }
   function alertasEsterilizacion(dias_esterilizacion){//matAlertasEsterilizacion
        obj1={"dias_esterilizacion":dias_esterilizacion};
        objDias = JSON.stringify(obj1);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            matAlertasEsterilizacion = JSON.parse(this.responseText); //matriz alertas FV esterilización
            var t=0;
          }
        };
        xmlhttp.open("GET", "controlador_alertasEsterilizacion.php?dias="+objDias, false);
        xmlhttp.send();
   }
   function tablaAlertasInsumos(matAlertasVentaInsumos){
     var comandoHTML;
     matAlertasVentaInsumos.forEach(function(alerta) {
       $("#tablaAlertasInsumos tbody").append("<tr>");
       for(var index in alerta) {
         //document.write( index + " : " + items[index] + "<br />");
         comandoHTML="<td>"+alerta[index]+"</td>";
         $("#tablaAlertasInsumos tbody").append(comandoHTML);
       }
       $("#tablaAlertasInsumos tbody").append("</tr>");
     });

   }
   function tablaAlertasCargaLaboral(matAlertasCL){
     var comandoHTML1;//INGENIERO
     var comandoHTML2;//CANTIDAD
     //matAlertasCL.forEach(function(alerta) {

       for(var index in matAlertasCL) {
         $("#tablaAlertasCL tbody").append("<tr>");
         //document.write( index + " : " + items[index] + "<br />");
         comandoHTML1="<td>"+index+"</td>";
         comandoHTML2="<td>"+matAlertasCL[index]+"</td>";
         $("#tablaAlertasCL tbody").append(comandoHTML1);
         $("#tablaAlertasCL tbody").append(comandoHTML2);
         $("#tablaAlertasCL tbody").append("</tr>");
       }

     //});

   }
   function tablaAlertasCorrectivos(matAlertasCorrs){
     var comandoHTML;
     matAlertasCorrs.forEach(function(alerta) {
       $("#tablaAlertasCorrs tbody").append("<tr>");
       for(var index in alerta) {
         comandoHTML="<td>"+alerta[index]+"</td>";
         $("#tablaAlertasCorrs tbody").append(comandoHTML);
       }
       $("#tablaAlertasCorrs tbody").append("</tr>");
     });

   }
   function tablaAlertasProcedimientos(matAlertasProcs){
     var comandoHTML;
     matAlertasProcs.forEach(function(alerta) {
       $("#tablaAlertasProcs tbody").append("<tr>");

       comandoHTML="<td>"+alerta["codigo"]+"</td>";
       $("#tablaAlertasProcs tbody").append(comandoHTML);
       comandoHTML="<td>"+alerta["procedimiento"]+"</td>";
       $("#tablaAlertasProcs tbody").append(comandoHTML);
       comandoHTML="<td>"+alerta["nombre"]+"</td>";
       $("#tablaAlertasProcs tbody").append(comandoHTML);
       comandoHTML="<td>"+alerta["modalidad"]+"</td>";
       $("#tablaAlertasProcs tbody").append(comandoHTML);
       comandoHTML="<td>"+alerta["empleado"]+"</td>";
       $("#tablaAlertasProcs tbody").append(comandoHTML);
       comandoHTML="<td>"+alerta["cliente"]+"</td>";
       $("#tablaAlertasProcs tbody").append(comandoHTML);
       comandoHTML="<td>"+alerta["fecha"]+"</td>";
       $("#tablaAlertasProcs tbody").append(comandoHTML)

       $("#tablaAlertasProcs tbody").append("</tr>");
     });

   }
   function tablaAlertasEsterilizacion(matAlertasEsterilizacion){
     var comandoHTML;
     matAlertasEsterilizacion.forEach(function(alerta) {
       $("#tablaAlertasFV tbody").append("<tr>");

       comandoHTML="<td>"+alerta["nombre"]+"</td>";
       $("#tablaAlertasFV tbody").append(comandoHTML);
       comandoHTML="<td>"+alerta["ubicacion"]+"</td>";
       $("#tablaAlertasFV tbody").append(comandoHTML);
       comandoHTML="<td>"+alerta["cliente"]+"</td>";
       $("#tablaAlertasFV tbody").append(comandoHTML);
       comandoHTML="<td>"+alerta["FV"]+"</td>";
       $("#tablaAlertasFV tbody").append(comandoHTML);
       comandoHTML="<td>"+alerta["empleado"]+"</td>";

       $("#tablaAlertasFV tbody").append("</tr>");
     });

   }
   //Funciones secundarias:
   function getColumns(matriz){
     var columns=[];
     for (var i = 0; i < matriz.length; i++) {
       columns.push(matriz[i][0]);
     }
     return columns;
   }
   function ccArraytoString(ccArrays){
     var ccString=[];
     for (var i = 0; i < ccArrays.length; i++) {
       ccString[i]=ccArrays[i][0];
     }
     return ccString;
   }
   function GraficoCLTodos(){

     var ctx = document.getElementById("CL_Todos"); //nombre Canvas (CL=carga Laboral)
     var myLineChart = new Chart(ctx, {
       type: 'bar',
       data: {

         labels: nombresIngenieros,
         datasets: [{
           label: "Mantenimientos preventivos",
           backgroundColor:"rgba(68, 153, 231,1)",
           borderColor: "rgb(68, 153, 231)",
           data: cantidadPrevs,
         },{
           label: "Mantenimientos correctivos",
           backgroundColor:"rgba(244, 29, 29, 0.85)",
           borderColor: "rgb(244, 29, 29)",
           data: cantidadCorrs,
         },{
           label: "Calibraciones",
           backgroundColor:"rgba(230, 138, 0, 0.8)",
           borderColor: "rgb(230, 138, 0)",
           data: cantidadCals,
         }],
       },
       options: {
         scales: {
           xAxes: [{
             time: {
               unit: 'Cédula'
             },
             gridLines: {
               display: false
             },
             ticks: {
               maxTicksLimit: 6
             }
           }],
           yAxes: [{
             ticks: {
               min: 0,
               max: Math.max.apply(null, (cantidadPrevs.concat(cantidadCorrs)).concat(cantidadCals))+1,
               maxTicksLimit:(2*Math.max.apply(null, (cantidadPrevs.concat(cantidadCorrs)).concat(cantidadCals)))-1 //2*Math.max.apply(null, (cantidadPrevs.concat(cantidadCorrs)).concat(cantidadCals))
             },
             gridLines: {
               display: true
             }
           }],
         },
         legend: {
           display: true
         }
       }
     });
   }
   function GraficoCLTotal(){
     var ctx = document.getElementById("CL_Total"); //nombre Canvas (CL=carga Laboral)
     var myLineChart = new Chart(ctx, {
       type: 'bar',
       data: {

         labels: nombresIngenieros,
         datasets: [{
           label: "Total procedimientos",
           backgroundColor: "rgba(106, 106, 106,0.85)",
           borderColor: "rgba(106, 106, 106,0.85)",
           data: cantidadTotales,
         }],
       },
       options: {
         scales: {
           xAxes: [{
             time: {
               unit: 'Cédula'
             },
             gridLines: {
               display: false
             },
             ticks: {
               maxTicksLimit: 6
             }
           }],
           yAxes: [{
             ticks: {
               min: 0,
               max: Math.max.apply(null, cantidadTotales)+1,
               maxTicksLimit: (2*Math.max.apply(null, cantidadTotales))-1
             },
             gridLines: {
               display: true
             }
           }],
         },
         legend: {
           display: true
         }
       }
     });
   }

}); //ready function

function verificarSerial(str) { //verifica que el serial ext ingresado exista...
  //usado en editar del procedimiento
  var xhttp;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {


      respuesta=this.responseText;
      respuesta=respuesta.trim();


      if(respuesta==1){ //sí el cliente no existe

        $(".editarProcedimientoForm #inpSerialEquipo, .agregarProcedimientoForm #inpSerialEquipo").css("background-color","rgb(255, 148, 148)");
        $(".editarProcedimientoForm #inpCliente, .agregarProcedimientoForm #inpCliente").css("background-color","rgb(255, 148, 148)");
        $(".editarProcedimientoForm #inpCliente, .agregarProcedimientoForm #inpCliente").val("");
        $(".modal-footer #btn_actualizar_procedimiento").prop("disabled",true); //deshabilitar botón envío

      }else{

        $(".editarProcedimientoForm #inpSerialEquipo, .agregarProcedimientoForm #inpSerialEquipo").css("background-color","white");
        $(".editarProcedimientoForm #inpCliente, .agregarProcedimientoForm #inpCliente").css("background-color","rgb(225, 225, 225)   ");
        $(".editarProcedimientoForm #inpCliente, .agregarProcedimientoForm #inpCliente").val(respuesta); //nombre del cliente segun el serial ingresado
        $(".modal-footer #btn_actualizar_procedimiento").prop("disabled",false);
      }

    }
  };
  xhttp.open("GET", "gethint.php?q="+str, true);
  xhttp.send();
}
function GraficoCorrsEquipo(datos,serial){
  var ctx = document.getElementById("Corrs_Equipo"); //nombre Canvas (CL=carga Laboral)
  var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {

      labels: datos[0],
      datasets: [{
        label: "Correctivos por año del equipo "+serial,
        backgroundColor: "rgba(247, 51, 51, 0.85)",
        borderColor: "rgba(247, 51, 51, 0.85)",
        data: datos[1],
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'Años'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 30//Math.max.apply(null, datos[0])
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max:Math.max.apply(null, datos[1])+1,
            maxTicksLimit: (Math.max.apply(null,datos[1]))+3
          },
          gridLines: {
            display: true
          }
        }],
      },
      legend: {
        display: true
      }
    }
  });
}
function GraficoCompras(cantidadCompras,tiempo, ins, cli){
  var ctx = document.getElementById("compras_insumos"); //nombre Canvas (CL=carga Laboral)
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {

      labels: tiempo,
      datasets: [{
        label: ins+" de "+cli,
        backgroundColor: "rgba(17, 41, 200, 0.85)",
        borderColor: "rgba(17, 41, 200, 0.85)",
        data: cantidadCompras,
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'Mes'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 6
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: Math.max.apply(null, cantidadCompras)+1,
            maxTicksLimit: (2*Math.max.apply(null, cantidadCompras))-1
          },
          gridLines: {
            display: true
          }
        }],
      },
      legend: {
        display: true
      }
    }
  });
}
function getUltimosMeses(){
  var ultimosMeses=[];
  var meses=["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];
  var fechaActual= new Date();
  var mesActual= fechaActual.getMonth(); // 0 - 11
  var yearActual=fechaActual.getFullYear();

  for (var i = mesActual +1; i < 12; i++) {//meses del año anterior
    ultimosMeses.push(meses[i]+" "+(yearActual-1));
  }

  for (var j = 0; j < mesActual+1; j++) {//meses del año actual
    ultimosMeses.push(meses[j]+" "+(yearActual));
  }
  return ultimosMeses;
}
function ordenarCantidades(array){
  var cantidadesOrdenadas=[];
  var fechaActual= new Date();
  var mesActual= fechaActual.getMonth(); // 0 - 11

  for (var i = mesActual +1; i < 12; i++) {//meses del año anterior
    cantidadesOrdenadas.push(array[i]);
  }

  for (var j = 0; j < mesActual+1; j++) {//meses del año actual
    cantidadesOrdenadas.push(array[j]);
  }
  return cantidadesOrdenadas;

}
/*sí se ubica dentro del Ready no funciona
   para las filas que estan en otras pestañas de la tabla (mayoreas a 10)*/

//DETALLES
$(".equipos_ext_link .detalles").click(function(e){ //equipos externoswr  bv

   //var serial=$(e.target).attr("id");
   var clases=$(e.target).attr("class");//clases de la etiqueta a
   var serial=clases.split(' ')[0];//primera clase de la etiqueta a (serial)

    if(serial== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
     var padre=$(e.target).parent();
     clases=padre.attr("class");
     serial=clases.split(' ')[0];
   }

   obj={"serial":serial};
   objSerial = JSON.stringify(obj);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       regEquipoExt = JSON.parse(this.responseText);
       $("#nombre_ee").html("<h4><b>"+regEquipoExt[2]+"</b></h4><br/>");
       $("#serial_ee").html(regEquipoExt[0]);
       $("#placa_ee").html(regEquipoExt[1]);
       $("#marca_ee").html(regEquipoExt[3]);
       $("#modelo_ee").html(regEquipoExt[4]);
       $("#fechai_ee").html(regEquipoExt[5]);
       $("#fechao_ee").html(regEquipoExt[6]);
       $("#precioc_ee").html("$"+regEquipoExt[7]);
       $("#preciov_ee").html("$"+regEquipoExt[8]);
       $("#modalidad_ee").html(regEquipoExt[9]);
       $("#cliente_ee").html(regEquipoExt[10]);
       $("#ubicacion_ee").html(regEquipoExt[11]);
       $("#garantia_ee").html(regEquipoExt[12]);
       $("#estado_ee").html(regEquipoExt[13]);
     }
   };
   xmlhttp.open("GET", "controlador_equipoExt.php?ser="+objSerial, true);
   xmlhttp.send();
});
$(".equipos_alm_link .detalles").click(function(e){ //equipos almacen
   var clases=$(e.target).attr("class");//clases de la etiqueta a
   var serial_alm=clases.split(' ')[0];//primer clase de la etiqueta a
   if(serial_alm== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
    var padre=$(e.target).parent();
    clases=padre.attr("class");
    serial_alm=clases.split(' ')[0];
  }

   obj={"serial":serial_alm};
   objSerial_alm = JSON.stringify(obj);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       regEquipoAlm = JSON.parse(this.responseText);
       $("#nombre_ea").html("<h4><b>"+regEquipoAlm[1]+"</b></h4><br/>");
       $("#serial_ea").html(regEquipoAlm[0]);
       $("#marca_ea").html(regEquipoAlm[2]);
       $("#modelo_ea").html(regEquipoAlm[3]);
       $("#fechai_ea").html(regEquipoAlm[4]);
       $("#precioc_ea").html("$"+regEquipoAlm[5]);
     }
   };
   xmlhttp.open("GET", "controlador_equipoAlm.php?seralm="+objSerial_alm, true);
   xmlhttp.send();
});
$(".procedimientos_link .detalles").click(function(e){ //Proedimientos
   var clases=$(e.target).attr("class");//clases de la etiqueta a
   var cod=clases.split(' ')[0];//primer clase de la etiqueta a
   if(cod== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
    var padre=$(e.target).parent();
    clases=padre.attr("class");
    cod=clases.split(' ')[0];
  }
   obj={"codigo":cod};
   objCod = JSON.stringify(obj);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       var regProcedimiento = JSON.parse(this.responseText);
       if (regProcedimiento[2]==0) {
         ejecutado="NO";
       }else {
         ejecutado="SI";
       }
       $("#nombre_proc").html("<h4><b>"+regProcedimiento[5]+"</b></h4><br/>");
       $("#cod_proc").html(regProcedimiento[0]);
       $("#serial_proc").html(regProcedimiento[4]);
       $("#equipo_proc").html(regProcedimiento[3]);
       $("#fecha_proc").html(regProcedimiento[1]);
       $("#cliente_proc").html(regProcedimiento[6]);
       $("#ejec_proc").html(ejecutado);
       $("#empleado_proc").html(regProcedimiento[7]+" "+regProcedimiento[8]+" "+regProcedimiento[9]);

     }
   };
   xmlhttp.open("GET", "controlador_Procedimientos.php?cod="+objCod, true);
   xmlhttp.send();
});
$(".clientes_link .detalles").click(function(e){ //Clientes
   var clases=$(e.target).attr("class");//clases de la etiqueta a
   var cod=clases.split(' ')[0];//primer clase de la etiqueta a
   if(cod== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
    var padre=$(e.target).parent();
    clases=padre.attr("class");
    cod=clases.split(' ')[0];
  }
   obj={"codigo":cod};
   objCod = JSON.stringify(obj);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       var regCliente = JSON.parse(this.responseText);
       var array_telefonos=regCliente[1];
       var array_correos=regCliente[2];
       var tels="";
       var correos="";
       var cont=0;
       array_telefonos.forEach(function(element){ //clientes con mas de un teléfono
         if(cont==0){
           tels=element;
         }else{
          tels=tels+", "+element;
         }
         cont++;
       });
       cont=0;
       array_correos.forEach(function(element){//clientes con mas de un correo
         if(cont==0){
          correos=element;
        }else{
          correos=correos+", "+element;
        }
        cont++;
       });
       cont=0;
       $("#nombre_cli").html("<h4><b>"+regCliente[0][1]+"</b></h4><br/>");
       $("#cod_cli").html(regCliente[0][0]);
       $("#ciudad_cli").html(regCliente[0][2]);
       $("#responsable_cli").html(regCliente[0][3]);
       $("#tel_cli").html(tels);
       $("#correo_cli").html(correos);
     }
   };
   xmlhttp.open("GET", "controlador_Cliente.php?cod="+objCod, true);
   xmlhttp.send();
});
$(".empleado_link .detalles").click(function(e){ //Procedimientos
   var clases=$(e.target).attr("class");//clases de la etiqueta a
   var cc=clases.split(' ')[0];//primer clase de la etiqueta a
   if(cc== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
    var padre=$(e.target).parent();
    clases=padre.attr("class");
    cc=clases.split(' ')[0];
  }
   obj={"cedula":cc};
   objCod = JSON.stringify(obj);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       var regEmpleado = JSON.parse(this.responseText);
       var nombre_completo= regEmpleado[1]+" "+regEmpleado[2]+" "+regEmpleado[3];
       $("#nombre_emp").html("<h4><b>"+nombre_completo+"</b></h4><br/>");
       $("#cc_emp").html(regEmpleado[0]);
       $("#cargo_emp").html(regEmpleado[6]);
       $("#tel_emp").html(regEmpleado[4]);
       $("#correo_emp").html(regEmpleado[5]);
     }
   };
   xmlhttp.open("GET", "controlador_Empleado.php?cod="+objCod, true);
   xmlhttp.send();
});

//EDITAR:
$(".equipos_ext_link .editar").click(function(e){ //equipos externoswr  bv

   var clases=$(e.target).attr("class");//clases de la etiqueta a
   var serial=clases.split(' ')[0];//primer clase de la etiqueta a
    if(serial== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
     var padre=$(e.target).parent();
     clases=padre.attr("class");
     serial=clases.split(' ')[0];
   }

   obj={"serial":serial};
   objSerial = JSON.stringify(obj);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       matEquipoExtEditar = JSON.parse(this.responseText);
       $(".editarEquipoExtForm #inpSerial").val(matEquipoExtEditar[0][0]);
       $(".editarEquipoExtForm #inpPlaca").val(matEquipoExtEditar[0][1]);
       $(".editarEquipoExtForm #inpNombre").val(matEquipoExtEditar[0][2]);
       $(".editarEquipoExtForm #inpMarca").val(matEquipoExtEditar[0][3]);
       $(".editarEquipoExtForm #inpModelo").val(matEquipoExtEditar[0][4]);
       $(".editarEquipoExtForm #inpFechaCompra").val(matEquipoExtEditar[0][5]);
       $(".editarEquipoExtForm #inpFechaSalida").val(matEquipoExtEditar[0][6]);
       $(".editarEquipoExtForm #inpPrecioCompra").val(matEquipoExtEditar[0][7]);
       $(".editarEquipoExtForm #inpPrecioVenta").val(matEquipoExtEditar[0][8]);
       $(".editarEquipoExtForm #inpUbicacion").val(matEquipoExtEditar[0][11]);
       $(".editarEquipoExtForm #inpFechaGarantia").val(matEquipoExtEditar[0][12]);
       $(".editarEquipoExtForm #inpEstado").val(matEquipoExtEditar[0][13]);



       if(ingresosEditar==0){//primera vez que ingreso al modal Editar (Evitar rellenar el select Cliente)
         matEquipoExtEditar[1].forEach(function(cliente) {//select clientes
          $(".editarEquipoExtForm #inpCliente").append("<option value='"+cliente+"'>"+cliente+"</option>");
         });
         matEquipoExtEditar[2].forEach(function(modalidad) {//select modalidades

          $(".editarEquipoExtForm #inpModalidad").append("<option value='"+modalidad+"'>"+modalidad+"</option>");
         });

         ingresosEditar++;
       }//if ingresosDatos==0
       //asignar selected a clientes y modalidades que sean los del modal actual
       $('.editarEquipoExtForm option[value="'+matEquipoExtEditar[0][10]+'"]'  ).prop("selected",true);
       $('.editarEquipoExtForm option[value="'+matEquipoExtEditar[0][9]+'"]'  ).prop("selected",true);

     }
   };

   xmlhttp.open("GET", "controlador_equipoExtEditar.php?ser="+objSerial, true);
   xmlhttp.send();
});
$(".equipos_alm_link .editar").click(function(e){ //equipos almacen  bv

   var clases=$(e.target).attr("class");//clases de la etiqueta a
   var serial=clases.split(' ')[0];//primer clase de la etiqueta a
    if(serial== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
     var padre=$(e.target).parent();
     clases=padre.attr("class");
     serial=clases.split(' ')[0];
   }

   obj={"serial":serial};
   objSerial = JSON.stringify(obj);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       matEquipoAlmEditar = JSON.parse(this.responseText);
       $(".editarEquipoAlmForm #inpSerial").val(matEquipoAlmEditar[0]);
       $(".editarEquipoAlmForm #inpNombre").val(matEquipoAlmEditar[1]);
       $(".editarEquipoAlmForm #inpMarca").val(matEquipoAlmEditar[2]);
       $(".editarEquipoAlmForm #inpModelo").val(matEquipoAlmEditar[3]);
       $(".editarEquipoAlmForm #inpFechaCompra").val(matEquipoAlmEditar[4]);
       $(".editarEquipoAlmForm #inpPrecioCompra").val(matEquipoAlmEditar[5]);
     }
   };

   xmlhttp.open("GET", "controlador_equipoAlmEditar.php?ser="+objSerial, true);
   xmlhttp.send();
});
$(".procedimientos_link .editar").click(function(e){ //Procedimientos

   var clases=$(e.target).attr("class");//clases de la etiqueta a
   var codigo=clases.split(' ')[0];//primer clase de la etiqueta a
    if(codigo== "fa"){ //sí se reconoce el icono (<i>) como fuente debe asignarse la var "padre" como target
     var padre=$(e.target).parent();
     clases=padre.attr("class");
     codigo=clases.split(' ')[0];
   }

   obj={"codigo":codigo};
   objCodigo = JSON.stringify(obj);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       matProcedimientoEditar = JSON.parse(this.responseText); //{procedimientos,Clientes,Ingenieros}
       $(".editarProcedimientoForm #inpCodigo").val(matProcedimientoEditar[0][0]);
       //$(".editarProcedimientoForm #inpTipo").val(matProcedimientoEditar[0][2]);
       $(".editarProcedimientoForm #inpSerialEquipo").val(matProcedimientoEditar[0][4]);
       $(".editarProcedimientoForm #inpFecha").val(matProcedimientoEditar[0][1]);
       $(".editarProcedimientoForm #inpCliente").val(matProcedimientoEditar[0][6]);
       $(".editarProcedimientoForm #inpRealizado").val(matProcedimientoEditar[0][2]);

       //$(".editarProcedimientoForm #inpIngeniero").val(matProcedimientoEditar[0][5]);

       if(ingresosEditar==0){//primera vez que ingreso al modal Editar (Evitar rellenar el select Cliente e ingenieros)

         matProcedimientoEditar[1].forEach(function(ingeniero) {//select Ingenieros

          $(".editarProcedimientoForm #inpIngeniero").append("<option value='"+ingeniero+"'>"+ingeniero+"</option>");
         });

         ingresosEditar++;
       }//if ingresosDatos==0


       nombreIngeniero=matProcedimientoEditar[0][7]+" "+matProcedimientoEditar[0][8]+" "+matProcedimientoEditar[0][9]; //nombres+primerApellido+segundoApellido
       $('.editarProcedimientoForm option[value="'+ nombreIngeniero+'"]'  ).prop("selected",true);//seleccionar ingeniero en el select

       $('.editarProcedimientoForm input[value="'+matProcedimientoEditar[0][5]+'"]'  ).prop("checked",true);//tipo prcedimiento
       if (matProcedimientoEditar[0][2]=="1") { //Realizado o no
         $('.editarProcedimientoForm #inpRealizado').prop("checked",true);
       }else{
        $('.editarProcedimientoForm #inpRealizado').prop("checked",false);
      }

     }
   };

   xmlhttp.open("GET", "controlador_ProcedimientoEditar.php?cod="+objCodigo, true);
   xmlhttp.send();
});
$(".clientes_link .editar").click(function(e){ //Clientes  bv

   var clases=$(e.target).attr("class");//clases de la etiqueta a
   var serial=clases.split(' ')[0];//primer clase de la etiqueta a
    if(serial== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
     var padre=$(e.target).parent();
     clases=padre.attr("class");
     serial=clases.split(' ')[0];
   }

   obj={"serial":serial};
   objSerial = JSON.stringify(obj);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       matClienteEditar = JSON.parse(this.responseText);
       $(".editarClienteForm #inpCodigo").val(matClienteEditar[0][0]);
       $(".editarClienteForm #inpNombre").val(matClienteEditar[0][1]);
       $(".editarClienteForm #inpCiudad").val(matClienteEditar[0][2]);
       $(".editarClienteForm #inpResponsable").val(matClienteEditar[0][3]);
       $(".editarClienteForm #inpTel1").val(matClienteEditar[1][0]);
       $(".editarClienteForm #inpTel2").val(matClienteEditar[1][1]);
       $(".editarClienteForm #inpCorreo").val(matClienteEditar[2][0]);
       $(".editarClienteForm #inpCorreo2").val(matClienteEditar[2][1]);
     }
   };

   xmlhttp.open("GET", "controlador_ClienteEditar.php?ser="+objSerial, true);
   xmlhttp.send();
});
$(".empleado_link .editar").click(function(e){ //Clientes  bv

   var clases=$(e.target).attr("class");//clases de la etiqueta a
   var serial=clases.split(' ')[0];//primer clase de la etiqueta a
    if(serial== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
     var padre=$(e.target).parent();
     clases=padre.attr("class");
     serial=clases.split(' ')[0];
   }

   obj={"serial":serial};
   objSerial = JSON.stringify(obj);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       regEmpleadoEditar = JSON.parse(this.responseText);
       $(".editarEmpleadoForm #inpCedula").val(regEmpleadoEditar[0]);
       $(".editarEmpleadoForm #inpNombre").val(regEmpleadoEditar[1]);
       $(".editarEmpleadoForm #inpApellido1").val(regEmpleadoEditar[2]);
       $(".editarEmpleadoForm #inpApellido2").val(regEmpleadoEditar[3]);
       $(".editarEmpleadoForm #inpCargo").val(regEmpleadoEditar[6]);
       $(".editarEmpleadoForm #inpTel").val(regEmpleadoEditar[4]);
       $(".editarEmpleadoForm #inpCorreo").val(regEmpleadoEditar[5]);

     }
   };

   xmlhttp.open("GET", "controlador_EmpleadoEditar.php?ser="+objSerial, true);
   xmlhttp.send();
   $('#editarModal').modal('hide');
});

//ELIMINAR
$(".equipos_ext_link .eliminar").click(function(e){
  var clases=$(e.target).attr("class");//clases de la etiqueta a
  var cod=clases.split(' ')[0];//primer clase de la etiqueta a
   if(cod== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
      var padre=$(e.target).parent();
      clases=padre.attr("class");
      cod=clases.split(' ')[0];
    }
    $("#codigo_eliminar").text(cod);
    $(".btn_eliminarReg").attr("href", "controlador_eliminarEquipoExt.php?cod="+cod);
});
$(".equipos_alm_link .eliminar").click(function(e){
  var clases=$(e.target).attr("class");//clases de la etiqueta a
  var cod=clases.split(' ')[0];//primer clase de la etiqueta a
   if(cod== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
      var padre=$(e.target).parent();
      clases=padre.attr("class");
      cod=clases.split(' ')[0];
    }
    $("#codigo_eliminar").text(cod);
    $(".btn_eliminarReg").attr("href", "controlador_eliminarEquipoAlm.php?cod="+cod);
});
$(".procedimientos_link .eliminar").click(function(e){
  var clases=$(e.target).attr("class");//clases de la etiqueta a
  var cod=clases.split(' ')[0];//primer clase de la etiqueta a
   if(cod== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
      var padre=$(e.target).parent();
      clases=padre.attr("class");
      cod=clases.split(' ')[0];
    }
    $("#codigo_eliminar").text(cod);
    $(".btn_eliminarReg").attr("href", "controlador_eliminarProcedimiento.php?cod="+cod);
});
$(".clientes_link .eliminar").click(function(e){
  var clases=$(e.target).attr("class");//clases de la etiqueta a
  var cod=clases.split(' ')[0];//primer clase de la etiqueta a
   if(cod== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
      var padre=$(e.target).parent();
      clases=padre.attr("class");
      cod=clases.split(' ')[0];
    }
    $("#codigo_eliminar").text(cod);
    $(".btn_eliminarReg").attr("href", "controlador_eliminarCliente.php?cod="+cod);
});
$(".empleado_link .eliminar").click(function(e){
  var clases=$(e.target).attr("class");//clases de la etiqueta a
  var cod=clases.split(' ')[0];//primer clase de la etiqueta a
   if(cod== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
      var padre=$(e.target).parent();
      clases=padre.attr("class");
      cod=clases.split(' ')[0];
    }
    $("#codigo_eliminar").text(cod);
    $(".btn_eliminarReg").attr("href", "controlador_eliminarEmpleado.php?cod="+cod);
});

//AGREGAR
$(".btn_AddEquipoExt").click(function(e){

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {

    if (this.readyState == 4 && this.status == 200) {
      matEquipoExtAgregar = JSON.parse(this.responseText);

      if(ingresosEditar==0){//primera vez que ingreso al modal Editar (Evitar rellenar el select Cliente)
        matEquipoExtAgregar[0].forEach(function(cliente) {//select clientes

         $(".agregarEquipoExtForm #inpCliente").append("<option value='"+cliente+"'>"+cliente+"</option>");

        });
        matEquipoExtAgregar[1].forEach(function(modalidad) {//select modalidades

         $(".agregarEquipoExtForm #inpModalidad").append("<option value='"+modalidad+"'>"+modalidad+"</option>");
        });

        ingresosEditar++;
      }//if ingresosDatos==0


    }
  };

  xmlhttp.open("GET", "controlador_equipoExtAgregar.php", true);
  xmlhttp.send();
});
$(".btn_AddProcedimiento").click(function(e){ //Procedimientos

   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       matProcedimientoEditar = JSON.parse(this.responseText); //{Ingenieros}
       if(ingresosEditar==0){//primera vez que ingreso al modal Editar (Evitar rellenar el select  ingenieros)

         matProcedimientoEditar[0].forEach(function(ingeniero) {//select Ingenieros

          $(".agregarProcedimientoForm #inpIngeniero").append("<option value='"+ingeniero+"'>"+ingeniero+"</option>");
         });

         ingresosEditar++;
       }//if ingresosDatos==0


     }
   };

   xmlhttp.open("GET", "controlador_ProcedimientoAgregar.php", true);
   xmlhttp.send();
});
$(".btn_AddInsumo").click(function(e){ //insumos

   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     //alert("state: "+this.readyState+" \n"+"response: "+this.responseText);
     if (this.readyState == 4 && this.status == 200) {
       matNombresInsumos = JSON.parse(this.responseText); //{Ingenieros}

      if(ingresosAddInsumo==0){//primera vez que ingreso al modal Editar (Evitar rellenar el select  ingenieros)

         matNombresInsumos[0].forEach(function(insumo) {//select Ingenieros

          $(".agregarInsumoForm #inpNombre").append("<option value='"+insumo+"'>"+insumo+"</option>");
         });

         ingresosAddInsumo++;
       }//if ingresosDatos==0


     }
   };

   xmlhttp.open("GET", "controlador_InsumoAgregar.php", true);
   xmlhttp.send();
});

//TRASLADOS Insumos
$(".insumos_link .t-vendidos, .insumos_link .t-consignacion").click(function(e){ //insumos
  var clase=$(e.target).attr("class");//clases de la etiqueta a
  var cod=clase.split(' ')[0];
  obj={"cod":cod};
  objCod = JSON.stringify(obj);



   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     //alert("state: "+this.readyState+" \n"+"response: "+this.responseText);
     if (this.readyState == 4 && this.status == 200) {
       matInfoInsumos = JSON.parse(this.responseText);
       $(".agregarInsumoVendidoForm #inpCod, .agregarInsumoConsignacionForm #inpCod ").val(matInfoInsumos[1][0]);
       $(".agregarInsumoVendidoForm #inpNombre, .agregarInsumoConsignacionForm #inpNombre").val(matInfoInsumos[1][1]);
       $(".agregarInsumoVendidoForm #inpPC, .agregarInsumoConsignacionForm #inpPC").val(matInfoInsumos[1][2]);

       $(".agregarInsumoVendidoForm #inpCantidad, .agregarInsumoConsignacionForm #inpCantidad").val(matInfoInsumos[1][3]);
       $(".agregarInsumoVendidoForm #inpFvencimiento, .agregarInsumoConsignacionForm #inpFvencimiento").val(matInfoInsumos[1][4]);

      if(ingresosTrasladoIns==0){//primera vez que ingreso al modal Editar (Evitar rellenar el select  ingenieros)

         matInfoInsumos[0].forEach(function(cliente) {//select Ingenieros
          $("#formAgregarInsumoVendido #inpCliente, .agregarInsumoConsignacionForm #inpCliente").append("<option value='"+cliente+"'>"+cliente+"</option>");
         });
         ingresosTrasladoIns++;
      }//if ingresosDatos==0


     }
   };

   xmlhttp.open("GET", "controlador_InsumoTrasladar.php?cod="+objCod, true);
   xmlhttp.send();
});

//OTROS
$(".detallesEquipoAlm #btn_darSalida").click(function(e){
  var serial=regEquipoAlm[0]; //regEquipoExt es variable global
  var nombre=regEquipoAlm[1];
  var marca=regEquipoAlm[2];
  var modelo=regEquipoAlm[3];
  var fc=regEquipoAlm[4];
  var pc=regEquipoAlm[5];
  var link="view_darSalidaEquipoAlm2.php?serial="+serial+"&nombre="+nombre+"&marca="+marca+"&modelo="+modelo+"&fc="+fc+"&pc="+pc;
 window.open(link,"_self");
}); //Dar salida alm->ext
$(".corrsM_link .graficos").click(function(e){ //graficos correctivos
   var clases=$(e.target).attr("class");//clases de la etiqueta a
   var serial_alm=clases.split(' ')[0];//primer clase de la etiqueta a
   if(serial_alm== "fa"){ //sí se reconoce el icono (<i>) como fuente debe aignarse la var "padre" como target
    var padre=$(e.target).parent();
    clases=padre.attr("class");
    serial=clases.split(' ')[0];
  }

   obj={"serial":serial};
   objSerial = JSON.stringify(obj);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     //alert("state: "+this.readyState+" \n"+"response: "+this.status);
     if (this.readyState == 4 && this.status == 200) {
       matCorrsEquipo = JSON.parse(this.responseText);//(años/cantidad corrs)
       // borra la grafica anterior y se reescribe
       $('#Corrs_Equipo').remove(); //canvas
       $(".chartjs-size-monitor").remove();//
       $('#contGraficoCorrs').append('<canvas id="Corrs_Equipo" width="100" height="50"></canvas>');//contenedor del canvas
       GraficoCorrsEquipo(matCorrsEquipo,serial);

     }
   };
   xmlhttp.open("GET", "controlador_graficosCorrs.php?ser="+objSerial, false);
   xmlhttp.send();
});
$("#btn-grafsCompras").click(function(e){ //graficos compras
    var cliente=$(".formComprasInsumos #inpCliente").val();
    var insumo=$(".formComprasInsumos #inpInsumo").val();
    obj1={"cliente":cliente};
    objCli = JSON.stringify(obj1);
    obj2={"insumo":insumo};
    objIns = JSON.stringify(obj2);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     //alert("state: "+this.readyState+" \n"+"status: "+this.status);
     if (this.readyState == 4 && this.status == 200) {
       //alert(insumo+"  "+cliente);
        mat = JSON.parse(this.responseText);//(clientes/insumos)
        maximo=Math.max.apply(null, mat);

        if (maximo==0) { //no resultados
          $('#msjNoResultados').remove(); //canvas
          $('#compras_insumos').remove(); //canvas
          $(".chartjs-size-monitor").remove();//
          $('#contGraficoCompras').append('<h5 id="msjNoResultados">No se vendió <em>'+insumo+'</em> al cliente <em>'+cliente+'</em> en el último año</h5>');
        } else { //resultados
          cantidadCompras=ordenarCantidades(mat);
          time=getUltimosMeses();
          //cantidadCompras=[1,2,3,2,1];
          //time=["p1","p2","p3","p4","p5"];
          $('#msjNoResultados').remove(); //canvas
          $('#compras_insumos').remove(); //canvas
          $(".chartjs-size-monitor").remove();//
          $('#contGraficoCompras').append('<canvas id="compras_insumos" width="100" height="50"></canvas>');//contenedor del canvas
          GraficoCompras(cantidadCompras, time,insumo,cliente);
        }

        //verificar si todos los valores de mat son cero



     }
   };
   xmlhttp.open("GET", "controlador_comprasInsumos.php?cli="+objCli+"&ins="+objIns, false);//false
  xmlhttp.send();
});
$("#btn_configuraciones").click(function(e){ //campos de limies alertasProcsProximos


  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      $matLimites = JSON.parse(this.responseText);
      $("#perc_ins").val($matLimites.venta_insumos_perc);
      $("#cant_cl").val($matLimites.carga_laboral);
      $("#dias_procs").val($matLimites.dias_procedimientos);
      $("#correctivos").val($matLimites[$('#nombre_equipo').val()]);
      $("#dias_fv").val($matLimites.dias_esterilizacion);
      //$("#dias_fv").val($matLimites["BOMBA DE INFUSIÓN"]);
    }
  };
  xmlhttp.open("GET", "controlador_setLimites.php", true);
  xmlhttp.send();
});

$("#nombre_equipo").change(function(){
  //alert($('#nombre_equipo').val());
  //$('input[name=valor1]').val($(this).val());
  $("#correctivos").val($matLimites[$('#nombre_equipo').val()]);

});
