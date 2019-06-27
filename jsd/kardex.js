var base_url;
var alertaValidacion = '';
var validarci = false;
var penalizar_auxiliar = 0;

var  pe = 0;
var co = 0;
function baseurl(enlace)
{
  base_url = enlace;
  
}
function activado()
{

	var deposito = '<option VALUE="1">EFECTIVO</OPTION><option VALUE="2">DEPOSITO</OPTION>';
  	$('#deposito').html(deposito);
	$('#penalchek').hide();
	$('#corrichek').hide();
	$("#fecha_calculo").datepicker({
    
	    format: "yyyy-mm-dd",
	    orientation: "top left",
	    language: "es" 
  	});
	var enlace = base_url + "index.php/kardex/tipogarantia";
   	$.ajax({
        type: "GET",
        url: enlace,
        success: function(data)  
         {
            $('#tipo_g').html(data); 
         }
    });

    var enlace = base_url + "index.php/kardex/tipobien";
   	$.ajax({
        type: "GET",
        url: enlace,
        success: function(data)  
         {
            $('#biengar').html(data); 
         }
    });

	$('#cib').keyup(function () 
  	{
	      var ci = $('#cib').val(); 
	      if(ci.length >0 )
	      {
	      	$('#ci').val(ci); 
	      	var enlace = base_url + "index.php/kardex/buscarpersona";
	        $.ajax({
	            type: "GET",
	            url: enlace,
	            data: {cis:ci},
	            success: function(data) 
	            {
	            	$('#listagarantes').html(data);            	
	            }
	        });
	      }
	      else
	      {
	      	$('#listagarantes').html('');
	      }  
	      
    });

	$('#tipo_cambio').keyup(function () 
    {
      var tem = $('#tipo_cambio').val(); 
      var RE = /^\d*\.?\d*$/;
      if (RE.test(tem)) 
      {
          
      }
      else{ $('#tipo_cambio').val('');}
  	});

	$('#comprobante').keyup(function () 
    {
      var tem = $('#comprobante').val(); 
      var RE = /^\d*\.?\d*$/;
      if (RE.test(tem)) 
      {
          
      }
      else{ $('#comprobante').val('');}
  	});

  	

   	$('#monto').keyup(function () 
  	{
      var tem = $('#monto').val(); 
      var RE = /^\d*\.?\d*$/;
      if (RE.test(tem)) 
      {
      		
      		if($('#tipo_cambio').val() != '')
      		{
	      		if(tem>0 )
	      		{
	      			irdescontando(tem);	
	      			var cambio = parseFloat($('#tipo_cambio').val());
		      		var resultado = parseFloat(tem) * cambio;
		      		$('#montobs').val(Math.round(resultado*100)/100);		
	      		}
	      		else
	      		{
	      			 irdescontando(0);	
	      			 $('#monto').val('');
	      			 $('#montobs').val('');
	      		}
      		}
      		else
      		{
      			 alert('Ingresar tipo cambio')
      			 $('#monto').val('');
      		}

      		
 
      }
      else{ $('#monto').val('');}
 	});


 	


 	$('#montobs').keyup(function () 
  	{
      var tem = $('#montobs').val(); 
      var RE = /^\d*\.?\d*$/;
      if (RE.test(tem)) 
      {
 		   
      		if($('#tipo_cambio').val() != '')
      		{
	      		if(tem>0 )
	      		{
	      			irdescontando(tem);	
	      			var cambio = parseFloat($('#tipo_cambio').val());
		      		var resultado = parseFloat(tem) / cambio;
		      		$('#monto').val(Math.round(resultado*100)/100);	
	      		}
	      		else
	      		{
	      			irdescontando(0);	
	      			 $('#montobs').val('');
	      			 $('#monto').val('');
	      		}
	      	}
      		else
      		{
      			 alert('Ingresar tipo cambio')
      			 $('#montobs').val('');
      		}
 		}
      else{ $('#montobs').val('');}
 	});


    $('#fecha_calculo').change(function () 
  	{
	    var f1 = $('#fecha_anterior').val();
	    var f2 = $('#fecha_calculo').val();
	    tipo_moneda(f2);
	    if (f2 >= f1)
	    {
	    	//alert('SI');
	    	restaFechas(f1,f2);
	    	if(penalizar_auxiliar == 1)
	    	{$('#botonesliquidar').show();}	
	   		 else
	    	{$('#botonesliquidar').hide();}	
	    	
	    }
	    else
	    {
	    	alert('LA FECHA SELECCIONA DEBE SER POSTERIOR A: '+ f1);
	    	$('#botonesliquidar').hide();
	    	//restaFechas(f2,f1);
	    }
	    //
		//
	      
 	});

 	 $('#penalizar').change(function () 
  	{
		   if(this.checked)
		   {
		   		//$('#penalizar').val(1);
		   		penalizarpenal();
		   		
		   }
		   else{
		   		despenalizarpenal();
		   		//$('#penalizar').val(0);
		   }
	      
 	});
 	  $('#corriente').change(function () 
  	{
		   if(this.checked)
		   {
		   		//$('#penalizar').val(1);
		   		penalizarcorriente();
		   		
		   }
		   else{
		   		despenalizarcorriente();
		   		//$('#penalizar').val(0);
		   }
	      
 	});
 	  $('#deposito').change(function () 
  	{
		  var dep = $('#deposito').val();
		  if(dep == 2)
		  {
		  	 $('#comprobante').attr("readonly", false);
		  }
		  else
		  {
		  	$('#comprobante').attr("readonly", true);
		  }
	      
 	});
}
function vergarante(idprestamo,idgarante)
{
  	 var enlace = base_url + "index.php/kardex/datosgarantes";
      
        $.ajax({
            type: "GET",
            url: enlace,
            data: {idga:idgarante},
            success: function(data)  
             {
                 $('#idpers').val(idgarante);
                 $('#idpres').val(idprestamo);
                 $('#datosgarate').html(data);
                 $('#vergarantemodal').modal('show');
             }
        });
}

function agregargarantes(idprestamo)
{
  $('#accion').val('nuevo');
  
  $('#id_prestamo').val(idprestamo);
  $('#id_persona').val('');
  $('#personamodal').modal('show');
}
function seleccionargarante(idgarante)
{
  var enlace = base_url + "index.php/kardex/selectgarates";
   $.ajax({ 
      url: enlace,
      type: 'GET',
      data: {garante:idgarante},
      success:function(data)
      { 
        // alert(data);
         $('#accion').val('seleccionado');

         $('#id_persona').val(idgarante);
        
          var result = JSON.parse(data);
          $.each(result, function(i, datos)
          {
            
            $('#ci').val(datos.ci);
            $('#nombres').val(datos.nombres);
            $('#ap_paterno').val(datos.primer_apellido);
            $('#ap_materno').val(datos.segundo_apellido);
            $('#ap_casada').val(datos.apellido_casada);
            $('#sexo option[value="'+datos.sexo+'"]').prop('selected','selected');
            $('#fechanacimientodoc').val(datos.fecha_nacimiento);
			$('#domicilio').val(datos.direccion);
            $('#celular').val(datos.telefono);
            $('#ocupacion').val(datos.ocupacion);
            $('#correo').val(datos.correo);
            $('#ci').attr("readonly", true);
			$('#nombres').attr("readonly", true);
			$('#ap_paterno').attr("readonly", true);
			$('#ap_materno').attr("readonly", true);
			$('#ap_casada').attr("readonly", true);
			$('#sexo').attr("readonly", true);
			$('#fechanacimientodoc').attr("readonly", true);
			$('#domicilio').attr("readonly", true);
			$('#celular').attr("readonly", true);
			$('#ocupacion').attr("readonly", true);
			$('#correo').attr("readonly", true);
          });
      }
  });
}
function cancelarsel()
{
$('#accion').val('nuevo');
$('#id_persona').val('');
$('#ci').attr("readonly", false);
$('#nombres').attr("readonly", false);
$('#ap_paterno').attr("readonly", false);
$('#ap_materno').attr("readonly", false);
$('#ap_casada').attr("readonly", false);
$('#sexo').attr("readonly", false);
$('#fechanacimientodoc').attr("readonly", false);
$('#domicilio').attr("readonly", false);
$('#celular').attr("readonly", false);
$('#ocupacion').attr("readonly", false);
$('#correo').attr("readonly", false);

$('#ci').val('');
$('#nombres').val('');
$('#ap_paterno').val('');
$('#ap_materno').val('');
$('#ap_casada').val('');
var sexo = '<option VALUE="-1">Seleccionar opcion</OPTION><option VALUE="MASCULINO">MASCULINO</OPTION><option VALUE="FEMENINO">FEMENINO</OPTION>';
$('#sexo').html(sexo);
$('#fechanacimientodoc').val(''); 
$('#domicilio').val('');
$('#celular').val('');
$('#ocupacion').val('');
$('#correo').val('');

}



function eliminargarante()
{
	if(confirm('¿Estas seguro de eliminar el Garante??'))
	{
		var per = $('#idpers').val();
	    var pres = $('#idpres').val();
	     var enlace = base_url + "index.php/kardex/eliminargarantes";
		  $.ajax({
		        type: "GET",
		        url: enlace,
		        data: {ga:per,pre:pres},
		        success: function(data)  
		         {
		             //alert(data);
		             $('#idpers').val('');
		             $('#idpres').val('');
		             window.setTimeout('location.reload()', 500);
		         }
		    });
	 }
	else
	{
		return false;
	}	  
}



function guardargarante()
{
	if(confirm('¿Estas seguro de agregar el Garante??'))
	{
		if($('#accion').val()=='nuevo')
		{
			if(validardatos())
    		{ 
				var enlace = base_url + "index.php/personas/guardarpersona";
		     	 var datos = $('#formulariopersona').serialize();
		        $.ajax({
		            type: "GET",
		            url: enlace,
		            data: datos,
		            success: function(data)  
		             {
		                window.setTimeout('location.reload()', 500); 
		             }
		        }); 
		    }
		    else
		    {
		      
		      $('#validarpersona').text("Verificar: "+alertaValidacion);
		      $('#validarpersona').show();

		     // alert("Falta llenar o seleccionar los campos: \n"+alertaValidacion+"\n deberán ser llenados o seleccionados");
		      alertaValidacion="";
		    }
		}
		else
		{ 
		 var per = $('#id_persona').val();
	   	 var pres = $('#id_prestamo').val();
	     var enlace = base_url + "index.php/kardex/guardargarantes";
		  $.ajax({
		        type: "GET",
		        url: enlace,
		        data: {ga:per,pre:pres},
		        success: function(data)  
		         {
		            
		            window.setTimeout('location.reload()', 500);
		         }
		    });
		 }
	 }
	else
	{
		return false;
	}	
}

function validardatos()
{
  var todook = true;
  $(".form-group").removeClass("has-error");
  if($('#ci').val()=='')
  {        
     todook=false;
     $('#ci').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "* Número de C.I.   \n";
  } 
  if(validarci == true) 
  {
      todook=false;
               $('#ci').closest(".form-group").addClass("has-error");
                  alertaValidacion += "* El numero de CI ya se encuentra registrado\n";
  }
  if($('#nombres').val()=='')
  {        
      todook=false;
     $('#nombres').closest(".form-group").addClass("has-error");
      alertaValidacion += "* Nombres   \n";
  }
  if($('#ap_paterno').val()=='')
  {        
      todook=false;
     $('#ap_paterno').closest(".form-group").addClass("has-error");
     alertaValidacion += "* pellido Paterno - \n";
  }
  if($('#ap_materno').val()=='') 
  {        
    todook=false;
     $('#ap_materno').closest(".form-group").addClass("has-error");
     alertaValidacion += "* Apellido Materno - \n";
  }
  if($('#sexo').val()== '-1')
  {        
    todook=false;
     $('#sexo').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "* Sexo - \n";
  }
  if($('#fechanacimientodoc').val()=='')
  {        
     todook=false;
     $('#fechanacimientodoc').closest(".form-group").addClass("has-error");
     alertaValidacion += "* Fecha fechanacimientodoc -  \n";
  }

  if($('#domicilio').val()=='')
  {        
     todook=false;
     $('#domicilio').closest(".form-group").addClass("has-error");
     alertaValidacion += "* Dirección -  \n";
  }
   if($('#celular').val()=='')
  {        
     todook=false;
     $('#celular').closest(".form-group").addClass("has-error");
     alertaValidacion += "* Teléfono -  \n";
  }

   if($('#tipouser').val()== '-1')
  {        
    todook=false;
     $('#tipouser').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "* tipoo de Usuario - \n";
  }

  

  return todook;
} 

function garantiakardex(idprestamo)
{
  
 		 
	     var enlace = base_url + "index.php/kardex/getgarantia";
		  $.ajax({
		        type: "GET",
		        url: enlace,
		        data: {pre:idprestamo},
		        success: function(data)  
		         {
		       		if(data == 1)
		         	{
		         		$('#acciongar').val('nuevo');

		         		$('#id_garantia').val('');
				        $('#id_prestamogar').val(idprestamo);		         		
				        $('#elimgaran').hide();
				        
		         	}
		         	else
		         	{
	         			  $('#acciongar').val('modificar');
		         		  var result = JSON.parse(data);
				          $.each(result, function(i, datos)
				          {
				            $('#id_garantia').val(datos.id_garantia);
				            $('#id_prestamogar').val(datos.id_prest);
				            $('#tipo_g option[value="'+datos.idtipogarantia+'"]').prop('selected','selected');
				            $('#biengar option[value="'+datos.idbien+'"]').prop('selected','selected');
				            $('#descripciongar').val(datos.descripcion);
				            $('#observaciongar').val(datos.observaciones);
				            $('#elimgaran').show();
				          });
		         	}	
		         	
		         	$('#garantiamodal').modal('show');	
		       		
		         }
		    });

}
function eliminargarantia()
{

	if(confirm('¿Estas seguro de eliminar la Garantia??'))
	{
		var gar = $('#id_garantia').val();
	     var enlace = base_url + "index.php/kardex/eliminargarantia";
		  $.ajax({
		        type: "GET",
		        url: enlace,
		        data: {ga:gar},
		        success: function(data)  
		         {
		             //alert(data);
		             	$('#acciongar').val('nuevo');

		         		$('#id_garantia').val('');
				        $('#id_prestamogar').val('');		         		
				        $('#elimgaran').hide();
		             window.setTimeout('location.reload()', 500);
		         }
		    });
	 }
	else
	{
		return false;
	}	  
}

function guardargarantia()
{
	if(confirm('¿Estas seguro de registrar la Garantia??'))
	{
		
		var enlace = base_url + "index.php/kardex/guardargarantia";
	    var datos = $('#formulariogarantia').serialize();
	        $.ajax({
	            type: "GET",
	            url: enlace,
	            data: datos,
	            success: function(data)  
	             {
	                //alert(data);
	                window.setTimeout('location.reload()', 500); 
	             }
	        });
		
		
	 }
	else
	{
		return false;
	}	
}


function controlpagoskardex(idprestamo)
{
 	
	$('#botonesamort').hide();
	$('#botonespagos').show();	
	$('#controlpagos').show();
	$('#botonesliquidar').hide();
	$('#controlamortizacion').hide();
	

 	var enlace = base_url + "index.php/kardex/controlpagosk";
    $.ajax({
        type: "GET",
        url: enlace,
        data: {idpres:idprestamo},
        success: function(data)  
         {
         	//alert(data);
         	$("#titulo1").text('CONTROL DE PAGOS');
         	 $('#idpresk').val(idprestamo);
             $('#controlpagos').html(data);
             $('#controlpagosmodal').modal('show');
         }
    });
}

function amortizarpago(prestamo,pagos = 0)
{
	$('#controlpagos').hide();
	$('#controlamortizacion').show();
	$('#botonesliquidar').hide();
	$('#botonesamort').show();
	$('#liquidark').show();
	$('#botonespagos').hide();

	penalizar_auxiliar = 0;

	
	var enlace = base_url + "index.php/kardex/amortizacion";
    $.ajax({
        type: "GET",
        url: enlace,
        data: {idpres:prestamo},
        success: function(data)  
         {
         	//alert(data);
     		 $("#titulo1").text('AMORTIZACION');
     		 $('#accionamort').val('nuevo');     		 
             $('#id_prestamoamort').val(prestamo);

              var result = JSON.parse(data);
	          $.each(result, function(i, datos)
	          {
		        if(datos.pagoconfirmado == 1 || datos.pagoconfirmado == 3)
		        {
		            $('#fecha_anterior').val(datos.fechacalculo);
		            $('#moneda').val(datos.tipo_moneda);
		            $('#intcorriente').val(datos.interes_corriente);
		            $('#intpenal').val(datos.interes_penal);
		            $('#plazo').val(datos.plazo);
		            $('#plazopago').val(datos.plazoprestamoamor);
		            $('#nro_cuotaanterior').val(datos.ncuota);
		            if(datos.tipo_moneda==1)
		            {
		            	 $('#montobs').attr("readonly", false);
		            	 $('#monto').attr("readonly", true);
		            }
		            else
		            {
		            	$('#montobs').attr("readonly", true);
		            	 $('#monto').attr("readonly", false);
		            }
		           	if (datos.tipo_moneda == 1)
		           	{
		           		$('#capital_anterior').val(datos.saldocapitalbs);
			            $('#corriete_anterior').val(datos.intcorrientesaldobs);
			            $('#penal_anterior').val(datos.intpenalsaldobs);

			            $('#cargo_interes_corriente_anteriortxt').val(datos.intcorrientesaldobs);
			            $('#cargo_interes_penal_anteriortxt').val(datos.intpenalsaldobs);


			            $('#deuda_anterior').val(datos.totaldeudabs);
			            $('#deuda_anterior2').val(Math.round(datos.totaldeudabs*100)/100);
			            $('#cuota_anterior').val(datos.cuotatotalbs);		            
			            $('#cargo_cuota_mestxt').val(Math.round(datos.saldocapitalbs*100)/100);		            
			           
			         //   $('#saldo_cuota_mestxt').val(datos.saldocapitalbs);
			           
			            $('#cargo_interes_corrientetxt').val(0.00);	
			            $('#cargo_interes_penaltxt').val(0);		
		           	}	
		           	else
		           	{
		           		$('#capital_anterior').val(datos.saldocapital);
			            $('#corriete_anterior').val(datos.intcorrientesaldo);
			            $('#penal_anterior').val(datos.intpenalsaldo);


			                 $('#cargo_interes_corriente_anteriortxt').val(datos.intcorrientesaldo);
			            $('#cargo_interes_penal_anteriortxt').val(datos.intpenalsaldo);


			            $('#deuda_anterior').val(datos.totaldeuda);
			            $('#deuda_anterior2').val(Math.round(datos.totaldeuda*100)/100);
			            $('#cuota_anterior').val(datos.cuotatotal);		
			            $('#cargo_cuota_mestxt').val(datos.saldocapital);
			           
			          //  $('#saldo_cuota_mestxt').val(datos.saldocapital);

			            $('#cargo_interes_corrientetxt').val(0.00);	
			            $('#cargo_interes_penaltxt').val(0);	
		           	}
		           	 calculartotal();
		        	 abonosinteres();
		        	 saldosinteres();
		        	  if(pagos == 0){ 
			           $('#controlpagosmodal').modal('show');
		              } 
		        }
		        else
		        {
		        	alert('FAVOR CONFIRMAR EL ÚLTIMO PAGO');
		        }
	         });
              
         }
    });
   
}


function editaramortizarpago(amortizacion,prestamo,cuotap)
{
	$('#controlpagos').hide();
	$('#controlamortizacion').show();
	$('#botonesliquidar').hide();
	$('#botonesamort').show();
	$('#liquidark').show();
	$('#botonespagos').hide();

	penalizar_auxiliar = 0;
	var cuota = cuotap;
	cuotap = cuotap -1;
 
	var enlace = base_url + "index.php/kardex/getamortizaciones";
    $.ajax({
        type: "GET",
        url: enlace,
        data: {idpres:prestamo,cuota:cuotap},
        success: function(data)  
         {
         	//alert(data);
     		 $("#titulo1").text('EDITAR AMORTIZACION');
     		 $('#accionamort').val('modificar');     		 
             $('#id_prestamoamort').val(prestamo);
             $('#amortizacionid').val(amortizacion);

              var result = JSON.parse(data);
	          $.each(result, function(i, datos)
	          {
		        
		            $('#fecha_anterior').val(datos.fechacalculo);
		            $('#moneda').val(datos.tipo_moneda);
		            $('#intcorriente').val(datos.interes_corriente);
		            $('#intpenal').val(datos.interes_penal);
		            $('#plazo').val(datos.plazo);
		            $('#nro_cuotaanterior').val(datos.ncuota);
		            if(datos.tipo_moneda==1)
		            {
		            	 $('#montobs').attr("readonly", false);
		            	 $('#monto').attr("readonly", true);
		            }
		            else
		            {
		            	$('#montobs').attr("readonly", true);
		            	 $('#monto').attr("readonly", false);
		            }
		           	if (datos.tipo_moneda == 1)
		           	{
		           		$('#capital_anterior').val(datos.saldocapitalbs);
			            $('#corriete_anterior').val(datos.intcorrientesaldobs);
			            $('#penal_anterior').val(datos.intpenalsaldobs);

			            $('#cargo_interes_corriente_anteriortxt').val(datos.intcorrientesaldobs);
			            $('#cargo_interes_penal_anteriortxt').val(datos.intpenalsaldobs);


			            $('#deuda_anterior').val(datos.totaldeudabs);
			            $('#deuda_anterior2').val(Math.round(datos.totaldeudabs*100)/100);
			            $('#cuota_anterior').val(datos.cuotatotalbs);		            
			            $('#cargo_cuota_mestxt').val(Math.round(datos.saldocapitalbs*100)/100);		            
			           
			         //   $('#saldo_cuota_mestxt').val(datos.saldocapitalbs);
			           
			            $('#cargo_interes_corrientetxt').val(0.00);	
			            $('#cargo_interes_penaltxt').val(0);		
		           	}	
		           	else
		           	{
		           		$('#capital_anterior').val(datos.saldocapital);
			            $('#corriete_anterior').val(datos.intcorrientesaldo);
			            $('#penal_anterior').val(datos.intpenalsaldo);


			                 $('#cargo_interes_corriente_anteriortxt').val(datos.intcorrientesaldo);
			            $('#cargo_interes_penal_anteriortxt').val(datos.intpenalsaldo);


			            $('#deuda_anterior').val(datos.totaldeuda);
			            $('#deuda_anterior2').val(Math.round(datos.totaldeuda*100)/100);
			            $('#cuota_anterior').val(datos.cuotatotal);		
			            $('#cargo_cuota_mestxt').val(datos.saldocapital);
			           
			          //  $('#saldo_cuota_mestxt').val(datos.saldocapital);

			            $('#cargo_interes_corrientetxt').val(0.00);	
			            $('#cargo_interes_penaltxt').val(0);	
		           	}

		           	// calculartotal();
		        	// abonosinteres();
		        	// saldosinteres();
		        	recuperardatoseditar(prestamo,cuota);
		        	 
			           $('#controlpagosmodal').modal('show');
		              
		       
	         });
              
         }
    });
   
}

function recuperardatoseditar(prestamo,cuotap)
{
	var enlace = base_url + "index.php/kardex/getamortizaciones";
    $.ajax({
        type: "GET",
        url: enlace,
        data: {idpres:prestamo,cuota:cuotap},
        success: function(data)  
         {
         	
              var result = JSON.parse(data);
	          $.each(result, function(i, datos)
	          {
		        	$('#fecha_calculo').val(datos.fechacalculo);
		        	$('#descripcionnamortizacion').val(datos.descripcion);
		        	$('#montobs').val(datos.cuotatotalbs);
		        	$('#monto').val(datos.cuotatotal);
		        	$('#comprobante').val(datos.comprobante);
		        	$('#plazopago').val(datos.plazoprestamoamor);

		   			$('#deposito option[value="'+datos.deposito+'"]').prop('selected','selected');

		   			  if(datos.deposito == 2)
					  {
					  	 $('#comprobante').attr("readonly", false);
					  }
					  else
					  {
					  	$('#comprobante').attr("readonly", true);
					  }

					  if(datos.penalizado == 't') {

					  	$("#penalizar").prop("checked", true);
					  	
					  }
					  else
					  	{
					  		$('#penalizar').prop('checked','');
					  	}
					  if(datos.penalizarcorriente == 't') {

					  	$("#corriente").prop("checked", true);
					  	
					  }
					  else
					  	{
					  		$('#corriente').prop('checked','');
					  	}	
					  
		            var f1 = $('#fecha_anterior').val();
				    var f2 = datos.fechacalculo;
				    tipo_moneda(f2);
				    restaFechas(f1,f2,datos.penalizado,datos.penalizarcorriente);
		           	 
		           	 calculartotal();
		        	 abonosinteres();
		        	 saldosinteres();

		        	 
			        
		              
		       
	         });
              
         }
    });
   
}







function calculartotal()
{
	var intpenal = parseFloat($('#cargo_interes_penal_anteriortxt').val()) + parseFloat($('#cargo_interes_penaltxt').val());
	var intcor =  parseFloat($('#cargo_interes_corriente_anteriortxt').val()) + parseFloat($('#cargo_interes_corrientetxt').val());
	var cuota =   parseFloat($('#cargo_cuota_mestxt').val());
 	var total = intpenal + intcor + cuota;
	 $('#cargo_total_cuotatxt').val(Math.round(total*100)/100);		            
 	
}
function abonosinteres()
{
	$('#abono_interes_penaltxt').val(0.00);
	$('#abono_interes_corrientetxt').val(0.00);
	$('#abono_cuota_mestxt').val(0.00);
	$('#abono_total_cuotatxt').val(0.00);
}

function saldosinteres()
{

	var cip = parseFloat($('#cargo_interes_penal_anteriortxt').val()) + parseFloat($('#cargo_interes_penaltxt').val());
	var cic= parseFloat($('#cargo_interes_corriente_anteriortxt').val()) + parseFloat($('#cargo_interes_corrientetxt').val());
	
	var ccm= parseFloat($('#cargo_cuota_mestxt').val());
	var aip= parseFloat($('#abono_interes_penaltxt').val());
	var aic= parseFloat($('#abono_interes_corrientetxt').val());
	var acm= parseFloat($('#abono_cuota_mestxt').val());
	var tcp=parseFloat($('#capital_anterior').val());
	var tip = cip - aip;
	var tic = cic - aic;
	var tcm = tcp - acm;
	$('#saldo_interes_penaltxt').val(Math.round(tip*100)/100);		       
	$('#saldo_interes_corrientetxt').val(Math.round(tic*100)/100);		       
	$('#saldo_cuota_mestxt').val(Math.round(tcm*100)/100);		       
	var total = tip + tic + tcm;
	$('#saldo_total_cuotatxt').val(Math.round(total*100)/100);		       
}


function calculoscuotas(pagos)
{
	var enlace = base_url + "index.php/kardex/amortizacionpagos";


    $.ajax({
        type: "GET",
        url: enlace,
        data: {pag:pagos},
        success: function(data)  
         {
         	  var result = JSON.parse(data);
	          $.each(result, function(i, datos)
	          {
	            $('#fecha_calculo').val(datos.fecha_pago);
	            tipo_moneda(datos.fecha_pago);
		    	var f1 = $('#fecha_anterior').val();
	           	var f2 = datos.fecha_pago;
	           	restaFechas(f1,f2);

	          });
                          
         }
    });
}

 function restaFechas(f1, f2,penal = 'f', corriente = 'f') 
 {
       var enlace = base_url + "index.php/prestamos/calculodiasinteres";
        $.ajax({
            type: "GET",
            url: enlace,
             data: {fec:f1,fec2:f2},
            success: function(data) 
            {
            	//alert(data);
            	if(data > 30)
            	{
            		$('#penalchek').show();
            		$('#corrichek').show();

            		if(penalizar_auxiliar == 1)
	            	{
	            		nopenalizar();
	            	}
	            	else{

	            		if(penal == 't')
			            	{
			            		
			            		penalizarpenal();
			            	}
			            	else{
			            		despenalizarpenal()	;
			            	}	
			            if(corriente == 't')
			            	{
			            		
			            		penalizarcorriente();
			            	}
			            	else{
			            		despenalizarcorriente();
			            	}	
	            		
	            	}	
            	}	
            	else
            	{
            		$('#penalchek').hide();
            		$('#corrichek').hide();
            		$("#penalizar").prop("checked", false);
            		$("#corriente").prop("checked", false);
            		nopenalizar();

            	}	
            		
            	

            	$('#dias_interes').val(data);

            	
            	
            	
            }
        });

    //return 10;    
}


function penalizarpenal()
{
	
pe = 1;


	var f2 = $('#fecha_calculo').val();

	var f3 = $('#plazopago').val();


	if (penalizar_auxiliar == 1)
	{
		if (f2 >= f3)
	    {
	    	var f1 = $('#plazopago').val();
	    }
	    else
	    {
	    	var f1 = $('#fecha_calculo').val();
	    }
	}
	else
	{
		var f1 = $('#fecha_anterior').val();
	}
	//alert(f1+'--'+f2);

	var tipo_moneda = $('#moneda').val();
	var enlace = base_url + "index.php/prestamos/calculodiasinteres";
        $.ajax({
            type: "GET",
            url: enlace,
             data: {fec:f1,fec2:f2},
            success: function(data) 
            {
            	//alert(data);
            	
            		var intpenalant = parseFloat($('#penal_anterior').val());
            		var saldocap = parseFloat($('#capital_anterior').val());
            		var penal = parseFloat($('#intpenal').val());
            		if (penalizar_auxiliar == 1)
					{	
            			var interes = ((saldocap * ((penal*12)/100) *(data))/360);
            		}
            		else
            		{
            			var interes = ((saldocap * ((penal*12)/100) *(data-30))/360);	
            		}		
            		$('#cargo_interes_penaltxt').val(Math.round(interes*100)/100);	
            		//$('#cargo_interes_penaltxt').val(interes);
		            calculartotal();
			        abonosinteres();
			        saldosinteres(); 

			        if(tipo_moneda==1)
		            {
		            	 var monto = parseFloat($('#montobs').val());
		            	 
		            }
		            else
		            {
		            	var monto = parseFloat($('#monto').val());

		            }	

		            if(monto>0 )
		      		{
		      			
		      			irdescontando(monto);			      			
		      		}
		      		else
		      		{
		      			
		      			irdescontando(0);			      			
		      		}
				
            		

            	
            	
            }
        });
}
function despenalizarpenal()
{
	pe = 0;
	var tipo_moneda = $('#moneda').val();
	$('#cargo_interes_penaltxt').val(0);	
            		//$('#cargo_interes_penaltxt').val(interes);
    calculartotal();
    abonosinteres();
    saldosinteres(); 

    if(tipo_moneda==1)
    {
    	 var monto = parseFloat($('#montobs').val());
    	 
    }
    else
    {
    	var monto = parseFloat($('#monto').val());

    }	

    if(monto>0 )
		{
			
			irdescontando(monto);			      			
		}
		else
		{
			
			irdescontando(0);			      			
		}
}
function penalizarcorriente()
{
	 co = 1;
	var f1 = $('#fecha_anterior').val();
	var f2 = $('#fecha_calculo').val();
	var tipo_moneda = $('#moneda').val();
	


	 var enlace = base_url + "index.php/prestamos/calculodiasinteres";
        $.ajax({
            type: "GET",
            url: enlace,
             data: {fec:f1,fec2:f2},
            success: function(data) 
            {
            	
            		var intcorriant = parseFloat($('#corriete_anterior').val());
            		var saldocapitalbs = parseFloat($('#capital_anterior').val());
	            	var interes_corriente = parseFloat($('#intcorriente').val());
            		var cargocorriente = ((saldocapitalbs*((interes_corriente*12)/100)*data )/360);
		            $('#cargo_interes_corrientetxt').val(Math.round(cargocorriente*100)/100);		            
		            //$('#cargo_interes_corrientetxt').val(cargocorriente);	

		            calculartotal();
			        abonosinteres();
			        saldosinteres(); 

			        if(tipo_moneda==1)
		            {
		            	 var monto = parseFloat($('#montobs').val());
		            	 
		            }
		            else
		            {
		            	var monto = parseFloat($('#monto').val());

		            }	

		            if(monto>0 )
		      		{
		      			
		      			irdescontando(monto);			      			
		      		}
		      		else
		      		{
		      			
		      			irdescontando(0);			      			
		      		}
				
            		

            	
            	
            }
        });
}
function despenalizarcorriente()
{
 co = 0;
	var tipo_moneda = $('#moneda').val();
	var intcorriant = parseFloat($('#corriete_anterior').val());
            		var saldocapitalbs = parseFloat($('#capital_anterior').val());
	            	var interes_corriente = parseFloat($('#intcorriente').val());
            		var cargocorriente = ((saldocapitalbs*((interes_corriente*12)/100)*30 )/360);
		            $('#cargo_interes_corrientetxt').val(Math.round(cargocorriente*100)/100);		            
		            //$('#cargo_interes_corrientetxt').val(cargocorriente);	

		            calculartotal();
			        abonosinteres();
			        saldosinteres(); 

			        if(tipo_moneda==1)
		            {
		            	 var monto = parseFloat($('#montobs').val());
		            	 
		            }
		            else
		            {
		            	var monto = parseFloat($('#monto').val());

		            }	

		            if(monto>0 )
		      		{
		      			
		      			irdescontando(monto);			      			
		      		}
		      		else
		      		{
		      			
		      			irdescontando(0);			      			
		      		}
				
}
function penalizar()
{
	var f1 = $('#fecha_anterior').val();
	var f2 = $('#fecha_calculo').val();
	var tipo_moneda = $('#moneda').val();
	


	 var enlace = base_url + "index.php/prestamos/calculodiasinteres";
        $.ajax({
            type: "GET",
            url: enlace,
             data: {fec:f1,fec2:f2},
            success: function(data) 
            {
            	//alert(data);
            	
            	
            		var intcorriant = parseFloat($('#corriete_anterior').val());
            		var saldocapitalbs = parseFloat($('#capital_anterior').val());
	            	var interes_corriente = parseFloat($('#intcorriente').val());
            		var cargocorriente = ((saldocapitalbs*((interes_corriente*12)/100)*data )/360);
		            $('#cargo_interes_corrientetxt').val(Math.round(cargocorriente*100)/100);		            
		            //$('#cargo_interes_corrientetxt').val(cargocorriente);	

		            calculartotal();
			        abonosinteres();
			        saldosinteres(); 

			        if(tipo_moneda==1)
		            {
		            	 var monto = parseFloat($('#montobs').val());
		            	 
		            }
		            else
		            {
		            	var monto = parseFloat($('#monto').val());

		            }	

		            if(monto>0 )
		      		{
		      			
		      			irdescontando(monto);			      			
		      		}
		      		else
		      		{
		      			
		      			irdescontando(0);			      			
		      		}
				
            		

            	
            	
            }
        });
}


function nopenalizar()
{
co = 0;
pe = 0;

	var f1 = $('#fecha_anterior').val();
	var f2 = $('#fecha_calculo').val();
	var tipo_moneda = $('#moneda').val();
	var limite = parseFloat($('#cargo_total_cuota').val());


	 var enlace = base_url + "index.php/prestamos/calculodiasinteres";
        $.ajax({
            type: "GET",
            url: enlace,
             data: {fec:f1,fec2:f2},
            success: function(data) 
            {
            	//alert(data);
            	
            	  $('#cargo_interes_penal').val(0);		            
    			$('#cargo_interes_penaltxt').val(0);

            		
            		var interes = 0.00;
            		$('#cargo_interes_penaltxt').val(Math.round(interes*100)/100);	
            	
            		var intcorriant = parseFloat($('#corriete_anterior').val());
            		var saldocapitalbs = parseFloat($('#capital_anterior').val());
	            	var interes_corriente = parseFloat($('#intcorriente').val());

	            	if(data < 31)
	            	{
	            		var cargocorriente = ((saldocapitalbs*((interes_corriente*12)/100)*data )/360);	
	            	}	
	            	else{
	            		var cargocorriente = ((saldocapitalbs*((interes_corriente*12)/100)*30 )/360);
	            	}
            	    $('#cargo_interes_corrientetxt').val(Math.round(cargocorriente*100)/100);		            
		            calculartotal();
			        abonosinteres();
			        saldosinteres(); 

			        if(tipo_moneda==1)
		            {
		            	 var monto = parseFloat($('#montobs').val());
		            	 
		            }
		            else
		            {
		            	var monto = parseFloat($('#monto').val());

		            }	

		            if(monto>0)
		      		{
		      			
		      			irdescontando(monto);			      			
		      		}
		      		else
		      		{
		      			
		      			irdescontando(0);			      			
		      		}
				
            		

            	
            	
            }
        });



}
function tipo_moneda(fecha)
{
	var enlace = base_url + "index.php/prestamos/tipocambiomoneda";
        $.ajax({
            type: "GET",
            url: enlace,
             data: {fec:fecha},
            success: function(data) 
            {
            	if(data == 1){
            		//$('#tipo_cambio').val('');
            		$('#tipo_cambio').attr('readonly', false);
                	$('#tipocambioiniaux').val(2);
            		
            	}else {
            		$('#tipo_cambio').val(data);
            		$('#tipo_cambio').attr('readonly', true);
                	$('#tipocambioiniaux').val(1);
            		
            	}
            	
            }
        });
}

function irdescontando(monto)
{
	
	if(monto == 0)
	{
		abonosinteres();	
	}
	else
	{
		var total = monto;

		
	 
		var cip = parseFloat($('#cargo_interes_penal_anteriortxt').val()) + parseFloat($('#cargo_interes_penaltxt').val());
		var cic= parseFloat($('#cargo_interes_corriente_anteriortxt').val()) + parseFloat($('#cargo_interes_corrientetxt').val());
		var ccm= parseFloat($('#deuda_anterior').val());	


		if(monto>=cip)
		{
			$('#abono_interes_penaltxt').val(Math.round(cip*100)/100);	
			//$('#abono_interes_penaltxt').val(cip);
			monto = monto - cip;				
		}	
		else
		{
			$('#abono_interes_penaltxt').val(Math.round(monto*100)/100);	
			//$('#abono_interes_penaltxt').val(monto);
			monto = 0;				
		}
		if(monto>=cic)
		{
			$('#abono_interes_corrientetxt').val(Math.round(cic*100)/100);	
			//$('#abono_interes_corrientetxt').val(cic);
			monto = monto - cic;				
		}	
		else
		{
			$('#abono_interes_corrientetxt').val(Math.round(monto*100)/100);	
			//$('#abono_interes_corrientetxt').val(monto);
			monto = 0;				
		}



		if(monto>=ccm)
		{
			$('#abono_cuota_mestxt').val(Math.round(ccm*100)/100);	
			//$('#abono_cuota_mestxt').val(ccm);
			monto = monto - ccm;				
		}	
		else
		{
			$('#abono_cuota_mestxt').val(Math.round(monto*100)/100);	
			//$('#abono_cuota_mestxt').val(monto);
			monto = 0;				
		}
		$('#abono_total_cuotatxt').val(Math.round(total*100)/100);	
	}	
	saldosinteres();
}	

function guardaramortizacion()
{
	if(validardatosprestamo())
	{ 
		var prestamo = $('#id_prestamoamort').val();
		var enlace = base_url + "index.php/kardex/guardaramortizacion";
        var datos = $('#formularioamortizacion').serialize();
        $.ajax({
            type: "GET",
            url: enlace,
            data: datos,
            success: function(data)  
             {
             	alert('AMORTIZACION GUARDADA CORRECTAMENTE');

             	//amortizarpago(prestamo,1)
                window.setTimeout('location.reload()', 500); 
             }
        });	   
    }
    else
    {
      
      $('#validarprestamo').text("Verificar: "+alertaValidacion);
      $('#validarprestamo').show();

     // alert("Falta llenar o seleccionar los campos: \n"+alertaValidacion+"\n deberán ser llenados o seleccionados");
      alertaValidacion="";
    }
}

function validardatosprestamo()
{
	 var todook = true;
  $(".form-group").removeClass("has-error");
  if($('#fecha_calculo').val()=='')
  {        
     todook=false;
     $('#fecha_calculo').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "* Fecha de calculo   \n";
  } 
  
  if($('#tipo_cambio').val()=='')
  {        
     todook=false;
     $('#tipo_cambio').closest(".form-group").addClass("has-error");
     alertaValidacion += "* Tipo de Cambio -  \n";
  }
   if($('#descripcionnamortizacion').val()=='')
  {        
     todook=false;
     $('#descripcionnamortizacion').closest(".form-group").addClass("has-error");
     alertaValidacion += "* Descripción -  \n";
  }
   if($('#montobs').val()=='')
  {        
     todook=false;
     $('#montobs').closest(".form-group").addClass("has-error");
     alertaValidacion += "* MONTO BS -  \n";
  }
 if($('#monto').val()=='')
  {        
     todook=false;
     $('#monto').closest(".form-group").addClass("has-error");
     alertaValidacion += "* MONTO $ -  \n";
  }

   if($('#deposito').val() == 2)
	 {
		  if($('#comprobante').val()=='')
		  {        
		     todook=false;
		     $('#comprobante').closest(".form-group").addClass("has-error");
		     alertaValidacion += "* NUMERO DE COMPOBANTE $ -  \n";
		  }
	 }
	

  

  return todook;

}

function imprimirkardex(idprestamo)
{
	var enlace = base_url + "index.php/reportekardex/kardexprestamo/"+idprestamo;
 	window.open(enlace);
}







function liquidar(prestamo,pagos = 0)
{
	$('#controlpagos').hide();
	$('#controlamortizacion').show();
	//$('#botonesliquidar').show();
	$('#botonesamort').hide();
	$('#liquidark').hide();
	$('#botonespagos').hide();
	$('#botonesliquidar').hide();
	penalizar_auxiliar = 1;

	
	var enlace = base_url + "index.php/kardex/amortizacion";
    $.ajax({
        type: "GET",
        url: enlace,
        data: {idpres:prestamo},
        success: function(data)  
         {
         	//alert(data);
     		 $("#titulo1").text('CÁLCULO DE LIQUIDACIÓN');
     		 $('#accionamort').val('nuevo');     		 
             $('#id_prestamoamort').val(prestamo);

              var result = JSON.parse(data);
	          $.each(result, function(i, datos)
	          {
		        if(1 == 1)
		        {
		            $('#fecha_anterior').val(datos.fechacalculo);
		            $('#fecha_anterior').val(datos.fechacalculo);
		            $('#plazopago').val(datos.plazoprestamoamor);

		            

		            $('#moneda').val(datos.tipo_moneda);
		            $('#intcorriente').val(datos.interes_corriente);
		            $('#intpenal').val(datos.interes_penal);
		            $('#plazo').val(datos.plazo);
		            $('#nro_cuotaanterior').val(datos.ncuota);
		            if(datos.tipo_moneda==1)
		            {
		            	 $('#montobs').attr("readonly", false);
		            	 $('#monto').attr("readonly", true);
		            }
		            else
		            {
		            	$('#montobs').attr("readonly", true);
		            	 $('#monto').attr("readonly", false);
		            }
		           	if (datos.tipo_moneda == 1)
		           	{
		           		$('#capital_anterior').val(datos.saldocapitalbs);
			            $('#corriete_anterior').val(datos.intcorrientesaldobs);
			            $('#penal_anterior').val(datos.intpenalsaldobs);

			            $('#cargo_interes_corriente_anteriortxt').val(datos.intcorrientesaldobs);
			            $('#cargo_interes_penal_anteriortxt').val(datos.intpenalsaldobs);


			            $('#deuda_anterior').val(datos.totaldeudabs);
			            $('#deuda_anterior2').val(Math.round(datos.totaldeudabs*100)/100);
			            $('#cuota_anterior').val(datos.cuotatotalbs);		            
			            $('#cargo_cuota_mestxt').val(Math.round(datos.saldocapitalbs*100)/100);		            
			           
			         //   $('#saldo_cuota_mestxt').val(datos.saldocapitalbs);
			           
			            $('#cargo_interes_corrientetxt').val(0.00);	
			            $('#cargo_interes_penaltxt').val(0);		
		           	}	
		           	else
		           	{
		           		$('#capital_anterior').val(datos.saldocapital);
			            $('#corriete_anterior').val(datos.intcorrientesaldo);
			            $('#penal_anterior').val(datos.intpenalsaldo);


			                 $('#cargo_interes_corriente_anteriortxt').val(datos.intcorrientesaldo);
			            $('#cargo_interes_penal_anteriortxt').val(datos.intpenalsaldo);


			            $('#deuda_anterior').val(datos.totaldeuda);
			            $('#deuda_anterior2').val(Math.round(datos.totaldeuda*100)/100);
			            $('#cuota_anterior').val(datos.cuotatotal);		
			            $('#cargo_cuota_mestxt').val(datos.saldocapital);
			           
			          //  $('#saldo_cuota_mestxt').val(datos.saldocapital);

			            $('#cargo_interes_corrientetxt').val(0.00);	
			            $('#cargo_interes_penaltxt').val(0);	
		           	}
		           	 calculartotal();
		        	 abonosinteres();
		        	 saldosinteres();
		        	  if(pagos == 0){ 
			           $('#controlpagosmodal').modal('show');
		              } 
		        }
		        else
		        {
		        	alert('IMPRIMIR EL ÚLTIMO RECIBO PENDIENTE POR FAVOR');
		        }
	         });
              
         }
    });
   
}

function liquidarprestamo()
{
	var idprestamo =  $('#id_prestamoamort').val();
	var tipo_cambio =  $('#tipo_cambio').val();
	var fecha =  $('#fecha_calculo').val();
	var tipocambioiniaux =  $('#tipocambioiniaux').val();
	

	if(validardatosliquidacion())
	{ 
		tipo_cambio = tipo_cambio.trim();
		var enlace = base_url + "reportekliquidar/liquidarprestamo/"+idprestamo+"/"+tipo_cambio+"/"+fecha+"/"+tipocambioiniaux+"/"+pe+"/"+co;
 		window.open(enlace);
 	}
    else
    {
      
      $('#validarprestamo').text("Verificar: "+alertaValidacion);
      $('#validarprestamo').show();
      alertaValidacion="";
    }   

}
function validardatosliquidacion()
{
	 var todook = true;
  $(".form-group").removeClass("has-error");
  if($('#fecha_calculo').val()=='')
  {        
     todook=false;
     $('#fecha_calculo').closest(".form-group").addClass("has-error"); 
     alertaValidacion += "* Fecha de calculo   \n";
  } 
  
  if($('#tipo_cambio').val()=='')
  {        
     todook=false;
     $('#tipo_cambio').closest(".form-group").addClass("has-error");
     alertaValidacion += "* Tipo de Cambio -  \n";
  }
 
  return todook;

} 
function crear_recibo(amortizacion,prestamo,pago,per)
{
	if(confirm('-Posteriormentes ya no se podra realizar ningun cambio a la amortización \n - ¿Estas seguro de crear el recibo de pago??'))
    {	var aux = 0;
		var enlace = base_url + "kardex/nuevo_recibo";
	   	$.ajax({
	        type: "GET",
	        url: enlace,
	         data: {am:amortizacion,pre:prestamo,pa:pago,persona:per},
	        success: function(data)  
	         {
	            aux = data.trim();
	            var enlace = base_url +  "index.php/recibo/imprimir_recibo/" + aux;
				window.open(enlace);

	         }
	    });
        
 		 window.setTimeout('location.reload()', 500); 

	}
	else
	{
		return false;
	}
}
function confirmarpago(amortizacion)
{
		if(confirm('-Realizo el pago correspondiente? \n - ¿Estas seguro de confirmar el pago??'))
    {	var aux = 0;
		var enlace = base_url + "kardex/confirmarpago";
	   	$.ajax({
	        type: "GET",
	        url: enlace,
	         data: {am:amortizacion},
	        success: function(data)  
	         {
	            //alert(data);
	            window.setTimeout('location.reload()', 500); 

	         }
	    });
        
 		

	}
	else
	{
		return false;
	}
}



function imprimircalculos(prestamo)
{

   var enlace = base_url + "Reportecalculos/imprimircalculospagos/"+prestamo;
  window.open(enlace);

}