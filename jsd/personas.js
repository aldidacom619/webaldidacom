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

 
  $('#ci').keyup(function () 
  {
    var tem = $('#ci').val();
    var RE = /^[a-zA-Z0123456789_\s]+$/;
    if (RE.test(tem)) {

        verificarduplicidadci(tem);
    }
    else
    { $('#ci').val(''); }
  });

$("#fechanacimientodoc").datepicker({
     
      format: "yyyy-mm-dd",
      orientation: "top left",
      language: "es" 
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

   $('#ap_casada').keyup(function () 
  {
    var tem = $('#ap_casada').val();
    var RE = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/;
    if (RE.test(tem)) {}
    else
    { $('#ap_casada').val(''); }
  });

   $('#celular').keyup(function () 
  {
    var tem = $('#celular').val();
    var RE = /^\d*\d*$/;
    if (RE.test(tem)) {}
    else
    { $('#celular').val(''); }
  });

 


    $('#ocupacion').keyup(function () 
  {
    var tem = $('#ocupacion').val();
    var RE = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\s]+$/;
    if (RE.test(tem)) {}
    else
    { $('#ocupacion').val(''); }
  });




 
}
function nuevapersona()
{
  $('#accion').val('nuevo');
  $('#id_persona').val('');
  $('#personamodal').modal('show');
}
function guardarpersona()
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
                //alert(data); 
               
                alert('SE GUARDO LA INFORMACION CORRECTAMENTE');
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



function editarpersona(id)
{

  $('#usuarioslabel').hide('');
  $('#estadousesr').show('');
  $('#clave').val('');
  $('#nombreusuario').val('');
  $('#nombreusuario').attr("readonly", true);
  $('#clave').attr("readonly", true);


  var enlace = base_url + "personas/datopersona";
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
            $('#ap_paterno').val(datos.primer_apellido); 
            $('#ap_materno').val(datos.segundo_apellido);
            $('#ap_casada').val(datos.apellido_casada);
            $('#sexo option[value="'+datos.sexo+'"]').prop('selected','selected');
            $('#fechanacimientodoc').val(datos.fecha_nacimiento);
            $('#domicilio').val(datos.direccion);
            $('#celular').val(datos.telefono);
             $('#ocupacion').val(datos.ocupacion);
              $('#correo').val(datos.correo);
           
          });
          $('#personamodal').modal('show');  

      
      }
  });
   
}



function verificarduplicidadci(tem)
{
  var enlace = base_url + "personas/verificarci";
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
                  $('#validarpersona').text("El numero de CI ya se encuentra registrado");
                  $('#validarpersona').show();
            }
            else
            {
               validarci = false;
                $('#validarpersona').text("");
                  $('#validarpersona').hide();
            }
            
         }
    });
}



function cerrarmodal()
{
  window.setTimeout('location.reload()', 100);
}
function nuevoprestamos(id_p)
{
  var enlace = base_url + "index.php/prestamos/nuevoprestamo/" + id_p;
  location.href = enlace;
}
function verprestamos(id_p)
{
  var enlace = base_url + "index.php/prestamos/verprestamos/" + id_p;
  location.href = enlace;
}