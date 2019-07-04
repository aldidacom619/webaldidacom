<?php 
class Usuarios extends CI_Controller 
{
	function __construct(){
		parent::__construct();   

			//$this->load->model('usuarios_model');
    		//$this->load->library('My_PHPMailer');
    		$this->load->helper(array('form', 'url'));
    	
			$this->load->library('form_validation');
		
	}

	function index()
	{	
		$this->load->view("Usuario/logued");        
	}
	function logued() 
	{	
		$username = $this->input->post('username');
		$password =  ($this->input->post('pass'));

		//echo $username." - ".$password;
		redirect("inicio");
		/*$fecha = date('Y-m-j H:i:s');
		$nuevafecha = strtotime ( '-4 hour' , strtotime ( $fecha ) ) ;
		$fecha = date ( 'Y-m-j' , $nuevafecha );
		$username = $this->input->post('username');
		$password = md5($this->input->post('pass'));
		$login = $this->usuarios_model->loguear($username, $password);
		if($login)
		{
			if( $login[0]->estado_user == 't')
			{
				$data = array(
					'is_logued_in'  => TRUE,
					'id_user' => $login[0]->id_user,
					'estado' => $login[0]->estado_user,
					'user' => $login[0]->username,
					'tipo' => $login[0]->tipo_user, 	
					'nombre' => $login[0]->nombres." ".$login[0]->apellido_paterno." ".$login[0]->apellido_materno,
					'menu' => "menu".$login[0]->tipo_user,				
				); 
				$this->session->set_userdata($data);
				$estado = $this->usuarios_model->actualizarprestamos($fecha);
				redirect("inicio");
			}
			else
			{
					$error ="El usuario ha sido dado de baja del sistema consulte con el administrador del sistema";
					$this->index($error);
			}		
		}		
		else 
		{
			$this->index('EL NOMBRE O CONTRASEÑA INCORRECTO');
		}*/		
	}
	function salir()
	{
		$this->session->sess_destroy();
		redirect('Usuarios');
	}
}

?>