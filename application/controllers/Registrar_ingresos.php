<?php

class Registrar_ingresos extends CI_Controller
{
	function __construct(){
		parent::__construct();	
		$this->_is_logued_in();	
		$this->load->model('roles_model');
		$this->load->model('ingresos_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->helper('Menu_helper');
		$this->load->helper('cuentas_helper');
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
			$dato['ingresos'] = $this->ingresos_model->ingresos_pedientes();
			$this->load->view("Inicio/cabecera");
			$this->load->view("Inicio/cabecera");		
			$this->load->view("Inicio/menu",$dato);		
			$this->load->view("Ingresos/ingresos_pedientes",$dato);		
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
			$this->load->view("Ingresos/registrar_debe",$dato);		
			$this->load->view("Inicio/pie");
		}
		else{
			//$this->index();
			redirect("inicio");
		}
	}
	function nuevo_ingreso()
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
			$this->load->view("Ingresos/registrar_ingreso",$dato);		
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
	function guardaringresos()
	{
		if(1 == 1)
		{	
			if($this->input->get('accion')=='nuevo')  
			{	
				$tipo_transaccion = 'IN';			
				$correlativo = 2;
				$log = 11;
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
	function guardaregreso()
	{
		if(1 == 1)
		{	
			$ingreso = $this->ingresos_model->ingresos_id($this->input->get('id_ingreso'));
			if($this->input->get('accion')=='nuevo')  
			{	
				$tipo_transaccion = 'EG';			
				$registro_ingreso = $this->ingresos_model->insert_ingresos_egresos($this->input->get('id_ingreso'),0,$this->input->get('cuentae'),$this->input->get('sub_cuentae'),$this->input->get('monto_egreso'),$ingreso[0]->fecha,$ingreso[0]->tipo_cambio,$ingreso[0]->documento_respaldo,$ingreso[0]->numero_cheque,$ingreso[0]->idcb_beneficiario,$ingreso[0]->descripcion_transaccion,$tipo_transaccion,$ingreso[0]->idad_logs,0,0,'AC');
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

	
}
?>