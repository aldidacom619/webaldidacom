<?php 


 function rol_registrado($iduser, $codopcion)
 {
  $fila =& get_instance();  
  $fila->load->model('Roles_model');
  $rol = $fila->Roles_model->verificar_rol($iduser,$codopcion);
  //$rol = true;
  if($rol)
  {
    return true;
  }
  else
  {
    return false;
  }
 }
 ?> 






