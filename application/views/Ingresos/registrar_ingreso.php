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
                       <legend>Datos de Préstamo</legend>
                        <div  class="alert alert-danger"  id="validarprestamo" style="display: none;">
                                        </div>
                         <input type="hidden" class="form-control" id="accion" name="accion" value="nuevo" required="required">
                         <input type="hidden" class="form-control" id="id_ingreso" name="id_ingreso" required="required">
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
                        <div class="col-lg-4">
                            
                            <div class="form-group">
                                   <label>BENEFICIARIO</label>
                                   <input class="form-control" id="beneficiario" name="beneficiario" required="required">
                            </div> 
                            <div class="form-group">
                                   <label>DESCRIPCION TRANSACCION </label>
                                   <textarea class="form-control" id="descripcioningreso" name="descripcioningreso" ></textarea>
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
<!-- /#page-wrapper -->
<script type="text/javascript">
    $(document).ready(function(){
      var enlace = "<?php echo  base_url() ?>";
      baseurl(enlace);      
      validacioncuentasingreso();
      });
</script>
   
