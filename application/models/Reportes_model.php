<?php
/*
*/

class Reportes_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();		
	}
	function ingresos_pedientes()
	{
		$query = $this->db->query("select *
									 from cb_ingresos_egresos i
									where i.tipo_transaccion in('IN','EG')
									  and i.estado IN ('TE')
								   order by i.id asc");	
        return $query->result();
	}
	



}
?>