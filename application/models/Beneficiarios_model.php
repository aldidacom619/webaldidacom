<?php
/*
*/

class Beneficiarios_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();		
	}
	function get_beneficiario($id)
	{
		$query = $this->db->query("select *
									 from cb_beneficiarios b
									where b.id = ".$id);	
        return $query->result();
	}

}
?>