<?php

class Imprimir_reportes extends CI_Controller
{
	function __construct(){
		parent::__construct();	
		$this->_is_logued_in();	
    	$this->load->model('roles_model');
    	$this->load->model('reportes_model');	
		$this->load->model('ingresos_model');
		$this->load->model('Cuentas_model');
		$this->load->model('Beneficiarios_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pdf2');
    	$this->load->helper('download');
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
		echo "<h3>Acceso Restringido</h3>";
	}
	
	function imprimirporcuentas($subcuenta)
	{
		//echo $subcuenta;
		 $col_color = "255,255,255";
		  $tbl_cuerpo1 = array('height' => '4', 'align' => 'J', 'font_name' => 'Times', 'font_size' => '6', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
		    $datos =  $this->reportes_model->reportecuentas();
            $id = $this->session->userdata('id_per'); 
            $pdf = new Pdf2();
            $fecha_hoy = $pdf->fechacompleta();
            $fecha = date('Y-m-j H:i:s');
            $nuevafecha = strtotime ( 'hour' , strtotime ( $fecha ) ) ;
            $hora = date ( 'H:i:s' , $nuevafecha );
            $pdf->fecha = "Fecha Impresion:".$fecha_hoy ." Hrs:".$hora; 
            $pdf->xheader = 40;
            $pdf->yheader = 8;
            $pdf->cabecera = 2;
            $columnas3 = array();
            $col3 = array();
            $sum = 0;
            $sum2 = 0;           
            $pdf->titulo = "REPORTE DE INGRESOS Y EGRESOS";
            $pdf->titulo1 = "";
            $pdf->moneda = "Bolivianos";            
            $pdf->AliasNbPages();
	        $pdf->SetAutoPageBreak(true, 40); 
	        $pdf->SetFont('Arial', 'B', 8);
	        $encabezados = array(
	            'Nro',
	            'Fecha',
	            'CTA.', 
	            'CHEQUE',
	            'DESCRIPCION',
	            'DEBITO',
	            'CREDITO',
	            'SALDO'
	        );
	        $w = array(8,15,11,20,85,20,20,20);
	        foreach ($encabezados as $val){
	            $encabezados_[] = iconv('UTF-8', 'windows-1252', $val);
	        }
	        $pdf->subTituloBotoom = "RUBRO INMUEBLES";
	        $pdf->setEncabezadoG($encabezados_);
	        $pdf->setWidthsG($w);
	        $columnas1 = array();
            $col1 = array();
            $pdf->AddPage('P','Letter',null,null);//CREACION DE PAGINA
            $num = 1;
            $con = 1;
            $saldo = 0;
	        $pdf->SetFont('Arial', '', 7);
	        $pdf->SetAligns(array('C','C','C','R','L','R','R','R')); //ALINEACION DE LAS COLUMNAS DE MIERDA
	        $pdf->SetFillColor(0);
	        $pdf->SetFillColor(255, 255, 255);
        	$pdf->SetTextColor(0);
        	
	        $pdf->SetDrawColor(255,255,255);
	        if(!empty($datos))
	        {
	            while ( $con <= 1) {
	            	foreach($datos as $valor)
		            {
		                 

		                 
		                 if($valor->tipo_transaccion == 'IN'|| $valor->tipo_transaccion =='IN-CU')
		                 { 
		                 	$debito = 0;
		                 	$credito = $valor->monto;
		                 	$saldo = $saldo + $valor->monto;
		                 	

		                 }else
		                 {
		                 	$debito = $valor->monto;
		                 	$credito = 0;
		                 	$saldo = $saldo - $valor->monto;
		                 	
		                 }
		                 if ($num == 1)
			                {
			                  $saldo= $valor->monto;
			                }
		                 $s = array(
		                    $num++,
		                    iconv('UTF-8', 'windows-1252', $valor->fecha),
		                    iconv('UTF-8', 'windows-1252', $valor->cuenta_1."-".$valor->cuenta_2),
		                    iconv('UTF-8', 'windows-1252', $valor->numero_cheque),
		                    iconv('UTF-8', 'windows-1252', substr($valor->descricpion_registro, 0, 56)),
		                    number_format($debito,2),	
		                    number_format($credito,2),	
		                    number_format($saldo,2),
		                 
		                    	                    

		                );
		                 $pdf->Row($s, true, '', 3);	   

		                 
		            }
		            $con++;
		           
	            }
	            

	        }
          // $pdf->WriteTable($columnas1); 
            
            // $this->fpdf->Line(20, 120, 200, 120);
            //$this->fpdf->WriteTable($columnas1); 
             $pdf->Ln(5);
           // $this->fpdf->WriteTable($columnas2);

         /*    $this->fpdf->Ln(25);
            $this->fpdf->WriteTable($columnas3);
      $this->fpdf->Ln(25);
            $this->fpdf->WriteTable($columnas4);*/

            
            $pdf->Output();
	}
	
}
?>