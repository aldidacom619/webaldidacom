<script type="text/javascript" src="<?php echo  base_url() ?>jsd/egresos.js"></script>
<div id="page-wrapper">
<!-- /#INICIA CUERPO -->

    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">REPORTE GENERAL</h1>
                </div>
        
                <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
   
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                    
                <div class="panel-heading">
                    MONTO POR CUENTAS
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTabless-example">
                            <thead>
                                <tr>
                                <th>Código</th>
                                    <th>Cuenta</th>
                                    <th>Ingresos</th>
                                    <th>Egresos</th>                                            
                                    <th>Saldo</th>                                            
                                </tr>
                            </thead>
                            <tbody>
                                <? $n = 1;
                                    $suma = 0;$suma2 = 0;$suma3 = 0;?>
                                <? foreach($ingresos_egresos as $fila):?>
                                <tr>
                                    <td ><?= $fila->codigo?></td>
                                    <td ><?= $fila->denominacion_cuenta?></td>
                                    <td style="text-align: right;"><?= number_format($fila->ingresos,2)?></td>                                            
                                    <td style="text-align: right;"><?= number_format($fila->egresos,2)?></td>
                                    <td style="text-align: right;"><?= number_format(($fila->ingresos - $fila->egresos),2)?></td>
                                </tr>
                                <? $suma = $suma + $fila->ingresos;
                                   $suma2 = $suma2 + $fila->egresos;
                                   $suma3 = $suma3 + $fila->ingresos - $fila->egresos;?>
                                <?endforeach?>    
                                    <tr>
                                    <th colspan="2" >TOTAL</th>                                            
                                    <td style="text-align: right;"><?= number_format($suma,2)?></td>
                                    <td style="text-align: right;"><?= number_format($suma2,2)?></td>
                                    <th style="text-align: right;"><?= number_format($suma3,2)?></th>                                                                                        
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
        <div class="col-lg-6">
            <div class="panel panel-default">
                    
                <div class="panel-heading">
                    MONTO POR CUENTAS DE BANCOS DISPONIBILIDAD
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTabless-example">
                            <thead>
                                <tr>
                                <th>Código</th>
                                    <th>Cuenta</th>
                                    <th>Ingresos</th>
                                    <th>Egresos</th>                                            
                                    <th>Saldo</th>                                            
                                </tr>
                            </thead>
                            <tbody>
                                <? $n = 1;
                                    $suma = 0;$suma2 = 0;$suma3 = 0;?>
                                <? foreach($ingresos_egresos_bancos as $fila):?>
                                <tr>
                                    <td ><?= $fila->codigo?></td>
                                    <td ><?= $fila->denominacion_cuenta?></td>
                                    <td style="text-align: right;" ><?= number_format($fila->ingresos,2)?></td>                                            
                                    <td style="text-align: right;"><?= number_format($fila->egresos,2)?></td>
                                    <td style="text-align: right;"><?= number_format(($fila->ingresos - $fila->egresos),2)?></td>
                                </tr>
                                <? $suma = $suma + $fila->ingresos;
                                   $suma2 = $suma2 + $fila->egresos;
                                   $suma3 = $suma3 + $fila->ingresos - $fila->egresos;?>
                                <?endforeach?>    
                                    <tr>
                                    <th colspan="2" >TOTAL</th>                                            
                                    <td style="text-align: right;"><?= number_format($suma,2)?></td>
                                    <td style="text-align: right;"><?= number_format($suma2,2)?></td>
                                    <th style="text-align: right;"><?= number_format($suma3,2)?></th>                                                                                        
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
        <!-- /.col-lg-12 -->
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
   
