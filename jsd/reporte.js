var base_url;
var alertaValidacion = '';
var validarci = false;

function baseurl(enlace)
{
  base_url = enlace;
   
}
function validacionformularioreporte()
{
  
    var enlace = base_url + "index.php/prestamos/estado_prestamo";
    $.ajax({
        type: "GET",
        url: enlace,
        success: function(data)  
         {
            $('#estadoprestamo').html(data);
         }
    });
  
    var moneda = '<option VALUE="-1">Seleccionar opcion</OPTION><option VALUE="1">BOLIVIANOS</OPTION><option VALUE="2">DOLARES</OPTION>';
    
    $('#tipomoneda').html(moneda);


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
 
}
function primerreporte()
{
  if($('#tipomoneda').val() == '-1'){
    var moneda = 0;
  }else{
    var moneda = $('#tipomoneda').val();  
  }

 

  if($('#estadoprestamo').val() == '-1'){
    var estado = 0;
  }else{
    var estado = $('#estadoprestamo').val();  
  }

 
  var enlace = base_url + "index.php/reportes/imprimirprestamos/" + moneda+'/'+estado;

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