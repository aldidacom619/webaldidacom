<?php
/*
*/

class Ingresos_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();		
	}
	function ingresos_pedientes()
	{
		$query = $this->db->query("select *
									 from cb_ingresos i
									where i.estado IN ('PE','LI')");	
        return $query->result();
	}

}
?>