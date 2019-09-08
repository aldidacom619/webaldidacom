<?php

class Reportes_otros extends CI_Controller
{
	function __construct(){
		parent::__construct();	
		$this->_is_logued_in();	
		$this->load->model('roles_model');
		$this->load->model('reportes_model');		
		
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
		$id_usu = $this->session->userdata('id');
		$dato['id_usu'] = $id_usu;
		$dato['usuario'] = $this->session->userdata('usuario');
		$dato['rolescero'] = $this->roles_model->obtener_roles_cero($id_usu);
		$dato['roles'] = $this->roles_model->obtener_roles($id_usu);
		$this->load->view("Inicio/cabecera");
		$this->load->view("Inicio/cabecera");		
		$this->load->view("Inicio/menu",$dato);		
		//$this->load->view("Inicio/cuerpo");		
		$this->load->view("Inicio/pie");
	}
	function reimpresioncomprobante()
	{
		$id_usu = $this->session->userdata('id');
		$dato['id_usu'] = $id_usu;
		$dato['usuario'] = $this->session->userdata('usuario');
		$dato['rolescero'] = $this->roles_model->obtener_roles_cero($id_usu);
		$dato['roles'] = $this->roles_model->obtener_roles($id_usu);
		$dato['ingresos'] = $this->reportes_model->ingresos_pedientes();
		$this->load->view("Inicio/cabecera");
		$this->load->view("Inicio/cabecera");		
		$this->load->view("Inicio/menu",$dato);		
		$this->load->view("reportes/reimpresion_reporte");		
		$this->load->view("Inicio/pie");
	}
	
}
?>