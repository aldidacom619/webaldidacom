<script type="text/javascript" src="<?php echo  base_url() ?>jsd/reportes.js"></script>
<div id="page-wrapper">
<!-- /#INICIA CUERPO -->

    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reimpresión de Comprobantes</h1>
                </div> 
                <!-- /.col-lg-12 -->
    </div>
  
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Lista de Comprobantes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Correlativo</th>
                                            <th>Tipo Transacción</th>
                                            <th>Cuenta Ingreso</th>
                                            <th>Beneficiario</th>
                                            <th>Fecha Doc.</th>
                                            <th>Monto</th>
                                           
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? $n = 1?>
                                        <? foreach($ingresos as $fila):?>
                                        <tr>
                                            <td ><?= $n?></td>                                      
                                            <td ><?= $fila->correlativo?></td>
                                            <td>
                                            <?if($fila->tipo_transaccion == 'IN'){?>                                             
                                                INGRESO
                                            <?}else {?>
                                                EGRESO
                                            <?}?> 
                                            </td>
                                            <td ><?= cuentas_denominacion($fila->cuenta_1)?><br><?= cuentas_denominacion($fila->cuenta_2)?></td>
                                            <td ><?= beneficiarios_helpers($fila->idcb_beneficiario)?></td>
                                            <td ><?= $fila->fecha?></td>
                                            <td ><?= number_format($fila->monto,2)?></td>                                            
                                            
                                            <td>
                                            <?if($fila->tipo_transaccion == 'IN'){?>                                             
                                                <button class="btn btn-primary" onclick='imprimir_ingreso(<?= $fila->id?>)'>Imprimir</button>
                                            <?}else {?>
                                                <button class="btn btn-primary" onclick='imprimir_egreso(<?= $fila->id?>)'>Imprimir</button>
                                            <?}?> 
                                            </td>                                        
                                        </tr>
                                        <? $n++?>
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
   
