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
									 from cb_ingresos_egresos i
									where i.estado IN ('PE','LI')");	
        return $query->result();
	}
	function ingresos_id($id)
	{
		$query = $this->db->query("select *
									 from cb_ingresos_egresos i
									where i.id =". $id);	
        return $query->result();
	}
	function ingresos_egresos_id($id)
	{
		$query = $this->db->query("select *
									 from cb_ingresos_egresos i
									where i.idcb_ingreso =". $id."
									  and i.estado = 'AC'");	
        return $query->result();
	}
	function getcuentas_tabla()
	{
		$query = $this->db->query("select *
									 from cb_cuentas c
									where c.nivel = 1
									  and c.estado = 'AC'");	
        return $query->result();
	}
	function getsubcuenta_tabla($cuenta)
	{
		$query = $this->db->query("select *
									 from cb_cuentas c
									where c.codcb_cuenta =".$cuenta."
									  and c.estado = 'AC'");	
        return $query->result();
	}
	function getcuentas_tabla_id($id)
	{
		$query = $this->db->query("select *
									 from cb_cuentas c
									where c.nivel = 1
									  and c.estado = 'AC'
									  and c.id not in (select i.cuenta_1
														 from cb_ingresos_egresos i
														 where i.id =".$id.")");	
        return $query->result();
	}
	function getsubcuenta_tabla_id($cuenta,$ingreso)
	{
		$query = $this->db->query("select *
									 from cb_cuentas c
									where c.codcb_cuenta =".$cuenta."
									  and c.estado = 'AC'
									  and c.codigo not in (select i.cuenta_2 
															 from cb_ingresos_egresos i
															where i.id =".$ingreso.")
									  and c.codigo not in (select ie.cuenta_2 
															 from cb_ingresos_egresos ie
															where ie.idcb_ingreso =".$ingreso.")");	
        return $query->result();
	}	
	function insert_ingresos_egresos($idcb_ingreso,$correlativo,$cuenta_1,$cuenta_2,$monto,$fecha,$tipo_cambio,$documento_respaldo,$numero_cheque,$idcb_beneficiario,$descripcion_transaccion,$tipo_transaccion,$idad_logs,$cantidad_cuentas_egreso,$saldo_debe,$estado)
	{
		$data = array(
			'idcb_ingreso' => $idcb_ingreso,
			'correlativo' => $correlativo,
			'cuenta_1' => $cuenta_1,
			'cuenta_2' => $cuenta_2,
			'monto' => $monto,
			'fecha' => $fecha,
			'tipo_cambio' => $tipo_cambio,
			'documento_respaldo' => $documento_respaldo,
			'numero_cheque' => $numero_cheque,
			'idcb_beneficiario' => $idcb_beneficiario,
			'descripcion_transaccion' => $descripcion_transaccion,
			'tipo_transaccion' => $tipo_transaccion,
			'idad_logs' => $idad_logs,
			'cantidad_cuentas_egreso' => $cantidad_cuentas_egreso,
			'saldo_debe' => $saldo_debe,
			'estado' =>$estado,
		 );
		$this->db->insert('cb_ingresos_egresos',$data);
		return $this->db->insert_id();
	}
	function actualizarsaldoestado($id,$saldo_debe,$cantidad_cuentas_egreso,$estado)
	{
		$data = array(
			'saldo_debe' => $saldo_debe,
			'cantidad_cuentas_egreso' => $cantidad_cuentas_egreso,
			'estado' =>$estado,
		  );
		 $this->db->where('id',$id);
		 return  $this->db->update('cb_ingresos_egresos',$data);
	}


}
?>