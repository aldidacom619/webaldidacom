<?php
/*
*/

class Cuentas_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();		
	}
	function get_cuentas($idcuenta)
	{
		$query = $this->db->query("select *
									 from cb_cuentas c
									where c.codigo = ".$idcuenta."
									  and c.estado = 'AC'");	
        return $query->result();
	}

}
?>