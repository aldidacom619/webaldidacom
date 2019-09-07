<div class="panel panel-default">
	           
                <div class="panel-body">
                    <div class="dataTable_wrapper">
				    	 	<table width="100%" class="table table-fit table-striped table-bordered table-hover" id="dataTables-example2">
				        <thead class="thead">
				    		<th>Nro</th>
								<th>Beneficiario</th>
								
						        <th>OPCIONES</th>
				     		</thead>
				     		<tbody>
				     		<? $n = 1?>
				    		<? foreach($filas as $fila):?>
				        	<tr>
				          			<td ><?= $n++?></td>
									<td ><?= $fila->nombres?></td>
									<td ><button class="btn btn-primary" onclick='seleccionarbeneficiarios(<?= $fila->id?>,"<?= $fila->nombres?>")'>SELECCIONAR</button>						            	
						          	</td>
				        </tr>
				        <?endforeach?>
				        </tbody>
				      </table> 
     				</div>  
    			</div>
		</div>