<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'libraries/tcpdf/tcpdf.php';

class MyPdf3 extends TCPDF  {
	public $logo;
	public $datos;

	public function setData($logo, $datos){
		$this->logo = $logo;
		$this->datos = $datos;
	}

    public function Header() {
    	$extensionarray = array("png"=>"PNG","jpg"=>"JPG","jpeg"=>"JPG");
    	$partes_ruta = pathinfo($this->logo);
    	$typeImg = (isset($extensionarray[$partes_ruta['extension']]))? $extensionarray[$partes_ruta['extension']] :"PNG";
        $image_file = base_url()."assets/img/business/".$this->logo;
        $this->Image($image_file, 22, 6, '', 11, $typeImg, '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', '', 8);
        $this->setCellPaddings(0, 3.5, 0, 0);
        $this->MultiCell(0,15,$this->datos,0,'R','','');
        $this->Ln();
        $htmlbar = '<hr style="width:172mm;">';
        $oldDrawColor = $this->DrawColor;
        $this->setDrawColor(0,0,0);
        $this->MultiCell(0,0,$htmlbar,0,'L','',5,'',20,true,0,true,false,4,'T',false);
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

class Home extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('session')){
			$this->load->model("contract_model");
			$this->load->model("business_model");
			$this->load->model("contract_type_model");
			$data["typecontracts"] = $this->contract_type_model->selectAll();
			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
			$dataHeader["modulo"] = 'pagel';
			$this->load->view('template/header',$dataHeader);
			if($this->session->userdata('rol')==1){
				$data["contracts"] = $this->contract_model->selectAllContractUser($this->session->userdata('user'));
				$dataFooter["modulo"] = 'pageluser';
				$this->load->view('listacontratosuser',$data);
			}else if($this->session->userdata('rol')==2){
				$dataFooter["modulo"] = 'pagelgerente';
				$data["contracts"] = $this->contract_model->selectAllContractBusiness($this->session->userdata('business'));
				$this->load->view('listacontratosgerente',$data);
			}else{
				$dataFooter["modulo"] = 'pagel';
				$data["contracts"] = $this->contract_model->selectAllContract();
				$this->load->view('listacontratosadmin',$data);
			}
			$this->load->view('template/footer',$dataFooter);
        }else{
        	header('Location: '.base_url());
     	}
	}
	public function search_work(){
		if($_POST['q']){
			$this->load->model("work_model");
			$q = trim($_POST['q']);
			$type = trim($_POST['type']);

			$works = $this->work_model->searchByName($q, $type);
			if($works){
				echo json_encode(array("status"=>true,"datos"=>$works));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se encontraron resultados"));
			}

		}else{
			echo json_encode(array("status"=>false,"msg"=>"Error en el envio de datos"));
		}
	}
	public function add_work(){
		if($_POST['name']){
			$this->load->model("work_model");
			$name = trim($_POST['name']);
			$description = trim($_POST['description']);
			
			$verificar = $this->work_model->selectByName($name);

			if($verificar){
				echo json_encode(array("status"=>false,"msg"=>"Ese trabajo ya se encuentra registrado"));
			}else{
				$id = $this->work_model->insertWork($name,$description);
				if($id){
					echo json_encode(array("status"=>true,"name"=>$name, "id"=>$id, "description"=>$description));
				}else{
					echo json_encode(array("status"=>false,"msg"=>"No se encontraron resultados"));
				}
			}

		}else{
			echo json_encode(array("status"=>false,"msg"=>"Error en el envio de datos"));
		}
	}
	public function view_description_clauses(){
		if($_POST['id']){
			$this->load->model("clauses_model");
			$id = trim($_POST['id']);
			
			$data = $this->clauses_model->getClausesById($id);

			if($data){
				echo json_encode(array("status"=>true,"data"=>$data));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo consultar la descripcion."));
			}

		}else{
			echo json_encode(array("status"=>false,"msg"=>"Error en el envio de datos"));
		}
	}
	public function dataDni(){
		if($_POST['dni']){
			$this->load->model("employee_model");
			$dni = trim($_POST['dni']);
			
			$data = $this->employee_model->selectByDoc($dni,$this->session->userdata('business'));

			if($data){
				echo json_encode(array("status"=>true,"data"=>$data));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se encontro a ningun trabajador."));
			}

		}else{
			echo json_encode(array("status"=>false,"msg"=>"Error en el envio de datos"));
		}
	}
	public function newEmployee(){
		if($_POST){
			$this->load->model("employee_model");
			$dni = trim($_POST['newDNI']);
			$name = trim($_POST['newNombres']);
			$lastname = trim($_POST['newApellidos']);
			$address = trim($_POST['newDireccion']);
			$email = trim($_POST['newCorreo']);
			$phone = trim($_POST['newTelefono']);
			
			$verificar = $this->employee_model->selectByDoc($dni,$this->session->userdata('business'));
			if($verificar){
				echo json_encode(array("status"=>false,"msg"=>"Ya existe un empleado con ese DNI."));
			}else{
				$id = $this->employee_model->insertEmployee($name,$lastname,$dni,$address,$email,$phone,$this->session->userdata('business'));

				if($id){
					echo json_encode(array("status"=>true,"id"=>$id,"dni"=>$dni,"name"=>$name,"lastname"=>$lastname,"phone"=>$phone,"address"=>$address,"email"=>$email));
				}else{
					echo json_encode(array("status"=>false,"msg"=>"No se pudo registrar al trabajador."));
				}
			}

		}else{
			echo json_encode(array("status"=>false,"msg"=>"Error en el envio de datos"));
		}
	}
	public function newClauses(){
		if($_POST){
			$this->load->model("clauses_model");
			$newtitle = trim($_POST['newtitle']);
			$newdescripcion = trim($_POST['newdescripcion']);
			
			$verificar = $this->clauses_model->getClausesByName($newtitle,1);
			if($verificar){
				echo json_encode(array("status"=>false,"msg"=>"Ya existe ese nombre para la clausula."));
			}else{
				$id = $this->clauses_model->insertClauses($newtitle,$newdescripcion);

				if($id){
					echo json_encode(array("status"=>true,"id"=>$id,"title"=>$newtitle,"description"=>$newdescripcion));
				}else{
					echo json_encode(array("status"=>false,"msg"=>"No se pudo registrar la cláusula."));
				}
			}

		}else{
			echo json_encode(array("status"=>false,"msg"=>"Error en el envio de datos"));
		}
	}

	


	public function downloadPDFContract(){
		if($_GET){
			$id = trim($_GET['id']);
			$this->load->model("contract_model");
			$this->load->model("business_model");

			$NumberToLetterConverter = new NumberToLetterConverter();
			$tiporemuneracion = array(1=>"mensual",2=>"quincenal",3=>"semanal",4=>"diaria");

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

			$datos = $this->contract_model->selectContractById($id);
			$clausulas = $this->contract_model->selectClausulasByContract($id);
			$gerente = $this->business_model->getGerenteByBusiness($datos->id_business);

			$textClausula = '';
			$c=1;
			foreach ($clausulas as $key) {
				$textClausula .= (strpos($key->clauses_text, "<p>") == 0)? "<p><strong>".nombrenumeroclausula1($c).": </strong>".substr($key->clauses_text, 3) : "<strong>PRIMERO: </strong><span>".$key->clauses_text."</span>" ;
				$c=$c+1;
			}

			/**/
			$datetime1 = new DateTime($datos->fecha_inicio);
			$datetime2 = new DateTime($datos->fecha_fin);
			$interval = $datetime1->diff($datetime2);
			$diferenciafecha =  $interval->format('%y/%m/%d');
			$arraydiferencia = explode("/", $diferenciafecha);
			$diferenciaanios = (intval($arraydiferencia[0])===0) ? "" : ((intval($arraydiferencia[0])==1) ? $arraydiferencia[0]." año": $arraydiferencia[0]." años");
			$diferenciameses = (intval($arraydiferencia[1])==0) ? "" : ((intval($arraydiferencia[1])==1) ? $arraydiferencia[1]." mes": $arraydiferencia[1]." meses");
			$diferenciadias = (intval($arraydiferencia[2])==0) ? "" : ((intval($arraydiferencia[2])==1) ? $arraydiferencia[2]." dia": $arraydiferencia[2]." dias");
			$diferenciafecha = $diferenciaanios." ".$diferenciameses." ".$diferenciadias;
			$diferenciafecha = ($diferenciafecha == "  ")? "0 días" : $diferenciafecha;

			$array1 = array("[empresa-razonsocial]","[empresa-ruc]","[empresa-direccion]",
						"[empresa-distrito]","[empresa-provincia]","[empresa-departamento]",
						"[empresa-actividadeconomica]","[empleado-trabajo]","[empleado-detallestrabajo]","[empleado-explicacioncontrato]",
						"[empleado-nombres]","[empleado-dni]","[empleado-direccion]",
						"[empleado-sueldo]","[empleado-sueldo-texto]","[empleado-tipo-remuneracion]",
						"[gerente-nombres]","[gerente-dni]",
						"[contrato-fechainicio]","[contrato-fechafin]","[contrato-diferenciafecha]",
						"[contrato-fecha]","[contrato-lugarfirma]","[empresa-partidaregistral]"
					);
			$array2 = array($datos->name_razonSocial,$datos->ruc,$datos->address,
						$datos->distrito,$datos->provincia,$datos->departamento,
						$datos->actividad,$datos->name_work,$datos->detalleworkcontract,$datos->explicaworkcontract,
						$datos->name_employee.' '.$datos->lastname_employee,$datos->dni_employee,$datos->address_employee,
						number_format($datos->remuneracion, 2, '.', ''), $NumberToLetterConverter->to_word($datos->remuneracion),$tiporemuneracion[$datos->type_remuneracion],
						$gerente->nombres_user." ".$gerente->apellidos_user,$gerente->dni_user,
						"día ".date("d", strtotime($datos->fecha_inicio))." del mes de ".$nombremes[date("m", strtotime($datos->fecha_inicio))]." del ".date("Y", strtotime($datos->fecha_inicio)) , "día ".date("d", strtotime($datos->fecha_fin))." del mes de ".$nombremes[date("m", strtotime($datos->fecha_fin))]." del ".date("Y", strtotime($datos->fecha_fin)),$diferenciafecha,
						"día ".date("d", strtotime($datos->fecha))." del mes de ".$nombremes[date("m", strtotime($datos->fecha))]." del ".date("Y", strtotime($datos->fecha)),$datos->lugarcontract,$datos->partida
					);
			

			$formato = $datos->format_type;
			$message = str_replace("[clausulas]", $textClausula, $formato);
			$message = str_replace($array1, $array2, $message);

			$pdf = new MyPdf3(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->setData($datos->logo, $datos->address."\nTeléfono: ".$datos->phone);
	        $pdf->SetCreator(PDF_CREATOR);
	        $pdf->SetAuthor('Leandro Mendoza Martin Vladimir');
	        $pdf->SetTitle('Contrato');
	        $pdf->SetSubject('PDF contrato');
	        $pdf->SetKeywords('pdf, contrato');
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
	        $pdf->SetFont('', '', 9);
	        $pdf->writeHTML($message,true,false,true,false,'');
			$pdf->Output($datos->nameContract.'.pdf', 'I');

		}else{
			echo json_encode(array("status"=>false,"msg"=>"Error en el envio de datos"));
		}
	}

	public function uploadFirma(){
		if($_POST && $_FILES && $this->session->userdata('session')){
			$this->load->model("contract_model");
			$id=$_POST['id'];
			
			$logo = uniqid()."-".$_FILES['file']['name'];
			$fichero_subido = "assets/img/firmas/".$logo;
			if (move_uploaded_file($_FILES['file']['tmp_name'], $fichero_subido)) {
			    $foro = $this->contract_model->uploadFirma($id,$logo);
				if($foro){
					echo json_encode(array('status'=>true));
				}else{
					echo json_encode(array('status'=>false));
				}
			} else {
			    echo json_encode(array("status"=>false,"msg"=>"No se pudo subir la imagen"));
			}
			
        }else{
        	header('Location: '.base_url());
     	}
	}

	public function deleteFirma(){
		if($_POST && $this->session->userdata('session')){
			$this->load->model("contract_model");
			$id=$_POST['id'];
			$row = $this->contract_model->selectContractById($id);

			if(unlink("assets/img/firmas/".$row->firmapdf)){
				$foro = $this->contract_model->uploadFirma($id,"");
				if($foro){
					echo json_encode(array('status'=>true));
				}else{
					echo json_encode(array('status'=>false, 'msg'=>'Error de conexion con la BD.'));
				}
			}else{
				echo json_encode(array('status'=>false , 'msg'=>'No se pudo eliminar la firma'));
			}
        }else{
        	header('Location: '.base_url());
     	}
	}

	public function contractAprobar(){
		if($_POST && $this->session->userdata('session')){
			$this->load->model("contract_model");
			$id=trim($_POST['id']);
			$row = $this->contract_model->changeContractStatus($id,2,$this->session->userdata('user'));

			if($row){
				echo json_encode(array('status'=>true));
			}else{
				echo json_encode(array('status'=>false , 'msg'=>'No se pudo aprobar el contrato'));
			}
        }else{
        	header('Location: '.base_url());
     	}
	}
	public function contractRechazar(){
		if($_POST && $this->session->userdata('session')){
			$this->load->model("contract_model");
			$id=trim($_POST['id']);
			$row = $this->contract_model->changeContractStatus($id,3,$this->session->userdata('user'));

			if($row){
				echo json_encode(array('status'=>true));
			}else{
				echo json_encode(array('status'=>false , 'msg'=>'No se pudo rechazar el contrato'));
			}
        }else{
        	header('Location: '.base_url());
     	}
	}
	public function contractEnviar(){
		if($_POST && $this->session->userdata('session')){
			$this->load->model("contract_model");
			$id=trim($_POST['id']);
			$row = $this->contract_model->changeContractStatus($id,1,0);

			if($row){
				echo json_encode(array('status'=>true));
			}else{
				echo json_encode(array('status'=>false , 'msg'=>'No se pudo enviar el contrato'));
			}
        }else{
        	header('Location: '.base_url());
     	}
	}
	public function actualizarData()
	{
		if($this->session->userdata('session')){
			$this->load->model("contract_model");
			
			if($this->session->userdata('rol')==1){
				$contracts = $this->contract_model->selectAllContractUser($this->session->userdata('user'));
				ob_start();
				?>
				<table id="listContracts" class="table table-striped table-hover" cellspacing="0">
					<thead>
						<tr>
							<th>Contrato</th>
							<th>Tipo de contrato</th>
							<th>Nombre del trabajador</th>
							<th>Remuneración</th>
							<th>Puesto</th>
							<th>Estado</th>
							<th>Eventos</th>
							<th>Descargar</th>
							<th>Foro</th>
							<th>Firma</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$tiporemuneracion = array(0=>"no definido" ,1=>"mensual", 2=>"quincenal", 3=>"semanal", 4=>"diario");
							$estadoContrato = array(0=>"No creado", 1=>"Borrador", 2=>"Aceptado", 3=>"Rechazado")
						?>
						<?php foreach ($contracts as $key) { 
							$array = explode(";", $key->vista);
							$clase = (!in_array($this->session->userdata('user'), $array) && $key->vista!="")? "alertq" :"activeq";
							?>
						<tr>
							<td><?= $key->nameContract ?></td>
							<td><?= $key->name_contract_type ?></td>
							<td><?= $key->lastname_employee ?></td>
							<td class="text-center">S/. <?= $key->remuneracion ?> <?= (isset($tiporemuneracion[$key->type_remuneracion]))? $tiporemuneracion[$key->type_remuneracion] :"" ?></td>
							<td class="text-center"><?= $key->name_work ?></td>
							<td class="text-center"><?= (isset($estadoContrato[$key->status_contract]))? $estadoContrato[$key->status_contract] : "" ?></td>
							<td class="text-center">
							<?php  if($key->status_contract==3){ ?>
								<div><button  onClick="editContrato(<?= $key->contract_id ?>)" class="btn-editar btn_eventos">Editar</button></div><div><button class="btn-enviar btn_eventos" onClick="enviar(<?= $key->contract_id ?>);">Enviar</button></div>
							<?php } ?>
							</td>
							
							<td class="text-center"><a download="contrato.pdf" href="<?= base_url() ?>home/downloadPDFContract?id=<?= $key->contract_id ?>"><i data-id="<?= $key->contract_id ?>" class="downloadWord fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
							<td class="text-center"><a target="_blank" class="foro <?= $clase ?>" href="<?= base_url() ?>foro?id=<?= $key->contract_id ?>"><i class="fa fa-users" aria-hidden="true"></i></a></td>
							<?php if($key->status_contract==2) {?>
								<?php if($key->firmapdf==""){ ?>
								<td class="text-center upload-pdf-firma-cont"><div><i data-id="<?= $key->contract_id ?>" class="fa fa-upload upload-pdf-firma" onClick="uploadfirma(this)" aria-hidden="true"></i></div><div class="text-firma-pdf">Suba la firma</div></td>
								<?php }else{ ?>
								<td class="text-center upload-pdf-firma-cont-del"><div><a download="<?= substr($key->firmapdf, strpos($key->firmapdf, "-") + 1) ?>" href="<?= base_url() ?>assets/img/firmas/<?= $key->firmapdf ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></div><div class="text-firma-pdf"><?= substr($key->firmapdf, strpos($key->firmapdf, "-") + 1) ?></div><div class="delete-firma"><i class="fa fa-times-circle" onClick="deleteFirma(<?= $key->contract_id ?>)" aria-hidden="true"></i></div></td>
								<?php } ?>
							<?php } else { echo "<td></td>"; } ?>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php
				$html = ob_get_clean();
				echo json_encode(array("status"=>true, "html"=>$html));
			}else if($this->session->userdata('rol')==2){
				$contracts = $this->contract_model->selectAllContractBusiness($this->session->userdata('business'));
				ob_start();
				?>
				<table id="listContracts" class="table table-striped table-hover" cellspacing="0">
					<thead>
						<tr>
							<th>Contrato</th>
							<th>Tipo de contrato</th>
							<th>Usuario</th>
							<th>Nombre del trabajador</th>
							<th>Remuneración</th>
							<th>Puesto</th>
							<th>Estado</th>
							<th>Eventos</th>
							<th>Descargar</th>
							<th>Foro</th>
							<th>Firma</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$tiporemuneracion = array(0=>"no definido" ,1=>"mensual", 2=>"quincenal", 3=>"semanal", 4=>"diario");
							$estadoContrato = array(0=>"No creado", 1=>"Borrador", 2=>"Aceptado", 3=>"Rechazado")
						?>
						<?php foreach ($contracts as $key) { 
							$array = explode(";", $key->vista);
							$clase = (!in_array($this->session->userdata('user'), $array) && $key->vista!="")? "alertq" :"activeq";
							?>
						<tr>
							<td><?= $key->nameContract ?></td>
							<td><?= $key->name_contract_type ?></td>
							<td><?= $key->apellidos_user ?></td>
							<td><?= $key->lastname_employee ?></td>
							<td class="text-center">S/. <?= $key->remuneracion ?> <?= (isset($tiporemuneracion[$key->type_remuneracion]))? $tiporemuneracion[$key->type_remuneracion] :"" ?></td>
							<td class="text-center"><?= $key->name_work ?></td>
							<td class="text-center"><?= (isset($estadoContrato[$key->status_contract]))? $estadoContrato[$key->status_contract] : "" ?></td>
							<td class="text-center">
							<?php if($key->user_id_create==$this->session->userdata('user')) {?>
								<?php if($key->status_contract==1){ ?>
									<div><button class="btn-aprobar btn_eventos" onClick="aprobar(<?= $key->contract_id ?>);">Aprobar</button></div><div><button class="btn-rechazar btn_eventos" onClick="rechazar(<?= $key->contract_id ?>);">Rechazar</button></div>
								<?php }else if($key->status_contract==2){ ?>
									<div><button class="btn-rechazar btn_eventos" onClick="rechazar(<?= $key->contract_id ?>);">Cancelar</button></div>
								<?php }else if($key->status_contract==3){ ?>
									<div><button onClick="editContrato(<?= $key->contract_id ?>)" class="btn-editar btn_eventos">Editar</button></div><div><button class="btn-enviar btn_eventos" onClick="enviar(<?= $key->contract_id ?>);">Enviar</button></div>
								<?php } ?>
							<?php } else if(($key->revision == 1 || $key->revision == 3)) {?>
								<?php if($key->status_contract==1){ ?>
									<div><button class="btn-aprobar btn_eventos" onClick="aprobar(<?= $key->contract_id ?>);">Aprobar</button></div><div><button class="btn-rechazar btn_eventos" onClick="rechazar(<?= $key->contract_id ?>);">Rechazar</button></div>
								<?php }else if($key->status_contract==2){ ?>
									<div><button class="btn-rechazar btn_eventos" onClick="rechazar(<?= $key->contract_id ?>);">Cancelar</button></div>
								<?php }else if($key->status_contract==3){ ?>
									
								<?php } ?>
							
							<?php } ?>
							</td>
							
							<td class="text-center"><a download="contrato.pdf" href="<?= base_url() ?>home/downloadPDFContract?id=<?= $key->contract_id ?>"><i data-id="<?= $key->contract_id ?>" class="downloadWord fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
							<td class="text-center"><a target="_blank" class="foro <?= $clase ?>" href="<?= base_url() ?>foro?id=<?= $key->contract_id ?>"><i class="fa fa-users" aria-hidden="true"></i></a></td>
							<?php if($key->user_id_create==$this->session->userdata('user') && $key->status_contract==2) {?>
								<?php if($key->firmapdf==""){ ?>
								<td class="text-center upload-pdf-firma-cont"><div><i data-id="<?= $key->contract_id ?>" class="fa fa-upload upload-pdf-firma" onClick="uploadfirma(this)" aria-hidden="true"></i></div><div class="text-firma-pdf">Suba la firma</div></td>
								<?php }else{ ?>
								<td class="text-center upload-pdf-firma-cont-del"><div><a download="<?= substr($key->firmapdf, strpos($key->firmapdf, "-") + 1) ?>" href="<?= base_url() ?>assets/img/firmas/<?= $key->firmapdf ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></div><div class="text-firma-pdf"><?= substr($key->firmapdf, strpos($key->firmapdf, "-") + 1) ?></div><div class="delete-firma"><i class="fa fa-times-circle" onClick="deleteFirma(<?= $key->contract_id ?>)" aria-hidden="true"></i></div></td>
								<?php } ?>
							<?php } else {?>
								<?php if($key->firmapdf==""){ ?>
								<td class="text-center">No existe firma</td>
								<?php }else{ ?>
								<td class="text-center upload-pdf-firma-cont-del"><div><a download="<?= substr($key->firmapdf, strpos($key->firmapdf, "-") + 1) ?>" href="<?= base_url() ?>assets/img/firmas/<?= $key->firmapdf ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></div><div class="text-firma-pdf"><?= substr($key->firmapdf, strpos($key->firmapdf, "-") + 1) ?></div></td>
								<?php } ?>
							<?php } ?>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php
				$html = ob_get_clean();
				echo json_encode(array("status"=>true, "html"=>$html));
			}else{
				$contracts = $this->contract_model->selectAllContract();
				ob_start();
				?>
				<table id="listContracts" class="table table-striped table-hover" cellspacing="0">
					<thead>
						<tr>
							<td>Contrato</td>
							<th>Empresa</th>
							<th>Tipo de contrato</th>
							<th>Usuario</th>
							<th>Nombre del trabajador</th>
							<th>Remuneración</th>
							<th>Puesto</th>
							<th>Estado</th>
							<th>Eventos</th>
							<th>Descargar</th>
							<th>Foro</th>
							<th>Firma</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$tiporemuneracion = array(0=>"no definido" ,1=>"mensual", 2=>"quincenal", 3=>"semanal", 4=>"diario");
							$estadoContrato = array(0=>"No creado", 1=>"Borrador", 2=>"Aceptado", 3=>"Rechazado")
						?>
						<?php foreach ($contracts as $key) { 
							$array = explode(";", $key->vista);
							$clase = (!in_array($this->session->userdata('user'), $array) && $key->vista!="")? "alertq" :"activeq";
							?>
						<tr>
							<td><?= $key->nameContract ?></td>
							<td><?= $key->name_razonSocial ?></td>
							<td><?= $key->name_contract_type ?></td>
							<td><?= $key->apellidos_user ?></td>
							<td><?= $key->lastname_employee ?></td>
							<td class="text-center">S/. <?= $key->remuneracion ?> <?= (isset($tiporemuneracion[$key->type_remuneracion]))? $tiporemuneracion[$key->type_remuneracion] :"" ?></td>
							<td class="text-center"><?= $key->name_work ?></td>
							<td class="text-center"><?= (isset($estadoContrato[$key->status_contract]))? $estadoContrato[$key->status_contract] : "" ?></td>
							<td class="text-center">
							<?php if($key->user_id_create==$this->session->userdata('user')) {?>
								<?php if($key->status_contract==1){ ?>
									<div><button class="btn-aprobar btn_eventos" onClick="aprobar(<?= $key->contract_id ?>);">Aprobar</button></div><div><button class="btn-rechazar btn_eventos" onClick="rechazar(<?= $key->contract_id ?>);">Rechazar</button></div>
								<?php }else if($key->status_contract==2){ ?>
									<div><button class="btn-rechazar btn_eventos" onClick="rechazar(<?= $key->contract_id ?>);">Cancelar</button></div>
								<?php }else if($key->status_contract==3){ ?>
									<div><button onClick="editContrato(<?= $key->contract_id ?>)" class="btn-editar btn_eventos">Editar</button></div><div><button class="btn-enviar btn_eventos" onClick="enviar(<?= $key->contract_id ?>);">Enviar</button></div>
								<?php } ?>
							<?php } else if(($key->revision == 2 || $key->revision == 3)) {?>
								<?php if($key->status_contract==1){ ?>
									<div><button class="btn-aprobar btn_eventos" onClick="aprobar(<?= $key->contract_id ?>);">Aprobar</button></div><div><button class="btn-rechazar btn_eventos" onClick="rechazar(<?= $key->contract_id ?>);">Rechazar</button></div>
								<?php }else if($key->status_contract==2){ ?>
									<div><button class="btn-rechazar btn_eventos" onClick="rechazar(<?= $key->contract_id ?>);">Cancelar</button></div>
								<?php }else if($key->status_contract==3){ ?>
									
								<?php } ?>
							
							<?php } ?>
							</td>
							
							<td class="text-center"><a download="contrato.pdf" href="<?= base_url() ?>home/downloadPDFContract?id=<?= $key->contract_id ?>"><i data-id="<?= $key->contract_id ?>" class="downloadWord fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
							<td class="text-center"><a target="_blank" class="foro <?= $clase ?>" href="<?= base_url() ?>foro?id=<?= $key->contract_id ?>"><i class="fa fa-users" aria-hidden="true"></i></a></td>
							<?php if($key->user_id_create==$this->session->userdata('user') && $key->status_contract==2) {?>
								<?php if($key->firmapdf==""){ ?>
								<td class="text-center upload-pdf-firma-cont"><div><i data-id="<?= $key->contract_id ?>" class="fa fa-upload upload-pdf-firma" onClick="uploadfirma(this)" aria-hidden="true"></i></div><div class="text-firma-pdf">Suba la firma</div></td>
								<?php }else{ ?>
								<td class="text-center upload-pdf-firma-cont-del"><div><a download="<?= substr($key->firmapdf, strpos($key->firmapdf, "-") + 1) ?>" href="<?= base_url() ?>assets/img/firmas/<?= $key->firmapdf ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></div><div class="text-firma-pdf"><?= substr($key->firmapdf, strpos($key->firmapdf, "-") + 1) ?></div><div class="delete-firma"><i class="fa fa-times-circle" onClick="deleteFirma(<?= $key->contract_id ?>)" aria-hidden="true"></i></div></td>
								<?php } ?>
							<?php } else {?>
								<?php if($key->firmapdf==""){ ?>
								<td class="text-center">No existe firma</td>
								<?php }else{ ?>
								<td class="text-center upload-pdf-firma-cont-del"><div><a download="<?= substr($key->firmapdf, strpos($key->firmapdf, "-") + 1) ?>" href="<?= base_url() ?>assets/img/firmas/<?= $key->firmapdf ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></div><div class="text-firma-pdf"><?= substr($key->firmapdf, strpos($key->firmapdf, "-") + 1) ?></div></td>
								<?php } ?>
							<?php } ?>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php
				$html = ob_get_clean();
				echo json_encode(array("status"=>true, "html"=>$html));
			}
        }else{
        	header('Location: '.base_url());
     	}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */