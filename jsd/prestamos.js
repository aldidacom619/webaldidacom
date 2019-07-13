var base_url;
var alertaValidacion = '';
var validarci = false;
function baseurl(enlace)
{
  base_url = enlace; 
  
}
function validacionformularioprestamo()
{
	$('#montoprestamobs').attr('readonly', true);
    $('#montoprestamo').attr('readonly', true);
    $('#tipocambioini').attr('readonly', true);
	var moneda = '<option VALUE="-1">Seleccionar opcion</OPTION><option VALUE="1">BOLIVIANOS</OPTION><option VALUE="2">DOLARES</OPTION>';
  	
  	$('#tipomoneda').html(moneda);

	$("#fecha_prestamo").datepicker({
    
	    format: "yyyy-mm-dd",
	    orientation: "top left",
	    language: "es" 
  	});
  	$("#fecdesembolso").datepicker({
    
	    format: "yyyy-mm-dd",
	    orientation: "top left",
	    language: "es"
  	});

  	$('#montoprestamo').keyup(function () 
  	{
      var tem = $('#montoprestamo').val();  
      var RE = /^\d*\.?\d*$/;
      if (RE.test(tem)) 
      {
      		var cambio = parseFloat($('#tipocambioini').val());
      		var resultado = parseFloat(tem) * cambio;
      		$('#montoprestamobs').val(Math.round(resultado*100)/100);	

      }
      else{ $('#montoprestamo').val('');}
 	});
 	$('#montoprestamobs').keyup(function () 
  	{
      var tem = $('#montoprestamobs').val(); 
      var RE = /^\d*\.?\d*$/;
      if (RE.test(tem)) 
      {
 		    var cambio = parseFloat($('#tipocambioini').val());
      		var resultado = parseFloat(tem) / cambio;
      		$('#montoprestamo').val(Math.round(resultado*100)/100);
      		 
 		}
      else{ $('#montoprestamobs').val('');}
 	});
 	
 	$('#intcorriente').keyup(function () 
  	{
      var tem = $('#intcorriente').val(); 
      var RE = /^\d*\.?\d*$/;
      if (RE.test(tem)) 
      {
      		
      }
      else{ $('#intcorriente').val('');}
 	});
 	
 	$('#intpenal').keyup(function () 
  	{
      var tem = $('#intpenal').val(); 
      var RE = /^\d*\.?\d*$/;
      if (RE.test(tem)) 
      {
      		
      }
      else{ $('#intpenal').val('');}
 	});
  $('#tipocambioini').keyup(function () 
    {
      var tem = $('#tipocambioini').val(); 
      var RE = /^\d*\.?\d*$/;
      if (RE.test(tem)) 
      {
          
      }
      else{ $('#tipocambioini').val('');}
  });
 	$('#plazoprestamo').keyup(function () 
  	{
      var tem = $('#plazoprestamo').val(); 
      var RE = /^[0-9]*$/;
      if (RE.test(tem)) 
      {
      		
      }
      else{ $('#plazoprestamo').val('');}
 	});


 	$('#fecha_prestamo').change(function () 
  	{
	    var fecha = $('#fecha_prestamo').val();
	    $('#fecdesembolso').val(fecha);

       var enlace = base_url + "index.php/prestamos/tipocambiomoneda";
        $.ajax({
            type: "GET",
            url: enlace,
             data: {fec:fecha},
            success: function(data) 
            {
            	if(data == 1){
            		$('#tipocambioini').val('');
                $('#tipocambioini').attr('readonly', false);
                $('#tipocambioiniaux').val(2);
            		//inabilitar();
            	}else {
            		$('#tipocambioini').val(data);
            		 $('#tipocambioini').attr('readonly',true);
                 $('#tipocambioiniaux').val(1);
            	}
            	
            }
        });
 	});

 	$('#tipomoneda').change(function () 
  	{
	    var moneda = $('#tipomoneda').val();
       	if(moneda == 1)
       	{
       		 $('#montoprestamobs').attr('readonly', false);
       		 $('#montoprestamo').attr('readonly', true);
       	}
       	else 
       	{
       		if(moneda == 2)
	       	{
	       		 $('#montoprestamobs').attr('readonly', true);
	       		$('#montoprestamo').attr('readonly', false);
	       	}
	       	else 
	       	{
	       		$('#montoprestamobs').attr('readonly', true);
	       		$('#montoprestamo').attr('readonly', trues);
	       	}
       	}
 	});


  	

  	var enlace = base_url + "index.php/prestamos/claseprestamo";
   	$.ajax({
        type: "GET",
        url: enlace,
        success: function(data)  
         {
            $('#claseprestamo').html(data);
         }
    });
    var enlace2 = base_url + "index.php/prestamos/tipogarantia";
    $.ajax({
        type: "GET",
        url: enlace2,
        success: function(data)  
         {
            $('#tipogarantia').html(data);
         }
    });

    


}
function inabilitar()
{
	$('#tipomoneda').prop('disabled', true);

	$('#montoprestamobs').attr('readonly', true);
    $('#montoprestamo').attr('readonly', true);

    $('#montoprestamobs').val('');
    $('#montoprestamo').val('');
    $('#tipomoneda option[value="-1"]').prop('selected','selected');

}
function cerrarmodal()
{
  var enlace = base_url + "index.php/personas/lista_persona";
  location.href = enlace;
}

function calcularmontos()
{
	  if(validardatos())
    { 

      $('#validarprestamo').hide();
      alertaValidacion="";
     var enlace = base_url + "index.php/prestamos/calcularprestamo";
      var datos = $('#formularioprestamo').serialize();
        $.ajax({
            type: "GET",
            url: enlace,
            data: datos,
            success: function(data)  
             {
                 $('#tablacalculos').html(data);
             }
        });
    }
    else
    {
        $('#validarprestamo').text("Verificar: "+alertaValidacion);
        $('#validarprestamo').show();
        alertaValidacion="";
    }
}
function guardarprestamo()
{
  if(validardatos())
  { 
    	if(confirm('¿Estas seguro de Registrar el prestamo??'))
    	{
    			var enlace = base_url + "index.php/prestamos/guardarprestamo";
    		    var datos = $('#formularioprestamo').serialize();
    		    $.ajax({
    		    type: "GET",
                url: enlace,
                data: datos,
                success: function(data)  
                 {
                    alert('SE GUARDO LA INFORMACION CORRECTAMENTE');
                    var enlace = base_url + "index.php/prestamos";
                    location.href = enlace;   
                 }
            });
        }
    	else
    	{
    		return false;
    	}
  }
  else
  {
      $('#validarprestamo').text("Verificar: "+alertaValidacion);
      $('#validarprestamo').show();
      alertaValidacion="";
  }

}


function validardatos()
{
  var todook = true;
  $(".form-group").removeClass("has-error");
   
  if($('#tipomoneda').val()== '-1')
  {        
    todook=false;
     $('#tipomoneda').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "* Tipo de Moneda - \n";
  }

  if($('#fecha_prestamo').val()=='')
  {        
     todook=false;
     $('#fecha_prestamo').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "*Fecha prestamo  \n";
  } 

   if($('#claseprestamo').val()== '-1')
  {        
    todook=false;
     $('#claseprestamo').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "* Clase de prestamo - \n";
  }

  if($('#tipogarantia').val()== '-1')
  {        
    todook=false;
     $('#tipogarantia').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "* Tipo de garantia - \n";
  }


if($('#contrato').val()=='')
  {        
     todook=false;
     $('#contrato').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "*Numero de contrato  \n";
  } 
  if($('#tipocambioini').val()=='')
  {        
     todook=false;
     $('#tipocambioini').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "*Tipo de Cambio \n";
  } 


   if($('#montoprestamobs').val()=='')
  {        
     todook=false;
     $('#montoprestamobs').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "*Monto de prestamo \n";
  } 

  if($('#montoprestamo').val()=='')
  {        
     todook=false;
     $('#montoprestamo').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "*Monto de prestamo \n";
  } 

    if($('#fecdesembolso').val()=='')
  {        
     todook=false;
     $('#fecdesembolso').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "*Fecha Desembolso \n";
  } 


    if($('#intcorriente').val()=='')
  {        
     todook=false;
     $('#intcorriente').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "*Interes Corriente \n";
  } 


    if($('#intpenal').val()=='')
  {        
     todook=false;
     $('#intpenal').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "*Interes Penal \n";
  } 


    if($('#plazoprestamo').val()=='')
  {        
     todook=false;
     $('#plazoprestamo').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "*Plazo del prestamo \n";
  } 



  

  return todook;
} 

function verkardex(idprestamo)
{
	 var enlace = base_url + "kardex/verprestamo/"+ idprestamo;
  location.href = enlace;
}
function modificarpresta(idprestamo)
{
  var enlace = base_url + "prestamos/modificarprestamo/"+ idprestamo;
  location.href = enlace;
}

function imprimircalculos()
{
  var persona = $('#id_persona').val() ;
   var fecha = $('#fecha_prestamo').val();
   var tipomoneda = $('#tipomoneda').val(); 
   var tipocambioini = $('#tipocambioini').val();
   var montoprestamobs = $('#montoprestamobs').val();
   var montoprestamo = $('#montoprestamo').val();
   var intcorriente = $('#intcorriente').val();
   var plazoprestamo = $('#plazoprestamo').val();

   tipocambioini = tipocambioini.trim();

   var enlace = base_url + "Reportecalculos/calcularpagos/"+persona+"/"+fecha+"/"+tipomoneda+"/"+tipocambioini+"/"+montoprestamobs+"/"+montoprestamo+"/"+intcorriente+"/"+plazoprestamo;
  window.open(enlace);

}

function mofidicarprestamo(id)
{

  

  var enlace = base_url + "prestamos/datoprestamo";
   $.ajax({ 
      url: enlace,
      type: 'GET',
      data: {idp:id},
      success:function(data)
      { 
         //alert(data);
         $('#accion').val('modificar');
         $('#id_prestamo').val(id);
         var result = JSON.parse(data);
          $.each(result, function(i, datos)
          {
             $('#id_persona').val(datos.id_pers);
            $('#fecha_prestamo').val(datos.fechaprestamo);
            $('#contrato').val(datos.numerocontrato);
            $('#tipocambioini').val(datos.cambioinicial); 
            $('#tipocambioiniaux').val(1);
            $('#montoprestamobs').val(datos.saldocapitalbs);
            
            $('#tipomoneda option[value="'+datos.idtipomoneda+'"]').prop('selected','selected');
            $('#claseprestamo option[value="'+datos.idclaseprestamo+'"]').prop('selected','selected');
            $('#tipogarantia option[value="'+datos.id_tipo_garantia+'"]').prop('selected','selected');

            $('#fecdesembolso').val(datos.fechadesembolso);
            $('#montoprestamo').val(datos.saldocapital);
            $('#intcorriente').val(datos.interescorriente);
            $('#intpenal').val(datos.interespenal);
            $('#plazoprestamo').val(datos.nro_cuotas);
            $('#observacioesprestamo').val(datos.observaciones);

            if(datos.idtipomoneda == 1)
            {
               $('#montoprestamobs').attr('readonly', false);
               $('#montoprestamo').attr('readonly', true);
            }
            else 
            {
              if(datos.idtipomoneda == 2)
              {
                 $('#montoprestamobs').attr('readonly', true);
                $('#montoprestamo').attr('readonly', false);
              }
              else 
              {
                $('#montoprestamobs').attr('readonly', true);
                $('#montoprestamo').attr('readonly', trues);
              }
        }
           
          });
         

      
      }
  });
}


function imprimirrecibo(id)
{
  var enlace = base_url + "recibo/imprimir_recibo/"+id;
    window.open(enlace);
}