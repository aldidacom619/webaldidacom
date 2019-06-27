var base_url;
var alertaValidacion = '';
var validarci = false;
function baseurl(enlace)
{
  base_url = enlace;
  
}
function validacionformulariopersona()
{
  var sexo = '<option VALUE="-1">Seleccionar opcion</OPTION><option VALUE="MASCULINO">MASCULINO</OPTION><option VALUE="FEMENINO">FEMENINO</OPTION>';
$('#sexo').html(sexo);
var tipouser = '<option VALUE="-1">Seleccionar opcion</OPTION><option VALUE="2">ADMINISTRADOR</OPTION><option VALUE="3">COBRADOR</OPTION>';
$('#tipouser').html(tipouser);


var estadouser = '<option VALUE="-1">Seleccionar opcion</OPTION><option VALUE="t">ACTIVAR</OPTION><option VALUE="f">BAJA</OPTION>';
$('#estadouser').html(estadouser);


 $("#fechanacimiento").datepicker({
    
      format: "yyyy-mm-dd",
      orientation: "top left",
      language: "es" 
    });


  $('#ci').keyup(function () 
  {
    var tem = $('#ci').val();
     var RE = /^\d*\d*$/;
    if (RE.test(tem)) {

        verificarduplicidadci(tem);
    }
    else
    { $('#ci').val(''); }
  });

    $('#nombres').keyup(function () 
  {
    var tem = $('#nombres').val();
    var RE = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/;
    if (RE.test(tem)) {}
    else
    { $('#nombres').val(''); }
  });

  $('#ap_paterno').keyup(function () 
  {
    var tem = $('#ap_paterno').val();
    var RE = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/;
    if (RE.test(tem)) {}
    else
    { $('#ap_paterno').val(''); }
  });
  $('#ap_materno').keyup(function () 
  {
    var tem = $('#ap_materno').val();
    var RE = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/;
    if (RE.test(tem)) {}
    else
    { $('#ap_materno').val(''); }
  });

   $('#celular').keyup(function () 
  {
    var tem = $('#celular').val();
    var RE = /^\d*\d*$/;
    if (RE.test(tem)) {}
    else
    { $('#celular').val(''); }
  });

    $('#nombreusuario').keyup(function () 
  {
    var tem = $('#nombreusuario').val();
    var RE = /^[a-zA-Z0123456789\s]+$/;
    if (RE.test(tem)) {}
    else
    { $('#nombreusuario').val(''); }
  });



}
function nuevausuario()
{
  $('#accion').val('nuevo');
  $('#id_persona').val('');

  $('#usuarioslabel').show('');
  $('#estadousesr').hide('');

  $('#clave').val('');
  $('#nombreusuario').val('');
  $('#personamodal').modal('show');
}
function guardarusuario()
{
  if(validardatos())
    {  
      var enlace = base_url + "user/guardaruser";
      var datos = $('#formulariousuario').serialize();
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
      }
    else
    {
      
      $('#validacionusuario').text("Verificar: "+alertaValidacion);
      $('#validacionusuario').show();

     // alert("Falta llenar o seleccionar los campos: \n"+alertaValidacion+"\n deberán ser llenados o seleccionados");
      alertaValidacion="";
    }
}
function cerrarmodal()
{
  window.setTimeout('location.reload()', 100);
}
function editarusuario(id)
{

  $('#usuarioslabel').hide('');
  $('#estadousesr').show('');
  $('#clave').val('');
  $('#nombreusuario').val('');
  $('#nombreusuario').attr("readonly", true);
  $('#clave').attr("readonly", true);


  var enlace = base_url + "user/datosusuario";
   $.ajax({ 
      url: enlace,
      type: 'GET',
      data: {idp:id},
      success:function(data)
      { 
         //alert(data);
         $('#accion').val('modificar');
         $('#id_persona').val(id);
         var result = JSON.parse(data);
          $.each(result, function(i, datos)
          {
            $('#ci').val(datos.ci);
           $('#nombres').val(datos.nombres);
            $('#ap_paterno').val(datos.apellido_paterno); 
            $('#ap_materno').val(datos.apellido_materno);
            $('#sexo option[value="'+datos.sexo+'"]').prop('selected','selected');
            $('#fechanacimiento').val(datos.fecha_nacimiento);
            $('#domicilio').val(datos.direccion);
            $('#celular').val(datos.telefono);
           $('#tipouser option[value="'+datos.tipo_user+'"]').prop('selected','selected');
           $('#estadouser option[value="'+datos.estado_user+'"]').prop('selected','selected');
          });
          $('#personamodal').modal('show');  

      
      }
  });
   
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
  if($('#fechanacimiento').val()=='')
  {        
     todook=false;
     $('#fechanacimiento').closest(".form-group").addClass("has-error");
     alertaValidacion += "* Fecha Nacimiento -  \n";
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
  if($('#accion').val()=='nuevo')
  {
    if($('#nombreusuario').val()=='')
    {        
       todook=false;
       $('#nombreusuario').closest(".form-group").addClass("has-error");
       alertaValidacion += "* Nombre de Usuario -  \n";
    }
    if($('#clave').val()=='')
    {        
       todook=false;
       $('#clave').closest(".form-group").addClass("has-error");
       alertaValidacion += "* Contraseña  \n";
    }
  }
  

  return todook;
} 
function verificarduplicidadci(tem)
{
  var enlace = base_url + "user/verificarci";
   $.ajax({
        type: "GET",
        url: enlace,
        data:{ci:tem},
        success: function(data)  
         {
            if(data == 1)
            {
                  validarci = true;
                   $('#ci').closest(".form-group").addClass("has-error"); 
                  $('#validacionusuario').text("El numero de CI ya se encuentra registrado");
                  $('#validacionusuario').show();
            }
            else
            {
               validarci = false;
                $('#validacionusuario').text("");
                  $('#validacionusuario').hide();
            }
            
         }
    });
}