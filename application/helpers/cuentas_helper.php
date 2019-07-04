<?php 


 function cuentas_denominacion($idcuenta)
 {
  $fila =& get_instance();  
  $fila->load->model('Cuentas_model');
  $cuenta = $fila->Cuentas_model->get_cuentas($idcuenta);
  $nivel = $cuenta[0]->nivel;
  $denominacion = $cuenta[0]->denominacion_cuenta;
  return $denominacion;
  
 }
 ?> 






