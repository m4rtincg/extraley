<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'libraries/tcpdf/tcpdf.php';
class MyPdf3 extends TCPDF  {
	public $logo;
	public $datos;

	public function setData($logo){
		$this->logo = $logo;
	}

    public function Header() {
    	$extensionarray = array("png"=>"PNG","jpg"=>"JPG","jpeg"=>"JPG");
    	$partes_ruta = pathinfo($this->logo);
    	$typeImg = (isset($extensionarray[$partes_ruta['extension']]))? $extensionarray[$partes_ruta['extension']] :"PNG";
        $image_file = base_url()."assets/img/business/".$this->logo;
        $this->Image($image_file, 22, 6, '', 11, $typeImg, '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', '', 8);
        $this->setCellPaddings(0, 3.5, 0, 0);
        //$this->MultiCell(0,15,$this->datos,0,'R','','');
        $this->Ln();
        $htmlbar = '<hr style="width:172mm;">';
        $oldDrawColor = $this->DrawColor;
        $this->setDrawColor(0,0,0);
        //$this->MultiCell(0,0,$htmlbar,0,'L','',5,'',20,true,0,true,false,4,'T',false);
        //$this->MultiCell(0,15,date("m-d-Y"),0,'R','','');
        $this->DrawColor = $oldDrawColor;
    }
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', '', 8);
        //$this->Cell(0, 10, 'This report was produced by www.HispanicMarketAdvisors.com', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, $this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}

class Empleados extends CI_Controller {

	public function index(){
		if($this->session->userdata('session')){
			$this->load->model("business_model");
			$this->load->model("employee_model");

			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
			$dataHeader['modulo'] = 'pageEmpleados';
			$dataFooter['modulo'] = 'pageEmpleados';

			$this->load->view('template/header',$dataHeader);
			$this->load->view('empleados');
			$this->load->view('template/footer',$dataFooter);
        }else{
        	header('Location: '.base_url());
     	}
	}
	public function addemployees(){
		if($_POST and $this->session->userdata('session')){
			
			$nombres = trim($_POST['nombresEmployeeAdd']);
			$apellidos = trim($_POST['apellidosEmployeeAdd']);
			$dni = trim($_POST['dniEmployeeAdd']);
			$direccion = trim($_POST['direccionEmployeeAdd']);
			$email = trim($_POST['emailEmployeeAdd']);
			$telefono = trim($_POST['telefonoEmployeeAdd']);

			$id_business = $this->session->userdata('business');
			$this->load->model("employee_model");

			if(! $this->employee_model->comprobardniAdd($dni,$id_business)){

			   $add = $this->employee_model->insertEmployee($nombres,$apellidos,$dni,$direccion,$email,$telefono,$id_business);
			    if($add){
			    	echo json_encode(array("status"=>true));
			    }else{
			    	echo json_encode(array("status"=>false,"msg"=>"No se pudo registrar el empleado"));
			    }
					
			}else{
				echo json_encode(array("status"=>false,"msg"=>"Ese dni ya existe"));
			}
		}else{
        	header('Location: '.base_url());
     	}
	}


	public function editemployees(){
		if($_POST and $this->session->userdata('session')){
			$id = trim($_POST['idemployeeEdit']);
			$nombres = trim($_POST['nombresEmployeeEdit']);
			$apellidos = trim($_POST['apellidosEmployeeEdit']);
			$dni = trim($_POST['dniEmployeeEdit']);
			$direccion = trim($_POST['direccionEmployeeEdit']);
			$email = trim($_POST['emailEmployeeEdit']);
			$telefono = trim($_POST['telefonoEmployeeEdit']);
			
			$id_business = $this->session->userdata('business');
			$this->load->model("employee_model");

			if(! $this->employee_model->comprobardniEdit($id,$dni,$id_business)){

			   $add = $this->employee_model->editemployee($id,$nombres,$apellidos,$dni,$direccion,$email,$telefono);
			    if($add){
			    	echo json_encode(array("status"=>true));
			    }else{
			    	echo json_encode(array("status"=>true,"msg"=>"No se realizo  cambio en la bd"));
			    }
					
			}else{
				echo json_encode(array("status"=>false,"msg"=>"Ese dni ya existe"));
			}
		}else{
        	header('Location: '.base_url());
     	}
	}

	public function selectAllEmployee()
	{
		if($this->session->userdata('session')){
			$this->load->model("employee_model");
			$rows = $this->employee_model->selectByAll($this->session->userdata('business'));
			echo json_encode(array("status"=>true,"datos"=>$rows));
		}else{
        	header('Location: '.base_url());
     	}
	}

	public function changestatus()
	{
		if($_POST and $this->session->userdata('session')){
			$id = trim($_POST['id']);
			$status = trim($_POST['status']);

			$this->load->model("employee_model");

			   $add = $this->employee_model->deleteemployee($id,$status);
			    if($add){
			    	echo json_encode(array("status"=>true,"msg"=>"Se ha cambiado de estado correctamente."));
			    }else{
			    	echo json_encode(array("status"=>false,"msg"=>"No se pudo cambiar el estado"));
			    }
				
		}else{
        	header('Location: '.base_url());
     	}
	}

	public function selectEmployee()
	{
		if($this->session->userdata('session')){
			$id = trim($_POST['id']);

			$this->load->model("employee_model");
			$rows = $this->employee_model->selectById($id);
			if($rows){
			echo json_encode(array("status"=>true,"datos"=>$rows));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se encontro ese empleado"));
			}
		}else{
        	header('Location: '.base_url());
     	}
    }

    //Baja
    public function selectBaja()
	{
		if($this->session->userdata('session')){
			$id = trim($_POST['id']);

			$this->load->model("employee_model");
			$rows = $this->employee_model->selectBajaById($id);
			if($rows){
			echo json_encode(array("status"=>true,"datos"=>$rows));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se encontro esa baja."));
			}
		}else{
        	header('Location: '.base_url());
     	}
    }
    public function cancelarBaja()
	{
		if($this->session->userdata('session')){
			$id = trim($_POST['id']);

			$this->load->model("employee_model");
			$rows = $this->employee_model->deletebaja($id);
			if($rows){
			echo json_encode(array("status"=>true,"datos"=>$rows));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo cancelar."));
			}
		}else{
        	header('Location: '.base_url());
     	}
    }
    public function updateBaja()
	{
		if($this->session->userdata('session')){
			$id = trim($_POST['bajaempleadoedit']);
			$banco = trim($_POST['bajabancoEdit']);
			$fecha_culminacion = trim($_POST['bajafechaculminacionEdit']);
			$cuenta = trim($_POST['bajacuentaEdit']);
			$lugar1 = trim($_POST['bajalugar1Edit']);
			$fecha1 = trim($_POST['bajafecha1Edit']);
			$fecha_inicio = trim($_POST['bajafechainicioEdit']);
			//$fecha_fin = trim($_POST['bajafechafinEdit']);
			$lugar2 = trim($_POST['bajalugar2Edit']);
			$fecha2 = trim($_POST['bajafecha2Edit']);

			$fecha_culminacionarray = explode("/", $fecha_culminacion);
			$fecha1array = explode("/", $fecha1);
			$fecha_inicioarray = explode("/", $fecha_inicio);
			$fecha_finarray = explode("/", $fecha_fin);
			$fecha2array = explode("/", $fecha2);

			$fecha_culminacion = $fecha_culminacionarray[2]."-".$fecha_culminacionarray[1]."-".$fecha_culminacionarray[0];
			$fecha1 = $fecha1array[2]."-".$fecha1array[1]."-".$fecha1array[0];
			$fecha_inicio = $fecha_inicioarray[2]."-".$fecha_inicioarray[1]."-".$fecha_inicioarray[0];
			//$fecha_fin = $fecha_finarray[2]."-".$fecha_finarray[1]."-".$fecha_finarray[0];
			$fecha2 = $fecha2array[2]."-".$fecha2array[1]."-".$fecha2array[0];

			$this->load->model("employee_model");
			$rows = $this->employee_model->updatebaja($id,$banco,$fecha_culminacion,$cuenta,$lugar1,$fecha1,$fecha_inicio,$fecha_fin,$lugar2,$fecha2);
			if($rows){
			echo json_encode(array("status"=>true,"datos"=>$rows));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se encontro ese usuario"));
			}
		}else{
        	header('Location: '.base_url());
     	}
    }
    public function addBaja()
	{
		if($this->session->userdata('session')){
			$id = trim($_POST['bajaempleadoadd']);
			$banco = trim($_POST['bajabancoAdd']);
			$fecha_culminacion = trim($_POST['bajafechaculminacionAdd']);
			$cuenta = trim($_POST['bajacuentaAdd']);
			$lugar1 = trim($_POST['bajalugar1Add']);
			$fecha1 = trim($_POST['bajafecha1Add']);
			$fecha_inicio = trim($_POST['bajafechainicioAdd']);
			//$fecha_fin = trim($_POST['bajafechafinAdd']);
			$lugar2 = trim($_POST['bajalugar2Add']);
			$fecha2 = trim($_POST['bajafecha2Add']);
			$bajapuestoAdd = trim($_POST['bajapuestoAdd']);

			$fecha_culminacionarray = explode("/", $fecha_culminacion);
			$fecha1array = explode("/", $fecha1);
			$fecha_inicioarray = explode("/", $fecha_inicio);
			//$fecha_finarray = explode("/", $fecha_fin);
			$fecha2array = explode("/", $fecha2);

			$fecha_culminacion = $fecha_culminacionarray[2]."-".$fecha_culminacionarray[1]."-".$fecha_culminacionarray[0];
			$fecha1 = $fecha1array[2]."-".$fecha1array[1]."-".$fecha1array[0];
			$fecha_inicio = $fecha_inicioarray[2]."-".$fecha_inicioarray[1]."-".$fecha_inicioarray[0];
			//$fecha_fin = $fecha_finarray[2]."-".$fecha_finarray[1]."-".$fecha_finarray[0];
			$fecha2 = $fecha2array[2]."-".$fecha2array[1]."-".$fecha2array[0];

			$this->load->model("employee_model");
			$rows = $this->employee_model->insertbaja($id,$banco,$fecha_culminacion,$cuenta,$lugar1,$fecha1,$fecha_inicio,$bajapuestoAdd,$lugar2,$fecha2);
			if($rows){
			echo json_encode(array("status"=>true,"datos"=>$rows));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se encontro ese usuario"));
			}
		}else{
        	header('Location: '.base_url());
     	}
    }





    public function downloadPDFCese(){
		if($_GET){
			$id = trim($_GET['id']);
			$this->load->model("employee_model");


			$nombremes = array(
					    "01"=>"enero",
					    "02"=>"febrero",
					    "03"=>"marzo",
					    "04"=>"abril",
					    "05"=>"mayo",
					    "06"=>"junio",
					    "07"=>"julio",
					    "08"=>"agosto",
					    "09"=>"setiembre",
					    "10"=>"octubre",
					    "11"=>"noviembre",
					    "12"=>"diciembre"
					    );

			$datos = $this->employee_model->selectBajaByIdAll($id);
			

			/**/
			$message ='<h2 style="text-align:center;">CONSTANCIA DE CESE</h2>
<div><strong>Señores.-</strong></div>
<div>'.$datos->nombre_banco.'</div>
<div><strong>Asunto:</strong> Retiro de Compensación por Tiempo de Servicios (CTS)</div>
<div>De nuestra consideración,</div>
<div>Nos es grato dirigirnos a ustedes para comunicarle que el señor(a) '.strtoupper($datos->name_employee." ".$datos->lastname_employee).',
identificado con D.N.I. N° '.$datos->dni_employee.', ha dejado de laborar en nuestra empresa a partir del '."".date("d", strtotime($datos->fecha_culminacion))." de ".$nombremes[date("m", strtotime($datos->fecha_culminacion))]." del ".date("Y", strtotime($datos->fecha_culminacion)).'
; por lo que solicitamos se le haga entrega del total de la
Compensación por Tiempo de Servicios depositada en la Cuenta Bancaria N°
'.$datos->n_cuenta.' de vuestra entidad.
</div>
<div>Sin otro en particular, quedamos de ustedes</div>
<div>Suscrito en la ciudad de '.$datos->lugar_entrega_cese.', '.date("d", strtotime($datos->fecha_entrega_cese))." de ".$nombremes[date("m", strtotime($datos->fecha_entrega_cese))]." del ".date("Y", strtotime($datos->fecha_entrega_cese)).'.</div>';

			

			$pdf = new MyPdf3(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->setData($datos->logo);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Leandro Mendoza Martin Vladimir');
	        $pdf->SetTitle('Cese de trabajo');
	        $pdf->SetSubject('PDF cese de trabajo');
	        $pdf->SetKeywords('pdf, cese de trabajo');
	        $pdf->SetHeaderData(PDF_HEADER_LOGO,PDF_HEADER_LOGO_WIDTH,PDF_HEADER_TITLE,PDF_HEADER_STRING);
	        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
	        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_DATA));
	        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	        $pdf->SetMargins(20,PDF_MARGIN_TOP,20);
	        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	        $pdf->SetAutoPageBreak(TRUE,PDF_MARGIN_BOTTOM);
	        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	        $pdf->AddPage();
	        $pdf->SetFont('', '', 11);
	        $pdf->writeHTML($message,true,false,true,false,'');
			$pdf->Output('Constancia de cese.pdf', 'I');

		}else{
			echo json_encode(array("status"=>false,"msg"=>"Error en el envio de datos"));
		}
	}


	 public function downloadPDFConstancia(){
		if($_GET){
			$id = trim($_GET['id']);
			$this->load->model("employee_model");


			$nombremes = array(
					    "01"=>"enero",
					    "02"=>"febrero",
					    "03"=>"marzo",
					    "04"=>"abril",
					    "05"=>"mayo",
					    "06"=>"junio",
					    "07"=>"julio",
					    "08"=>"agosto",
					    "09"=>"setiembre",
					    "10"=>"octubre",
					    "11"=>"noviembre",
					    "12"=>"diciembre"
					    );

			$datos = $this->employee_model->selectBajaByIdAll($id);
			

			/**/
			$message ='<h2 style="text-align:center;"><u>CONSTANCIA DE TRABAJO</u></h2>
<div>El que suscribe, en representación de '.$datos->name_razonSocial.', con R.U.C. N º '.$datos->ruc.'. </div>

<div><strong style="text-align:center;">CERTIFICA:</strong></div>
<div>
	Que Don(ña), '.$datos->name_employee.' '.$datos->lastname_employee.', identificado con D.N.I. N° '.$datos->dni_employee.', ha trabajado en nuestra empresa, en el
puesto de trabajo de '.$datos->trabajo.'
desde el día '.date("d", strtotime($datos->fecha_inicio)).' del mes de '.$nombremes[date("m", strtotime($datos->fecha_inicio))].' del año '.date("Y", strtotime($datos->fecha_inicio)).' hasta el día '.date("d", strtotime($datos->fecha_culminacion)).' del mes de '.$nombremes[date("m", strtotime($datos->fecha_culminacion))].' del año '.date("Y", strtotime($datos->fecha_culminacion)).'
</div>
<div>Se expide el presente documento, de acuerdo a Ley, para los fines que el
interesado estime conveniente.</div>
<div>'.$datos->lugar_entrega_constancia.', '.date("d", strtotime($datos->fecha_entrega_constancia))." de ".$nombremes[date("m", strtotime($datos->fecha_entrega_constancia))]." del ".date("Y", strtotime($datos->fecha_entrega_constancia)).'.</div>';

			

			$pdf = new MyPdf3(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->setData($datos->logo);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Leandro Mendoza Martin Vladimir');
	        $pdf->SetTitle('Constancia de trabajo');
	        $pdf->SetSubject('PDF Constancia de trabajo');
	        $pdf->SetKeywords('pdf, Constancia de trabajo');
	        $pdf->SetHeaderData(PDF_HEADER_LOGO,PDF_HEADER_LOGO_WIDTH,PDF_HEADER_TITLE,PDF_HEADER_STRING);
	        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
	        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_DATA));
	        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	        $pdf->SetMargins(20,PDF_MARGIN_TOP,20);
	        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	        $pdf->SetAutoPageBreak(TRUE,PDF_MARGIN_BOTTOM);
	        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	        $pdf->AddPage();
	        $pdf->SetFont('', '', 11);
	        $pdf->writeHTML($message,true,false,true,false,'');
			$pdf->Output('Constancia de trabajo.pdf', 'I');

		}else{
			echo json_encode(array("status"=>false,"msg"=>"Error en el envio de datos"));
		}
	}


}