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
      $('#validaringreso').text("Verificar: "+alertaValidacion);
      $('#validaringreso').show();
     // alert("Falta llenar o seleccionar los campos: \n"+alertaValidacion+"\n deberán ser llenados o seleccionados");
      alertaValidacion="";
    }
}
function validardatosingreso()
{
  var todook = true;  
   if($('#fecha').val()== '')
  {
    todook=false;
    alertaValidacion += " -Se debe completar el fecha";
  }
  if($('#tipocambio').val()== '')
  {
    todook=false;
    alertaValidacion += " -Se debe completar el tipo de cambio";
  }
  if($('#monto').val()== '')
  {
    todook=false;
    alertaValidacion += " -Se debe completar el Monto";
  }
  if($('#docrespaldo').val()== '')
  {
    todook=false;
    alertaValidacion += " -Se debe completar el Documento de Respaldo";
  }
  if($('#beneficiario').val()== '')
  {
    todook=false;
    alertaValidacion += " -Se debe completar el Beneficiario";
  }
  if($('#descripcioningreso').val()== '')
  {
    todook=false;
    alertaValidacion += " -Se debe completar la  descripcion de egreso";
  }
  
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
function guardaringresohaber()
{  
   if(validardatos())
    { 
      var enlace = base_url + "Registrar_ingresos/guardaringresohaber";
      var datos = $('#formulariocuentaegreso').serialize();
        $.ajax({
            type: "GET",
            url: enlace,
            data: datos,
            success: function(data)  
            {
               alert('SE GUARDO LA INFORMACION CORRECTAMENTE');
               window.setTimeout('location.reload()', 500);
            }
        });
        //alert('bien');
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
  if($('#cuentae').val()== -1)
  {
    todook=false;
    alertaValidacion += " -Debe seleccionar una cuenta";
  }
  if($('#sub_cuentae').val()== -1 || $('#sub_cuentae').val() == '')
  {
    todook=false;
    alertaValidacion += " -Debe seleccionar una subcuenta";
  }
  if($('#monto_egreso').val()== '')
  {
    todook=false;
    alertaValidacion += " -Se debe completar el Monto Ingreso";
  }
  if(monto < (saldo+egreso))
  {
    todook=false;
    alertaValidacion += " -El monto es mayor, valor máximo permitido: "+ (monto - saldo);
  }  
  return todook;
} 
function imprimir_ingreso(id)
{
    if(confirm('-Posteriormentes ya no se podra realizar ningún cambio a la transacción realizada \n - ¿Estas seguro de generar el comprobante ?'))
    {
      var enlace = base_url + "reportes_ingresos/comprobante/"+id;
      window.open(enlace); 
      window.setTimeout('location.reload()', 500);
    }
    else
    {
      return false;
    }
}
/*BENEFICIARIOS*/
function agregarbeneficiario()
{
  $('#accionb').val('nuevo');
  /*
  $('#id_prestamo').val(idprestamo);
  $('#id_persona').val('');*/
  $('#personamodal').modal('show'); 
}
function agregarbeneficiarios(){
  $('#cib').keyup(function () 
    {
        var ci = $('#cib').val(); 
        if(ci.length >0 )
        {
          $('#nombrebene').val(ci); 
          var enlace = base_url + "Registrar_ingresos/buscarpersona";
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
}
function seleccionarbeneficiarios(id, nombre)
{
  
  $('#nombrebene').attr("readonly", true);
  $('#accionb').val('seleccionado');
  $('#id_persona').val(id); 
  $('#nombrebene').val(nombre);

}
function cancelarsel()
{
  $('#accionb').val('nuevo');
  $('#nombrebene').attr("readonly", false);
  $('#id_persona').val('');
  $('#nombrebene').val('');
}
function guardarbeneficiario()
{
  if(confirm('¿Estas seguro de agregar el Beneficiario '+ $('#nombrebene').val() +' ?'))
  {
    
    if($('#accionb').val()=='nuevo')
    {
      if(validardatosbeneficiario())
      { 
        var enlace = base_url + "Registrar_ingresos/guardarbenefici";
         var datos = $('#formulariopersona').serialize();
          $.ajax({
              type: "GET",
              url: enlace,
              data: datos, 
              success: function(data)  
               {
                $('#valorbeneficiario').text(" " + $('#nombrebene').val());
                $('#beneficiario').val(data); 
                $('#personamodal').modal('hide');
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
      $('#valorbeneficiario').text($('#nombrebene').val());
      $('#beneficiario').val(' ' + $('#id_persona').val()); 
      $('#personamodal').modal('hide');
    }
  }
  else
  {
    return false;
  }  

}


function validardatosbeneficiario()
{
  var todook = true;
  

  return todook;
} 