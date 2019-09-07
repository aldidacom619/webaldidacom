<?php
class Reportes_ingresos extends CI_Controller
{
    	function __construct(){
    		parent::__construct();
    		$this->_is_logued_in();

    		$this->load->model('roles_model');
			$this->load->model('ingresos_model');
            $this->load->model('Cuentas_model');
            $this->load->model('Beneficiarios_model');
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
        function numerocomprobante($numero)
        {
            if($numero < 10)
            {
                $comprobante = "000".$numero;   
            }
            else
            {
                if($numero < 100)
                {
                    $comprobante = "00".$numero;    
                }
                else
                {
                    if($numero < 1000)
                    {
                        $comprobante = "0".$numero; 
                    }
                    else
                    {
                        $comprobante = $numero;     
                    }       
                }
            }
            return $comprobante;
        } 
        function cuentas_denominacion($idcuenta)
        {
          $cuenta = $this->Cuentas_model->get_cuentas($idcuenta);
          $denominacion = $cuenta[0]->denominacion_cuenta;
          return $denominacion;  
        } 
        function getbeneficiarios($id)
        {
          $cuenta = $this->Beneficiarios_model->get_beneficiario($id);
          $denominacion = $cuenta[0]->nombres;
          return $denominacion;  
        } 
        function comprobante($id)
        {
           
            $cambiar_estado = $this->ingresos_model->actualizarsaldoestado_terminado($id,'TE');
            $cambiar_estado_subcuentas = $this->ingresos_model->actualizarsaldoestado_terminado_subcuentas($id,'TE');
            $ingresos = $this->ingresos_model->ingresos_id($id);
            $egresos = $this->ingresos_model->ingresos_egresos_report_id($id);

           $tbl_fondoTitulos1 = array('height' => '10', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '','fillcolor' => '150,203,184', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
             $tbl_cuerpo = array('height' => '2', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo1 = array('height' => '4', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '9', 'font_style' => 'B', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo2 = array('height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo3 = array('height' => '5', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo4 = array('height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
            $tbl_cuerpo5 = array('height' => '20', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '7', 'font_style' => '', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.2', 'linearea' => 'LTBR');
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
            $col1[] = array_merge(array('text' => utf8_decode($ingresos[0]->fecha), 'width' => 33, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas1[] = $col1;
            unset($col1); 
             if(1 == 1)
            {$moneda = "Bolivianos";}else
            {$moneda = "Dolares"; }

            $col1[] = array_merge(array('text' => utf8_decode('MONEDA:'), 'width' => 20, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode($moneda), 'width' => 34, 'fillcolor' => $col_color),$tbl_trasparente2);
            $col1[] = array_merge(array('text' => utf8_decode('TIPO DE CAMBIO:'), 'width' => 34, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode($ingresos[0]->tipo_cambio), 'width' => 10, 'fillcolor' => $col_color),$tbl_trasparente2);
            $col1[] = array_merge(array('text' => utf8_decode('DOCUMENTO DE RESPALDO:'), 'width' => 46, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode($ingresos[0]->documento_respaldo), 'width' => 52, 'fillcolor' => $col_color),$tbl_trasparente2);
            $columnas1[] = $col1;
             unset($col1); 
             $col1[] = array_merge(array('text' => utf8_decode('NRO.:'), 'width' => 20, 'fillcolor' => $col_color),$tbl_trasparente1);
            $col1[] = array_merge(array('text' => utf8_decode($this->numerocomprobante($ingresos[0]->correlativo)), 'width' => 110, 'fillcolor' => $col_color),$tbl_trasparente2); 
            $columnas1[] = $col1;
            unset($col1); 

            

            $col1[] = array_merge(array('text' => utf8_decode('CODIGO CONTABLE'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col1[] = array_merge(array('text' => utf8_decode("NUMERO DE CHEQUE "), 'width' => 30, 'fillcolor' => $col_color),$tbl_cuerpo1); 
            $col1[] = array_merge(array('text' => utf8_decode('DESCRIPCION DE LAS CUENTAS:'), 'width' => 63, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col1[] = array_merge(array('text' => utf8_decode('D H'), 'width' => 5, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col1[] = array_merge(array('text' => utf8_decode('PARCIALES'), 'width' => 33, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col1[] = array_merge(array('text' => utf8_decode('DEBE'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col1[] = array_merge(array('text' => utf8_decode('HABER'), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo1);
            
            $columnas1[] = $col1;
            unset($col1); 
             $col1[] = array_merge(array('text' => utf8_decode($ingresos[0]->cuenta_2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo2);
            $col1[] = array_merge(array('text' => utf8_decode($ingresos[0]->numero_cheque), 'width' => 30, 'fillcolor' => $col_color),$tbl_cuerpo2); 
            $col1[] = array_merge(array('text' => utf8_decode($this->cuentas_denominacion($ingresos[0]->cuenta_1)." - ".$this->cuentas_denominacion($ingresos[0]->cuenta_2)), 'width' => 63, 'fillcolor' => $col_color),$tbl_cuerpo4);
            $col1[] = array_merge(array('text' => utf8_decode('D D'), 'width' => 5, 'fillcolor' => $col_color),$tbl_cuerpo2);
            $col1[] = array_merge(array('text' => number_format($ingresos[0]->monto,2), 'width' => 33, 'fillcolor' => $col_color),$tbl_cuerpo3);
            $col1[] = array_merge(array('text' => number_format($ingresos[0]->monto,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
            $col1[] = array_merge(array('text' => utf8_decode(''), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo2);
            
            $columnas1[] = $col1;
            $suma = 0;
            foreach($egresos as $valor)
            {
                unset($col1); 
                $col1[] = array_merge(array('text' => utf8_decode($valor->cuenta_2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo2);
                $col1[] = array_merge(array('text' => utf8_decode($valor->numero_cheque), 'width' => 30, 'fillcolor' => $col_color),$tbl_cuerpo2); 
                $col1[] = array_merge(array('text' => utf8_decode($this->cuentas_denominacion($valor->cuenta_1)." - ".$this->cuentas_denominacion($valor->cuenta_2)), 'width' => 63, 'fillcolor' => $col_color),$tbl_cuerpo4);
                $col1[] = array_merge(array('text' => utf8_decode('H H'), 'width' => 5, 'fillcolor' => $col_color),$tbl_cuerpo2);
                $col1[] = array_merge(array('text' => number_format($valor->monto,2), 'width' => 33, 'fillcolor' => $col_color),$tbl_cuerpo3);
                
                $col1[] = array_merge(array('text' => utf8_decode(''), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo2);
                $col1[] = array_merge(array('text' => number_format($valor->monto,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
                $columnas1[] = $col1;
                $suma = $suma + $valor->monto;
            } 
            unset($col1); 
             
            $col1[] = array_merge(array('text' => utf8_decode('TOTALES'), 'width' => 151, 'fillcolor' => $col_color),$tbl_cuerpo1);
            $col1[] = array_merge(array('text' => number_format($ingresos[0]->monto,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
            $col1[] = array_merge(array('text' => number_format($suma,2), 'width' => 20, 'fillcolor' => $col_color),$tbl_cuerpo3);
            
            $columnas1[] = $col1;
             
            unset($col1); 
             
            $col1[] = array_merge(array('text' => utf8_decode('Beneficiario:'.$this->getbeneficiarios($ingresos[0]->idcb_beneficiario)), 'width' => 96, 'fillcolor' => $col_color),$tbl_cuerpo4);
            $col1[] = array_merge(array('text' => utf8_decode('Descripción de la Transacción:'.$ingresos[0]->descripcion_transaccion), 'width' => 95, 'fillcolor' => $col_color),$tbl_cuerpo4);
            $columnas1[] = $col1;
            unset($col1); 
             
            $col1[] = array_merge(array('text' => utf8_decode('ELABORADOR POR:               '), 'width' => 39, 'fillcolor' => $col_color),$tbl_cuerpo5);
            $col1[] = array_merge(array('text' => utf8_decode('REVISADO POR:               '), 'width' => 38, 'fillcolor' => $col_color),$tbl_cuerpo5);
            $col1[] = array_merge(array('text' => utf8_decode('APROBADO POR:               '), 'width' => 38, 'fillcolor' => $col_color),$tbl_cuerpo5);
            $col1[] = array_merge(array('text' => utf8_decode('APROBADO POR:               '), 'width' => 38, 'fillcolor' => $col_color),$tbl_cuerpo5);
            $col1[] = array_merge(array('text' => utf8_decode('APROBADO POR:               '), 'width' => 38, 'fillcolor' => $col_color),$tbl_cuerpo5);
            $columnas1[] = $col1;

            
            $this->fpdf->Line(20, 120, 200, 120);
             $this->fpdf->WriteTable($columnas1); 
             $this->fpdf->Ln(25);
           // $this->fpdf->WriteTable($columnas2);

         /*    $this->fpdf->Ln(25);
            $this->fpdf->WriteTable($columnas3);
      $this->fpdf->Ln(25);
            $this->fpdf->WriteTable($columnas4);*/

            
            $this->fpdf->Output();
        }
		
       
		
		
}
?>