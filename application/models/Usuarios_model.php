<?php
/*
*/

class Usuarios_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();		
	}

	function loguear($username, $password)
	{
		$query = $this->db->query("select *
									 from ad_usuarios 
									where login = '".$username."' 
									  and clave = '".$password."'");	
        return $query->result();   
	}
	
	

}
?>