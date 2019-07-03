<?php 
class Usuarios extends CI_Controller 
{
	function __construct(){
		parent::__construct();   

			$this->load->model('usuarios_model');
    		//$this->load->library('My_PHPMailer');
    		$this->load->helper(array('form', 'url'));
    	
			$this->load->library('form_validation');
		
	}

	function index($mensaje = "")
	{	
		$dato['error'] =$mensaje;
		$this->load->view("Usuario/logued",$dato);        
	}
	function logued() 
	{	
		$username = strtoupper($this->input->post('username'));
		$password =  md5("aldidacom".($this->input->post('pass')));
		//echo $username." - ".$password;
		$login = $this->usuarios_model->loguear($username, $password);
		if($login)
		{
			//echo $login[0]->estado;
			if( $login[0]->estado == 'AC')
			{
				$data = array(
					'is_logued_in'  => TRUE,
					'id' => $login[0]->id,
					'codad_aplicacion' => $login[0]->codad_aplicacion,
					'nombres' => $login[0]->nombres,
					'apellidos' => $login[0]->apellidos,
					'nro_documento' => $login[0]->nro_documento,
					'tipo_documento' => $login[0]->tipo_documento,
					'idad_logs' => $login[0]->idad_logs,
					'direccion' => $login[0]->direccion,
					'tel_cel' => $login[0]->tel_cel,
					'fecha_nacimiento' => $login[0]->fecha_nacimiento,
					'correo' => $login[0]->correo,
					'cargo' => $login[0]->cargo,
					'login' => $login[0]->login,
					'clave' => $login[0]->clave,
					'tipo_user' => $login[0]->tipo_user,
					'estado' => $login[0]->estado,
					'usuario' => $login[0]->nombres." ".$login[0]->apellidos
									
				); 
				$this->session->set_userdata($data);				
				redirect("inicio");
			}
			else
			{
				$mensaje ="El usuario no se encuentra habilitado contactece con el administrador";
				$this->index($mensaje);
			}		
		}		
		else 
		{
			$this->index('EL NOMBRE O CONTRASEÑA INCORRECTO');
		}	
	}
	/*//redirect("inicio");
		/*$fecha = date('Y-m-j H:i:s');
		$nuevafecha = strtotime ( '-4 hour' , strtotime ( $fecha ) ) ;
		$fecha = date ( 'Y-m-j' , $nuevafecha );
		$username = $this->input->post('username');
		$password = md5($this->input->post('pass'));
		$login = $this->usuarios_model->loguear($username, $password);
		*/
	function salir()
	{
		$this->session->sess_destroy();
		redirect('Usuarios');
	}
}

?>