var base_url;
var alertaValidacion = '';
var validarci = false;

function baseurl(enlace)
{
    base_url = enlace;  
}
function validacioncuentasegreso()
{
	$("#fecha").datepicker({
    
      format: "yyyy-mm-dd",
      orientation: "top left",
      language: "es" 
    });

	$('#monto_egreso').keyup(function () 
  	{
	     var tem = $('#monto_egreso').val(); 
	     var RE = /^\d*\.?\d*$/;
	     if (!(RE.test(tem)))
	     {
  	 		$('#monto_egreso').val('');  	      		 
  	 	 }
	 	 
 	});

	  var enlace = base_url + "Registrar_ingresos/getcuentas";
    $.ajax({
        type: "GET",
        url: enlace,
        success: function(data)  
         {
            $('#cuentae').html(data);
         }
    });
    $('#cuentae').change(function () 
  	{

	    var cuenta = $('#cuentae').val();
      var id_ingreso = $('#id_ingreso').val();
      var enlace = base_url + "Registrar_ingresos/getsubcuenta_id";
        $.ajax({
            type: "GET",
            url: enlace,
             data: {cue:cuenta,ing:id_ingreso},
            success: function(data) 
            {
            	$('#sub_cuentae').html(data);            	
            }
        });
 	  });
}
function validacioncuentasingreso(){

  $("#fecha").datepicker({
    
      format: "yyyy-mm-dd",
      orientation: "top left",
      language: "es" 
    });

  $('#monto').keyup(function () 
    {
       var tem = $('#monto').val(); 
       var RE = /^\d*\.?\d*$/;
       if (!(RE.test(tem)))
       {
      $('#monto').val('');              
     }
     
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
function cerrarmodal()
{
  window.setTimeout('location.reload()', 500);
}
function nuevo_ingreso()
{
    var enlace = base_url + "Registrar_ingresos/nuevo_ingreso";
    location.href = enlace;    
}
function guardaringreso()
{
  if(validardatosingreso())
    { 
      var enlace = base_url + "Registrar_ingresos/guardaringresos";
      var datos = $('#formularioingreso').serialize();
        $.ajax({
            type: "GET",
            url: enlace,
            data: datos,
            success: function(data)  
             {
                //alert(data); 
               alert('LA INFORMACION SE GUARDO CORRECTAMENTE');
               var enlace = base_url + "Registrar_ingresos";
               location.href = enlace;
             }
        });
     }
    else
    {
      
      $('#validaregreso').text("Verificar: "+alertaValidacion);
      $('#validaregreso').show();

     // alert("Falta llenar o seleccionar los campos: \n"+alertaValidacion+"\n deberán ser llenados o seleccionados");
      alertaValidacion="";
    }
}


function validardatosingreso()
{
  var todook = true;  
  return todook;
} 


///////////////////////////////AGREGAR INGRESO
function reg_debe(id)
{
    var enlace = base_url + "Registrar_ingresos/registrar_debe/"+id;
    location.href = enlace;    
}

function nuevaegreso_ingreso()
{
  $('#accion').val('nuevo');
  $('#id_persona').val('');
  $('#cuentaegresomodal').modal('show');
}
function guardaregreso()
{  
   if(validardatos())
    { 
      var enlace = base_url + "Registrar_ingresos/guardaregreso";
      var datos = $('#formulariocuentaegreso').serialize();
        $.ajax({
            type: "GET",
            url: enlace,
            data: datos,
            success: function(data)  
             {
                //alert(data); 
               alert('SE GUARDO LA INFORMACION CORRECTAMENTE');
               window.setTimeout('location.reload()', 500);
             }
        });
     }
    else
    {
      
      $('#validaregreso').text("Verificar: "+alertaValidacion);
      $('#validaregreso').show();

     // alert("Falta llenar o seleccionar los campos: \n"+alertaValidacion+"\n deberán ser llenados o seleccionados");
      alertaValidacion="";
    }
}


function validardatos()
{
  var todook = true;
  var monto = parseFloat($('#montoingreso').val());
  var saldo = parseFloat($('#saldoegreso').val());
  var egreso = parseFloat($('#monto_egreso').val());
  if(monto < (saldo+egreso))
  {
    todook=false;
    alertaValidacion += "*El monto es mayor, valor máximo permitido: "+ (monto - saldo);
  }
  return todook;
} 

