<?php

class Inicio extends CI_Controller
{
	function __construct(){
		parent::__construct();	
		$this->_is_logued_in();	
		$this->load->model('roles_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
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
		$dato['usuario'] = $this->session->userdata('usuario');
		$dato['rolescero'] = $this->roles_model->obtener_roles_cero($id_usu);
		$dato['roles'] = $this->roles_model->obtener_roles($id_usu);
		$this->load->view("Inicio/cabecera");		
		$this->load->view("Inicio/menu",$dato);		
		$this->load->view("Inicio/cuerpo");		
		$this->load->view("Inicio/pie");
	}
	function prueba()
	{
		echo "prueba uno";
	}
}
?>