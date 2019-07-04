<div id="page-wrapper">
<!-- /#INICIA CUERPO -->

    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Registro de Ingresos Pendientes</h1>
                </div>
                <!-- /.col-lg-12 -->
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
                                            <th>Rendering engine</th>
                                            <th>Browser</th>
                                            <th>Platform(s)</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $n = 1;
                                         foreach($ingresos as $fila):
                                          echo "<tr>
                                                <td >".$n++."</td>
                                                <td >".cuentas_denominacion($fila->cuenta_1)."</td>
                                                <td >". $fila->monto."</td>                                                
                                                </tr>";
                                        endforeach;?>                                        
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

   
