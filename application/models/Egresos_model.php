<?php
/*
*/ 

class Egresos_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();		
	}
	function egresos_pedientes()
	{
		$query = $this->db->query("select *
									 from cb_ingresos_egresos i
									where i.tipo_transaccion = 'EG'
									  and i.estado IN ('PE','LI')
								   order by i.id asc");	
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
									where i.idcb_ingreso_egreso =". $id."
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
															where ie.idcb_ingreso_egreso =".$ingreso.")");	
        return $query->result();
	}	
	function insert_ingresos_egresos($idcb_ingreso,$correlativo,$cuenta_1,$cuenta_2,$monto,$fecha,$tipo_cambio,$documento_respaldo,$numero_cheque,$idcb_beneficiario,$descripcion_transaccion,$tipo_transaccion,$idad_logs,$cantidad_cuentas_egreso,$saldo_debe,$estado)
	{
		$data = array(
			'idcb_ingreso_egreso' => $idcb_ingreso,
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
	function obtenercorrelativo()
	{
		$query = $this->db->query("select max(i.correlativo)as maximo
									 from cb_ingresos_egresos i");	
        return $query->result();
	}
	function insert_logs($usuario,$codigo)
	{
		$datestring = " %Y-%m-%d %H:%i:%s";
        $time = time(); 
        $fecha =  mdate($datestring, $time);
		$data = array(
			'idad_usuario' => $usuario,
			'codad_accion' => $codigo,
			'fecha' => $fecha			
		 );
		$this->db->insert('ad_logs',$data);
		return $this->db->insert_id();
	}
	function get_ingreso_subcuenta_id($id)
	{
		$query = $this->db->query("select sum(i.monto)as ingreso
									 from cb_ingresos_egresos i
									where i.estado = 'TE'
									  and i.tipo_transaccion = 'IN-CU'
									  and i.cuenta_2 =".$id);	
        return $query->result();

        
	}
	function get_egreso_subcuenta_id($id)
	{
		$query = $this->db->query("select sum(i.monto)as egreso
									 from cb_ingresos_egresos i
									where i.estado IN ('TE','PE')
									  and i.tipo_transaccion = 'EG'
									  and i.cuenta_2 =".$id);	
        return $query->result();
	}

	function get_ingreso_subcuenta_id_liquidez($id)
	{
		$query = $this->db->query("select sum(i.monto)as ingreso
									 from cb_ingresos_egresos i
									where i.estado = 'TE'
									  and i.tipo_transaccion = 'IN'
									  and i.cuenta_2 =".$id);	
        return $query->result();

        
	}
	function get_egreso_subcuenta_id_liquidez($id)
	{
		$query = $this->db->query("select sum(i.monto)as egreso
									 from cb_ingresos_egresos i
									where i.estado IN ('TE','PE')
									  and i.tipo_transaccion = 'EG-CU'
									  and i.cuenta_2 =".$id);	
        return $query->result();
	}
	function get_ingresos_egresos($entidad)
	{
		$query = $this->db->query("select c.codigo,c.denominacion_cuenta,
									(select sum(i.monto)
									 from cb_ingresos_egresos i
									where i.estado = 'TE'
									  and i.tipo_transaccion = 'IN-CU'
									  and i.cuenta_2 = c.codigo)as ingresos,
                    				(select sum(i.monto)
									 from cb_ingresos_egresos i
									where i.estado = 'TE'
									  and i.tipo_transaccion = 'EG'
									  and i.cuenta_2 = c.codigo)as egresos
								  from cb_cuentas c 
								 where c.nivel = 2
								  and c.codad_entidad =".$entidad);	
        return $query->result();

        
	}
	function get_ingresos_egresos_bancos($entidad)
	{
		$query = $this->db->query(" select c.codigo, c.denominacion_cuenta,
			                       (select sum(i.monto)
									  from cb_ingresos_egresos i
									 where i.estado = 'TE'
									   and i.tipo_transaccion = 'IN'
									   and i.cuenta_2 = c.codigo)as ingresos,
                    			   (select sum(i.monto)
									  from cb_ingresos_egresos i
									 where i.estado = 'TE'
									   and i.tipo_transaccion = 'EG-CU'
									   and i.cuenta_2 = c.codigo)as egresos
								      from cb_cuentas c 
									 where c.nivel = 2
									   and c.codad_entidad =".$entidad);	
        return $query->result();
	}
}
?>