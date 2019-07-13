<script type="text/javascript" src="<?php echo  base_url() ?>jsd/ingresos.js"></script>
<div id="page-wrapper">
<!-- /#INICIA CUERPO -->

    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Registro de Cuentas al Debe</h1>
                </div>
        
                <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning">
                <strong> CUENTA:
                    <?= cuentas_denominacion($ingresos[0]->cuenta_1)." -  ".cuentas_denominacion($ingresos[0]->cuenta_2)?><br>
                            FECHA: <?= $ingresos[0]->fecha?><br>
                            MONTO: <?= number_format($ingresos[0]->monto,2)?><br>
                            SALDO: <?= number_format(($ingresos[0]->saldo_debe),2)?>
                </strong>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success">
                <strong>OPCIONES:</strong>
                <?if($ingresos[0]->saldo_debe > 0){?>  
                    <button class="btn btn-primary" onclick='nuevaegreso_ingreso()'>NUEVO</button>                  
                <?}?>                
            </div> 
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
            <div class="panel panel-default">
                    
                <div class="panel-heading">
                    Registro de egresos
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTabless-example">
                            <thead>
                                <tr>
                                <th>Opciones</th>
                                    <th>Cuenta Egreso</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>                                            
                                </tr>
                            </thead>
                            <tbody>
                                <? $n = 1;
                                    $suma = 0;?>
                                <? foreach($egresos as $fila):?>
                                <tr>
                                <td>
                                    <?if($fila->estado == 'PE'){?>                                             
                                        <button class="btn btn-primary" onclick='reg_debe(<?= $fila->id?>)'>Reg. Debe</button>
                                    <?}else {?>
                                        <button class="btn btn-primary" onclick='editarusuario(<?= $fila->id_user?>)'>Editar</button>
                                    <?}?> 
                                </td>
                                    <td ><?= cuentas_denominacion($fila->cuenta_1)?><br><?= cuentas_denominacion($fila->cuenta_2)?></td>
                                    <td ><?= $fila->fecha?></td>
                                    <td ><?= number_format($fila->monto,2)?></td>                                            
                                                                            
                                </tr>
                                <? $suma = $suma + $fila->monto?>
                                <?endforeach?>    
                                    <tr>
                                    <th colspan="3" >TOTAL</th>                                            
                                    <th ><?= number_format($suma,2)?></th>                                            
                                </tr>                                  
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                    
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <div class="col-lg-2">
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="modal fade" id="cuentaegresomodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">REGISTRO DE EGRESO</h4>
                </div>
                <div class="modal-body">
		            <form id="formulariocuentaegreso">
			          <div class="row"> 
			            <legend>Datos Egreso</legend>
			             <div  class="alert alert-danger"  id="validaregreso" style="display: none;">
                
           				 </div>
			              <input type="hidden" class="form-control" id="accion" name="accion" required="required">
			              <input type="hidden" class="form-control" id="id_ingreso" name="id_ingreso" value="<?= $ingresos[0]->id?>" required="required">
                          <input type="hidden" class="form-control" id="cuenta_2" name="cuenta_2" value="<?= $ingresos[0]->cuenta_2?>" required="required">
			              <input type="hidden" class="form-control" id="montoingreso" name="montoingreso" value="<?= $ingresos[0]->monto?>" required="required">
                          <input type="hidden" class="form-control" id="saldoegreso" name="saldoegreso" value="<?= number_format($suma,2)?>" required="required">
			           
			            <div class="col-lg-12">
			              <div class="form-group">
			                <label> CUENTA</label>
			                <SELECT NAME="cuentae" id = "cuentae" class="form-control" required="required">
			                  
			                </SELECT> 
			              </div>
			               <div class="form-group">
			                <label> SUB CUENTA</label>
			                <SELECT NAME="sub_cuentae" id = "sub_cuentae" class="form-control" required="required">
			                  
			                </SELECT> 
			              </div>
			              <div class="form-group">
			                    <label>MONTO DE EGRESO</label>
			                    <input class="form-control" id="monto_egreso" name="monto_egreso" required="required">
			                </div>
			            </div>			            
			          </div> 
			        </form> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick='cerrarmodal()'><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick='guardaregreso()'><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
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
      validacioncuentasegreso();
      });
</script>
   
