<?php ob_start('comprimir_pagina_cuerpo'); ?> 
<script type="text/javascript" src="<?php echo  base_url() ?>jsd/ingresos.js"></script>
<div id="page-wrapper">
<!-- /#INICIA CUERPO -->

    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Registro de Ingresos</h1>
                </div>
        
                <!-- /.col-lg-12 -->
    </div> 
    <div class="panel panel-default">	           
               <div class="modal-body">       
                   <form id="formularioingreso">
                     <div class="row"> 
                       <legend>Datos de Ingreso</legend>
                        <div  class="alert alert-danger"  id="validaringreso" style="display: none;"></div>
                         <input type="hidden" class="form-control" id="accion" name="accion" value="nuevo" required="required">
                         <input type="hidden" class="form-control" id="id_ingreso" name="id_ingreso" required="required">
                          <div class="col-lg-4">
                            
                            <div class="form-group">
                                   <label>BENEFICIARIO</label>
                                   <input type="hidden" class="form-control" id="beneficiario" name="beneficiario" required="required">
                            </div> 
                             <div class="alert alert-warning">
                                <button class="btn btn-prymari" onclick='agregarbeneficiario()'>AGREGAR</button><strong  id="valorbeneficiario"></strong>
                            </div> 
                            <div class="form-group">
                                   <label>DESCRIPCION TRANSACCION </label>
                                   <textarea class="form-control" id="descripcioningreso" name="descripcioningreso" ></textarea>
                            </div>  
                       </div>
                         <div class="col-lg-4">
                         <div class="form-group">
			                <label> CUENTA</label>
			                <SELECT NAME="cuenta" id = "cuenta" class="form-control" required="required">
			                  
			                </SELECT> 
			              </div>
			               <div class="form-group">
			                <label> SUB CUENTA</label>
			                <SELECT NAME="sub_cuenta" id = "sub_cuenta" class="form-control" required="required">
			                  
			                </SELECT> 
			              </div>
                        
                         <div class="form-group"> 
                           <label>FECHA</label>
                           <input class="form-control" id="fecha" name="fecha" required="required">

                         </div>                    
                       </div>
                       <div class="col-lg-4">
                            <div class="form-group">
                               <label>TIPO DE CAMBIO</label>
                               <input class="form-control" id="tipocambio" name="tipocambio" required="required" >                               
                           </div>
                                  <div class="form-group"> 
                                   <label>MONTO BS</label>
                                   <input class="form-control" id="monto" name="monto" required="required">
                            </div>
                            <div class="form-group">
                                   <label>DOCUMENTO RESPALDO</label>
                                   <input class="form-control" id="docrespaldo" name="docrespaldo" required="required">
                            </div>   
                         </div>
                       
                     </div>                     
                   </form> 
                  </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick='cerrarmodal()'><span class="glyphicon glyphicon-remove"></span> Limpiar</button>
                <button type="button" class="btn btn-primary" id = "guardarprestamo" onclick='guardaringreso()'><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
            </div>
    </div>  
<!-- /#FIN CUERPO -->
</div>
<div class="modal fade" id="personamodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">AGREGAR BENEFICIARIO</h4>
      </div>
      <div class="modal-body"><legend>Datos Personales</legend>
            <div  class="alert alert-danger"  id="validarpersona" style="display: none;">
                
                   </div>
           <div class="row">                   

                    <div class="col-lg-4">
                    <div class="form-group"> 
                      <label>BUSCAR</label>
                      <input class="form-control" id="cib" name="cib" required="required">
                      <small id="emailHelp" class="form-text text-muted">PEDRO RAMIREZ.</small>
                    </div>
                     </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="listagarantes"></div>
                    </div>
                </div>
            <form id="formulariopersona">
                 <input type="text" class="form-control" id="accionb" name="accionb" >
                 <input type="hidden" class="form-control" id="id_persona" name="id_persona" >                 
                <div class="row"> 
                    <div class="col-lg-12">
                      <div class="form-group"> 
                      <label>BENEFICIARIO</label>
                      <input class="form-control" id="nombrebene" name="nombrebene" required="required">
                      <small id="emailHelp" class="form-text text-muted">EJ. PEDRO RAMIREZ</small>
                    </div>
                    
                  </div>
                  
                </div> 
              </form> 
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick='cerrarmodal()'><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
        <button type="button" class="btn btn-info"  onclick='cancelarsel()'> Cancelar Seleccion</button>
        <button type="button" class="btn btn-primary" onclick='guardarbeneficiario()'><span class="glyphicon glyphicon-floppy-disk"></span> Seleccionar</button>
      </div>
    </div>
  </div>
</div>
<!-- /#page-wrapper -->
<script type="text/javascript">
    $(document).ready(function(){
      var enlace = "<?php echo  base_url() ?>";
      baseurl(enlace);      
      validacioncuentasingreso();
      agregarbeneficiarios();
      });
</script>
   
<?php
// Una vez que el búfer almacena nuestro contenido utilizamos "ob_end_flush" para usarlo y deshabilitar el búfer
ob_end_flush(); 
// Función para eliminar todos los espacios en blanco
function comprimir_pagina_cuerpo($buffer) { 
    $busca = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s'); 
    $reemplaza = array('>','<','\\1'); 
    return preg_replace($busca, $reemplaza, $buffer); 
} 
?>