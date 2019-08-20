 </div>
    <!-- /#wrapper -->   
 <!-- jQuery -->
    <script src="<?php echo  base_url() ?>recursos/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo  base_url() ?>recursos/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="<?php echo  base_url() ?>recursos/bower_components/bootstrap/dist/js/datepicker.min.js"></script>
    <script src="<?php echo  base_url() ?>recursos/bower_components/bootstrap/dist/js/datepicker.es.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo  base_url() ?>recursos/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo  base_url() ?>recursos/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo  base_url() ?>recursos/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo  base_url() ?>recursos/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo  base_url() ?>recursos/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            "language": {
                "emptyTable":           "No hay datos disponibles en la tabla.",
                "info":             "Del _START_ al _END_ de _TOTAL_ ",
                "infoEmpty":            "Mostrando 0 registros de un total de 0.",
                "infoFiltered":         "(filtrados de un total de _MAX_ registros)",
                "infoPostFix":          "(actualizados)",
                "lengthMenu":           "Mostrar _MENU_ registros",
                "loadingRecords":       "Cargando...",
                "processing":           "Procesando...",
                "search":           "Buscar:",
                "searchPlaceholder":        "Dato para buscar",
                "zeroRecords":          "No se han encontrado coincidencias.",
                "paginate": {
                    "first":            "Primera",
                    "last":             "Última",
                    "next":             "Siguiente",
                    "previous":         "Anterior"
                },
                "aria": {
                    "sortAscending":    "Ordenación ascendente",
                    "sortDescending":   "Ordenación descendente"
                }
            },
            responsive: true,

        });
    });
    </script>

</body>

</html>