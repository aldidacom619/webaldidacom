<script type="text/javascript" src="<?php echo  base_url() ?>jsd/ingresos.js"></script>
<div id="page-wrapper">
<!-- /#INICIA CUERPO -->

    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Registro de Ingresos</h1>
                </div>
                <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success">
                <strong>OPCIONES:</strong>                
                    <button class="btn btn-primary" onclick='nuevo_ingreso()'>NUEVO INGRESO</button>                  
                             
            </div> 
        </div>
    </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Ingresos Pendientes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        <th>Opciones</th>
                                            <th>Cuenta Ingreso</th>
                                            <th>Beneficiario</th>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                            <th>Saldo Debe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? $n = 1?>
                                        <? foreach($ingresos as $fila):?>
                                        <tr>
                                        <td>
                                            <?if($fila->estado == 'PE'){?> 						            	       
                                                <button class="btn btn-primary" onclick='reg_debe(<?= $fila->id?>)'>Reg. Debe</button>
                                            <?}else {?>
                                                <button class="btn btn-primary" onclick='reg_debe(<?= $fila->id?>)'>Reg. Debe</button><br>
                                                <button class="btn btn-primary" onclick='editarusuario(<?= $fila->id_user?>)'>Imprimir</button>
                                            <?}?> 
						          	    </td>
                                            <td ><?= cuentas_denominacion($fila->cuenta_1)?><br><?= cuentas_denominacion($fila->cuenta_2)?></td>
                                            <td ><?= beneficiarios_helpers($fila->idcb_beneficiario)?></td>
                                            <td ><?= $fila->fecha?></td>
                                            <td ><?= number_format($fila->monto,2)?></td>                                            
                                            <td ><?= number_format($fila->saldo_debe,2)?></td>                                            
                                        </tr>
                                        <?endforeach?>                                      
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            
<!-- /#FIN CUERPO -->
</div>
        <!-- /#page-wrapper -->
<script type="text/javascript">
    $(document).ready(function(){
      var enlace = "<?php echo  base_url() ?>";
      baseurl(enlace);      
      });
</script>
   
