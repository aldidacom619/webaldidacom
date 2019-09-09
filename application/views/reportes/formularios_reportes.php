<script type="text/javascript" src="<?php echo  base_url() ?>jsd/reportes.js"></script>
<div id="page-wrapper">
<!-- /#INICIA CUERPO -->

    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Registro de Egreso</h1>
                </div>
        
                <!-- /.col-lg-12 -->
    </div> 
    <div class="panel panel-default">
	           
        <div class="modal-body">
               	<div class="panel panel-default">
	              		<div class="panel-heading">
	                            Reporte por Fechas
	                    </div>
					    <div class="row"> 
			          	<form id="formularioreportesuno">
			          
			            	<div class="col-lg-3">
			              		<div class="form-group">
			                		<label>FECHA INICIO</label>
			                		<input type="text"  NAME="fecha1" id = "fecha1" class="form-control">
			            	  	</div>			             
			            	</div>
			            	<div class="col-lg-3">
			              		<div class="form-group">
			                		<label>FECHA FIN</label>
			                		<input type="text"  NAME="fecha2" id = "fecha2" class="form-control">
			                  	</div>
				            </div>
			              </form> 
			            <div class="col-lg-3">
			             	<div class="form-group"> 
			             		<br>
			                  <button class="btn btn-primary" onclick='primerreporteamortizacion()'><span class="fa fa-print"></span> Imprimir Reporte</button>
			                </div>
			         	</div>
			        </div> 
             	</div>
             		<div class="panel panel-default">
             		<div class="panel-heading">
	                            Reporte por cuentas
	                   </div>
				    <div class="row"> 
			          	<form id="formularioreportesdos">
			            
			            	<div class="col-lg-3">
			              		 <div class="form-group">
      			                <label> CUENTA</label>
      			                <SELECT NAME="cuenta" id = "cuenta" class="form-control" required="required">
    			                  </SELECT> 
      			               </div>		             
			            	</div>
			            	<div class="col-lg-3">
			              		 <div class="form-group">
      			                <label> SUB CUENTA</label>
       			                <SELECT NAME="sub_cuenta" id = "sub_cuenta" class="form-control" required="required">
      			                </SELECT> 
      			               </div>
				            </div>
			              </form> 
			            <div class="col-lg-3">
			             	<div class="form-group"> 
			             		<br>
			                  <button class="btn btn-primary" onclick='imprimirporcuentas()'><span class="fa fa-print"></span> Imprimir Reporte</button>
			                </div>
			         	</div>
			        </div> 
             	</div>
                
    </div>  
<!-- /#FIN CUERPO -->
</div>

<!-- /#page-wrapper -->
<script type="text/javascript">
    $(document).ready(function(){
      var enlace = "<?php echo  base_url() ?>";
      baseurl(enlace);  
      valoresdefecto();    
     
      });
</script>
   
