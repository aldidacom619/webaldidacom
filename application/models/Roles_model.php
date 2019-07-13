<?php
/*
*/

class Roles_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();		
	}

	function obtener_roles_cero($id)
	{
		$query = $this->db->query("select o.codigo,o.codad_opcion,o.opcion,o.link,o.nivel,o.orden
									 from ad_opciones_usuarios u,
									      ad_opciones o	
									where u.idad_usuario = ".$id."
									  and o.codigo = u.codad_opcion
									  and o.nivel = 0
									  and u.estado = 'AC'
									order by o.orden asc" );	
        return $query->result();	
	}
	function obtener_roles($id)
	{
		$query = $this->db->query("select o.codigo,o.codad_opcion,o.opcion,o.link,o.nivel,o.orden
									 from ad_opciones_usuarios u,
									      ad_opciones o	
									where u.idad_usuario = ".$id."
									  and o.codigo = u.codad_opcion
									  and o.nivel > 0
									  and u.estado = 'AC'
									order by o.codad_opcion,o.nivel,o.orden asc" );	
        return $query->result();	
	}
	function verificar_rol($iduser,$codopcion)
	{
		$query = $this->db->query("select id
									 from ad_opciones_usuarios u
									where u.idad_usuario = ".$iduser."
									  and u.codad_opcion = ".$codopcion."
									  and u.estado = 'AC'");	
        return $query->result();
	}

}
?>