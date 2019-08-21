<?php
class Reportesingresos extends CI_Controller
{
    	function __construct(){
    		parent::__construct();
    		$this->_is_logued_in();

    		$this->load->model('roles_model');
			$this->load->model('ingresos_model');
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			//$this->load->helper('Menu_helper');
			
			$this->load->helper('date');
			
			$this->load->library('pdf2');
    		$this->load->helper('download');
			$this->load->helper('date'); 
			//$this->load->helper('cuentas_helper');

    	}
		function _is_logued_in()
        {
            $is_logued_in = $this->session->userdata('is_logued_in'); 
            if($is_logued_in != TRUE)
            {
                //echo $is_logued_in;
                redirect('usuarios');
            }   
        }
		function index() 
        {
            $this->load->view("inicio/cabecera");
            $this->load->view("inicio/menu");
            $this->load->view("inicio/cuerpo");
            $this->load->view("inicio/pie");
        }
        function comprobante2($id)
        {
        	echo $id;
        }
        function comprobante($id)
        {
           
            $ingresos = $this->ingresos_model->ingresos_id($id);
			$egresos = $this->ingresos_model->ingresos_egresos_id($id);

           $tbl_fondoTitulos1 = array('height' => '10', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '150,203,184', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
             $tbl_cuerpo = array('height' => '3', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo1 = array('height' => '7', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo2 = array('height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo3 = array('height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo4 = array('height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $col_color = "255,255,255";
            $tbl_trasparente1 = array('height' => '7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente2 = array('height' => '7', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente3 = array('height' => '7', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente4 = array('height' => '7', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente5 = array('height' => '7', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente6 = array('height' => '7', 'align' => 'C', 'font_name' => 'Times', 'font_size' => '15', 'font_style' => 'B','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_trasparente7 = array('height' => '7', 'align' => 'C', 'font_name' => 'Times', 'font_size' => '13', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_firmas = array('height' => '6', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '255,255,255', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $col_color = "255,255,255";


            $tiporeporte = "KARDEX INDIVIDUAL";
            $id = $this->session->userdata('id_per');
            $this->fpdf = new Pdf2();
            $fecha_hoy = $this->fpdf->fechacompleta();
            $fecha = date('Y-m-j H:i:s');
            $nuevafecha = strtotime ( 'hour' , strtotime ( $fecha ) ) ;
            $hora = date ( 'H:i:s' , $nuevafecha );
            $this->fpdf->fecha = "Fecha Impresion:  ".$fecha_hoy ." Hrs:".$hora; 
            $this->fpdf->xheader = 40;
            $this->fpdf->yheader = 8;
            $this->fpdf->cabecera = 1;
            $columnas3 = array();
            $col3 = array();
            $sum = 0;
            $sum2 = 0;           
            $this->fpdf->titulo = "COMPROBANTE DE CONTABILIDAD";
            $this->fpdf->titulo1 = "";
            $this->fpdf->moneda = "Bolivianos";            
            $this->fpdf->AddPage('P','Letter',null,null);//CREACION DE PAGINA
           
            $col1[] = array_merge(array('text' => utf8_decode('ENTIDAD:'), 'width' => 20, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode("DEFENSORIA DEL PUEBLO "), 'width' => 110, 'fillcolor' => $col_color),$tbl_trasparente2); 
            $col1[] = array_merge(array('text' => utf8_decode('FECHA DE INGRESO:'), 'width' => 33, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode("02/08/2019"), 'width' => 33, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas1[] = $col1;
            unset($col1); 
			 if(1 == 1)
            {$moneda = "Bolivianos";}else
            {$moneda = "Dolares"; }

            $col1[] = array_merge(array('text' => utf8_decode('MONEDA:'), 'width' => 20, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode($moneda), 'width' => 34, 'fillcolor' => $col_color),$tbl_trasparente2);
            $col1[] = array_merge(array('text' => utf8_decode('TIPO DE CAMBIO:'), 'width' => 34, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode("6.97"), 'width' => 10, 'fillcolor' => $col_color),$tbl_trasparente2);
            $col1[] = array_merge(array('text' => utf8_decode('DOCUMENTO DE RESPALDO:'), 'width' => 46, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode("Deposito Bancario"), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas1[] = $col1;
             unset($col1); 
             $col1[] = array_merge(array('text' => utf8_decode('NRO.:'), 'width' => 20, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode("00001"), 'width' => 110, 'fillcolor' => $col_color),$tbl_trasparente2); 
            $columnas1[] = $col1;
           
/*
            $col2[] = array_merge(array('text' => utf8_decode('RECIBI CONFORME:'.nombre_usuario($kardex[0]->usuario)), 'width' => 96, 'fillcolor' => $col_color),$tbl_trasparente5);
            
             $col2[] = array_merge(array('text' => utf8_decode('ENTREGUE CONFORME:'.nombre_prestatario($kardex[0]->persona)), 'width' => 96, 'fillcolor' => $col_color),$tbl_trasparente5);
            
            $columnas2[] = $col2;
            


            $col3[] = array_merge(array('text' => utf8_decode('EMPRESA DE PRESTAMOS FINANCYATE'), 'width' => 192, 'fillcolor' => $col_color),$tbl_trasparente6);
             $columnas3[] = $col3;
             unset($col3); 
             $col3[] = array_merge(array('text' => utf8_decode('RECIBO DE PAGOS (Copia)'), 'width' => 192, 'fillcolor' => $col_color),$tbl_trasparente6);
              $columnas3[] = $col3;
             unset($col3); 
             $col3[] = array_merge(array('text' => utf8_decode('FECHA ACTUAL:'.$fecha_hoy." Hrs:".$hora ), 'width' => 192, 'fillcolor' => $col_color),$tbl_trasparente7);
             $columnas3[] = $col3;
             unset($col3); 



              $col3[] = array_merge(array('text' => utf8_decode('NUMERO DE RECIBO:'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->correlativo."/".$kardex[0]->gestion), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2); 
            $col3[] = array_merge(array('text' => utf8_decode('FECHA DE PAGO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->fecha_pago), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas3[] = $col3;
            unset($col3); 

            $col3[] = array_merge(array('text' => utf8_decode('NOMBRE PRESTATARIO:'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode(nombre_prestatario($kardex[0]->persona)), 'width' => 120, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas3[] = $col3;
            unset($col3); 

            $col3[] = array_merge(array('text' => utf8_decode('MONTO DE PAGO:'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            if($kardex[0]->tipo_moneda == 1)
            {$moneda = "Bolivianos";  $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->montobs.".-"), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);}else
            {$moneda = "Dolares"; $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->monto.".-"), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);}

            $col3[] = array_merge(array('text' => utf8_decode('NRO DE AMORTIZACION:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->nropago." AMORTIZACION"), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas3[] = $col3;
            unset($col3);
            $col3[] = array_merge(array('text' => utf8_decode('TIPO DE MONEDA:'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($moneda), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);
             $col3[] = array_merge(array('text' => utf8_decode('TIPO DE CAMBIO:'), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->tipocambio), 'width' => 48, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas3[] = $col3;
             unset($col3); 

             $col3[] = array_merge(array('text' => utf8_decode('POR CONCEPTO DE :'), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col3[] = array_merge(array('text' => utf8_decode($kardex[0]->concepto_pago), 'width' => 120, 'fillcolor' => $col_color),$tbl_trasparente2);
             $columnas3[] = $col3;
             

            $col4[] = array_merge(array('text' => utf8_decode('RECIBI CONFORME:'.nombre_usuario($kardex[0]->usuario)), 'width' => 96, 'fillcolor' => $col_color),$tbl_trasparente5);
            
             $col4[] = array_merge(array('text' => utf8_decode('ENTREGUE CONFORME:'.nombre_prestatario($kardex[0]->persona)), 'width' => 96, 'fillcolor' => $col_color),$tbl_trasparente5);
            
            $columnas4[] = $col4;


*/
            
      $this->fpdf->Line(20, 120, 200, 120);
             $this->fpdf->WriteTable($columnas1); 
             $this->fpdf->Ln(25);
            /*$this->fpdf->WriteTable($columnas2);

             $this->fpdf->Ln(25);
            $this->fpdf->WriteTable($columnas3);
      $this->fpdf->Ln(25);
            $this->fpdf->WriteTable($columnas4);*/

            
            $this->fpdf->Output();
        }
		
       
		
		
}
?>