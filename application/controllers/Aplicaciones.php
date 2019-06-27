<?php

class Aplicaciones extends CI_Controller
{
	function __construct(){
		parent::__construct();		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	/*function _is_logued_in()
	{
		$is_logued_in = $this->session->userdata('is_logued_in'); 
		if($is_logued_in != TRUE)
		{
			//echo $is_logued_in;
			redirect('usuarios');
		}	
	}*/
	function index() 
	{
		$this->load->view("Inicio/cabecera");		
		$this->load->view("Inicio/menu");		
		echo "registro aplicaciones";
		$this->load->view("Inicio/pie");
	}
}
?>