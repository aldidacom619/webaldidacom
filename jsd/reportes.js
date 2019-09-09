var base_url;
var alertaValidacion = '';
var validarci = false;

function baseurl(enlace)
{
  base_url = enlace;
   
}
function valoresdefecto()
{
  
  $("#fecha1").datepicker({
    
      format: "yyyy-mm-dd",
      orientation: "top left",
      language: "es" 
    });
  $("#fecha2").datepicker({
    
      format: "yyyy-mm-dd",
      orientation: "top left",
      language: "es" 
    });



   var enlace = base_url + "Registrar_ingresos/getcuentas";
    $.ajax({
        type: "GET",
        url: enlace,
        success: function(data)  
         {
            $('#cuenta').html(data);
         }
    });
    $('#cuenta').change(function () 
    {
      var cuenta = $('#cuenta').val();
      var enlace = base_url + "Registrar_ingresos/getsubcuenta";
        $.ajax({
            type: "GET",
            url: enlace,
             data: {cue:cuenta},
            success: function(data) 
            {
              $('#sub_cuenta').html(data);              
            }
        });
    });

}
function imprimir_ingreso(id)
{
   
      var enlace = base_url + "reportes_ingresos/comprobante/"+id;
      window.open(enlace); 
      window.setTimeout('location.reload()', 500);
    
}
function imprimir_egreso(id)
{
    
      var enlace = base_url + "reportes_egresos/comprobante/"+id;
      window.open(enlace); 
      window.setTimeout('location.reload()', 500);
    

}


function imprimirporcuentas()
{
  

  var subcuenta = $('#sub_cuenta').val();
  var enlace = base_url + "imprimir_reportes/imprimirporcuentas/" + subcuenta;

  window.open(enlace);
}

function primerreporteamortizacion()
{
  if($('#fecha1').val() == ''  &&$('#fecha2').val() == '')
  {
    alert('POR FAVOR SELECCIONE UN INTERVALO DE FECHAS');
  }else{
      
      var fec1 = $('#fecha1').val(); 
      var fec2 = $('#fecha2').val();
      var enlace = base_url + "index.php/reportes/reporteamortizaciones/" + fec1+'/'+fec2;

     window.open(enlace);
  } 
}
