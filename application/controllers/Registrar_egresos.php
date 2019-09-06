<?php

class Registrar_egresos extends CI_Controller
{
	function __construct(){
		parent::__construct();	
		$this->_is_logued_in();	
		$this->load->model('roles_model');
		$this->load->model('ingresos_model');
		$this->load->model('egresos_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->helper('Menu_helper');
		$this->load->helper('cuentas_helper');
		$this->load->helper('date');

	}
	function _is_logued_in()
	{
		$is_logued_in = $this->session->userdata('is_logued_in'); 
		if($is_logued_in != TRUE)
		{
			redirect('usuarios');
		}	
	}
	function index() 
	{
		if(1 == 1)
		{
			$id_usu = $this->session->userdata('id');
			$dato['id_usu'] = $id_usu;
			$dato['usuario'] = $this->session->userdata('usuario');
			$dato['rolescero'] = $this->roles_model->obtener_roles_cero($id_usu);
			$dato['roles'] = $this->roles_model->obtener_roles($id_usu);
			$dato['egresos'] = $this->egresos_model->egresos_pedientes();
			$this->load->view("Inicio/cabecera");
			$this->load->view("Inicio/cabecera");		
			$this->load->view("Inicio/menu",$dato);		
			$this->load->view("Egresos/egreso_pedientes",$dato);		
			$this->load->view("Inicio/pie");
		}
		else{
			//$this->index();
			redirect("inicio");
		}
	}
	function registrar_debe($id)
	{
		if(1 == 1)
		{
			$id_usu = $this->session->userdata('id');
			$dato['id_usu'] = $id_usu;
			$dato['usuario'] = $this->session->userdata('usuario');
			$dato['rolescero'] = $this->roles_model->obtener_roles_cero($id_usu);
			$dato['roles'] = $this->roles_model->obtener_roles($id_usu);
			$dato['ingresos'] = $this->ingresos_model->ingresos_id($id);
			$dato['egresos'] = $this->ingresos_model->ingresos_egresos_id($id);
			$this->load->view("Inicio/cabecera");
			$this->load->view("Inicio/cabecera");		
			$this->load->view("Inicio/menu",$dato);		
			$this->load->view("Egresos/registrar_haber",$dato);		
			$this->load->view("Inicio/pie");
		}
		else{
			//$this->index();
			redirect("inicio");
		}
	}
	function nuevo_egreso()
	{
		if(1 == 1)
		{
			$id_usu = $this->session->userdata('id');
			$dato['id_usu'] = $id_usu;
			$dato['usuario'] = $this->session->userdata('usuario');
			$dato['rolescero'] = $this->roles_model->obtener_roles_cero($id_usu);
			$dato['roles'] = $this->roles_model->obtener_roles($id_usu);			
			$this->load->view("Inicio/cabecera");
			$this->load->view("Inicio/cabecera");		
			$this->load->view("Inicio/menu",$dato);		
			$this->load->view("Egresos/registrar_egreso",$dato);		
			$this->load->view("Inicio/pie");
		}
		else{
			//$this->index();
			redirect("inicio");
		}
	}
	function getcuentas(Type $var = null) 
	{
		$filas = $this->ingresos_model->getcuentas_tabla();
		$option = "<option VALUE='-1'>Seleccionar cuenta</OPTION>";
		foreach ($filas as $fila) 
		{
			$option.="<option value = '".$fila->codigo."'>".$fila->denominacion_cuenta."</option>";		
		}
		echo $option;
	}
	function getsubcuenta()
	{
		$cuenta = $this->input->get('cue');
		$filas = $this->ingresos_model->getsubcuenta_tabla($cuenta);
		$option = "<option VALUE='-1'>Seleccionar sub cuenta</OPTION>";
		foreach ($filas as $fila) 
		{
			$option.="<option value = '".$fila->codigo."'>".$fila->denominacion_cuenta."</option>";		
		}
		echo $option;
	}
	
	function guardaregresos()
	{
		if(1 == 1)
		{	
			if($this->input->get('accion')=='nuevo')  
			{	
				$tipo_transaccion = 'EG';	
				$correl = $this->ingresos_model->obtenercorrelativo();
				$correlativo = $correl[0]->maximo + 1;
				$log = $this->ingresos_model->insert_logs($id_usu = $this->session->userdata('id'),11);
				$beneficiario = 2;
				$ingreso = $this->ingresos_model->insert_ingresos_egresos(0,$correlativo,$this->input->get('cuenta'),$this->input->get('sub_cuenta'),$this->input->get('monto'),$this->input->get('fecha'),$this->input->get('tipocambio'),$this->input->get('docrespaldo'),'',$beneficiario,$this->input->get('descripcioningreso'),$tipo_transaccion,$log,0,$this->input->get('monto'),'PE');
				if($ingreso > 0)
				{
					echo "SE REALIZO EL REGISTRO CORRECTAMENTE";
				}
			}
			else
			{
				echo "SE REALIZO LA MODIFICACION CORRECTAMENTE";
			}
		}
		else
		{		
			redirect("inicio");
		}
	}

	/*AGREGAR CUENTAS DEBE*/
	function getcuentas_id()
	{
		$cuenta = $this->input->get('id');
		$filas = $this->ingresos_model->getcuentas_tabla_id();
		$option = "<option VALUE='-1'>Seleccionar cuenta</OPTION>";
		foreach ($filas as $fila) 
		{
			$option.="<option value = '".$fila->codigo."'>".$fila->denominacion_cuenta."</option>";		
		}
		echo $option;
	}
	function getsubcuenta_id()
	{
		$cuenta = $this->input->get('cue');
		$id_ingreso = $this->input->get('ing');
		$filas = $this->ingresos_model->getsubcuenta_tabla_id($cuenta,$id_ingreso);
		$option = "<option VALUE='-1'>Seleccionar sub cuenta</OPTION>";
		foreach ($filas as $fila) 
		{
			$option.="<option value = '".$fila->codigo."'>".$fila->denominacion_cuenta."</option>";		
		}
		echo $option;
	}
	function guardaregresodebe()
	{
		if(1 == 1)
		{	
			$ingreso = $this->ingresos_model->ingresos_id($this->input->get('id_ingreso'));
			if($this->input->get('accion')=='nuevo')  
			{	
				$log = $this->ingresos_model->insert_logs($this->session->userdata('id'),12);
				$tipo_transaccion = 'EG-CU';			
				$registro_ingreso = $this->ingresos_model->insert_ingresos_egresos($this->input->get('id_ingreso'),0,$this->input->get('cuentae'),$this->input->get('sub_cuentae'),$this->input->get('monto_egreso'),$ingreso[0]->fecha,$ingreso[0]->tipo_cambio,$ingreso[0]->documento_respaldo,$this->input->get('cheque'),$ingreso[0]->idcb_beneficiario,$ingreso[0]->descripcion_transaccion,$tipo_transaccion,$log,0,0,'AC');
				if($registro_ingreso > 0)
				{
					$saldo = $ingreso[0]->saldo_debe - $this->input->get('monto_egreso');
					$cantidad = $ingreso[0]->cantidad_cuentas_egreso + 1;
					if($saldo == 0)
					{
						$estado = 'LI';
					}
					else 
					{
						$estado = 'PE';
					}
					$ingreso = $this->ingresos_model->actualizarsaldoestado($this->input->get('id_ingreso'),$saldo,$cantidad,$estado);
				}
				echo "SE REALIZO EL REGISTRO CORRECTAMENTE";
			}
			else
			{
				echo "SE REALIZO LA MODIFICACION CORRECTAMENTE";
			}
		}
		else
		{		
			redirect("inicio");
		}
	}
	function disponibilidad()
	{
		$id_ingreso = $this->input->get('cue');		
		$ingre = $this->egresos_model->get_ingreso_subcuenta_id($id_ingreso);
		$egre = $this->egresos_model->get_egreso_subcuenta_id($id_ingreso);
		$ingreso = $ingre[0]->ingreso;
		$egreso = $egre[0]->egreso;
		
		echo $ingreso-$egreso;		
	}
	function disponibilidad_liquidez()
	{
		$id_ingreso = $this->input->get('cue');		
		//$id_ingreso = 5;		
		$ingre = $this->egresos_model->get_ingreso_subcuenta_id_liquidez($id_ingreso);
		$egre = $this->egresos_model->get_egreso_subcuenta_id_liquidez($id_ingreso);
		$ingreso = $ingre[0]->ingreso;
		$egreso = $egre[0]->egreso;
		
		echo $ingreso-$egreso;		
	}

	

	
}
?>