<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contrato_laboral extends CI_Controller {

	public function index(){
		if($this->session->userdata('session')){
			$this->load->model("contract_type_model");
			$this->load->model("clauses_model");
			$this->load->model("business_model");

			$this->load->model("foro_model");
			$data['fecha'] = $this->foro_model->date();

			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
			$dataHeader['modulo'] = 'pagecl';
			$dataFooter['modulo'] = 'pagecl';
			$data['contract_types'] = $this->contract_type_model->selectAll();
			$this->load->view('template/header',$dataHeader);
			$this->load->view('contrato-laboral',$data);
			$this->load->view('template/footer',$dataFooter);
        }else{
        	header('Location: '.base_url());
     	}
	}
	public function edit($id){
		if(isset($id) && $this->session->userdata('session')){
			$this->load->model("contract_type_model");
			$this->load->model("contract_model");
			$this->load->model("clauses_model");
			$this->load->model("business_model");

			$this->load->model("foro_model");
			$data['fecha'] = $this->foro_model->date();
			$data['contract'] = $this->contract_model->selectContractById($id);
			$contract = $data['contract'];
			$data['id'] = $id;
			$data['clausulas'] = $this->clauses_model->getClausesByType($contract->contract_type_id ,$contract->id_business);
			$data['contractme'] = $this->clauses_model->selectcalusesByContractSaved($id);

			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
			$dataHeader['modulo'] = 'pagecl';
			$dataFooter['modulo'] = 'pagecledit';
			$data['contract_types'] = $this->contract_type_model->selectAll();
			$this->load->view('template/header',$dataHeader);
			$this->load->view('contrato-laboral-edit',$data);
			$this->load->view('template/footer',$dataFooter);
        }else{
        	header('Location: '.base_url());
     	}
	}

	public function getClausulas(){
		if($_POST && $this->session->userdata('session')){
			$id = $_POST['id'];
			$this->load->model("clauses_model");
			$clausulas = $this->clauses_model->getClausesByType($id,$this->session->userdata('business'));
			echo json_encode(array('status'=>true, 'clausulas'=>$clausulas));
        }else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}

	public function getWork(){
		if($_POST && $this->session->userdata('session')){
			$id = $_POST['id'];
			$this->load->model("work_model");
			$work = $this->work_model->selectById($id);
			echo json_encode(array('status'=>true, 'deswork'=>$work->descripcion_work, 'titlework'=>$work->name_work));
        }else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}

	public function newContract(){
		if($_POST){
			$this->load->model("contract_model");
			$this->load->model("business_model");
			$datosEmpresa = $this->business_model->getBusinessById($this->session->userdata('business'));
			$cantidad = $this->contract_model->cantidadContratos($this->session->userdata('business'), date("Y"));

			$nombreContrato = $datosEmpresa->ruc."-".date("Y")."-"."LAB"."-".str_pad($cantidad->cantidad+1, 4, "0", STR_PAD_LEFT);

			$type = trim($_POST['type']);
			$plazo = trim($_POST['plazo']);
			$dateInicio = trim($_POST['dateinicio']);
			$dateFin = trim($_POST['datefin']);
			$work = trim($_POST['work']);
			$user = $this->session->userdata('user');
			$employee = trim($_POST['employee']);
			$comment = trim($_POST['comment']);
			$clauses = trim($_POST['clauses']);
			$lugarfirma = trim($_POST['lugarfirma']);
			//$typecontrato = 1;

			$tipoRemuneracion = trim($_POST['tipoRemuneracion']);
			$montoRemuneracion = trim($_POST['montoRemuneracion']);

			$date = trim($_POST['date']);
			$detalleworkcontract = trim($_POST['detalleworkcontract']);
			$explicaworkcontract = trim($_POST['explicaworkcontract']);

			$clausesarray = explode(",", $clauses);

			$dateinicioarray = explode("/", $dateInicio);
			$datefinarray = explode("/", $dateFin);
			$datearray = explode("/", $date);

			$dateInicio = $dateinicioarray[2]."-".$dateinicioarray[1]."-".$dateinicioarray[0];
			$date = $datearray[2]."-".$datearray[1]."-".$datearray[0];
			$dateFin = ($plazo != 1) ? Date("Y-m-d") :$datefinarray[2]."-".$datefinarray[1]."-".$datefinarray[0];
			
			$id = $this->contract_model->insertContract($type,$plazo,$dateInicio,$dateFin,$date,
														$work,$user,$employee,$comment,$clausesarray,
														$tipoRemuneracion,$montoRemuneracion,$detalleworkcontract,$explicaworkcontract,$lugarfirma,$nombreContrato,$this->session->userdata('business'));

			if($id['status']){
				$contract = $this->contract_model->selectContractById($id['id']);
				if($contract->revision==1){
					$correo = $this->contract_model->getCorreoGerente($contract->id_business);
					$this->addContratoEmail($contract->nombres_user." ".$contract->apellidos_user,$contract->dni_user,strtolower($contract->name_contract_type),$contract->name_employee." ".$contract->lastname_employee,$contract->dni_employee,$contract->name_work,$contract->name_razonSocial,$contract->ruc,$correo);
				}else if($contract->revision==2){
					$correo = $this->contract_model->getCorreoAdmin();
					$this->addContratoEmail($contract->nombres_user." ".$contract->apellidos_user,$contract->dni_user,strtolower($contract->name_contract_type),$contract->name_employee." ".$contract->lastname_employee,$contract->dni_employee,$contract->name_work,$contract->name_razonSocial,$contract->ruc,$correo);
					$correos = $this->contract_model->getCorreoUser($contract->id_business);
					foreach ($correos as $key) {
						$correo = $key->email;
						$this->addContratoEmail($contract->nombres_user." ".$contract->apellidos_user,$contract->dni_user,strtolower($contract->name_contract_type),$contract->name_employee." ".$contract->lastname_employee,$contract->dni_employee,$contract->name_work,$contract->name_razonSocial,$contract->ruc,$correo);
					}
				}else{
					$correo = $this->contract_model->getCorreoGerente($contract->id_business);
					$this->addContratoEmail($contract->nombres_user." ".$contract->apellidos_user,$contract->dni_user,strtolower($contract->name_contract_type),$contract->name_employee." ".$contract->lastname_employee,$contract->dni_employee,$contract->name_work,$contract->name_razonSocial,$contract->ruc,$correo);
					$correo = $this->contract_model->getCorreoAdmin();
					$this->addContratoEmail($contract->nombres_user." ".$contract->apellidos_user,$contract->dni_user,strtolower($contract->name_contract_type),$contract->name_employee." ".$contract->lastname_employee,$contract->dni_employee,$contract->name_work,$contract->name_razonSocial,$contract->ruc,$correo);
					$correos = $this->contract_model->getCorreoUser($contract->id_business);
					foreach ($correos as $key) {
						$correo = $key->email;
						$this->addContratoEmail($contract->nombres_user." ".$contract->apellidos_user,$contract->dni_user,strtolower($contract->name_contract_type),$contract->name_employee." ".$contract->lastname_employee,$contract->dni_employee,$contract->name_work,$contract->name_razonSocial,$contract->ruc,$correo);
					}
				}
				echo json_encode(array("status"=>true));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo registrar el contrato."));
			}
			

		}else{
			echo json_encode(array("status"=>false,"msg"=>"Error en el envio de datos"));
		}
	}

		private function addContratoEmail($usuario,$dniusuario,$tipocontrato,$empleado,$dniempleado,$puesto,$razonSocial,$ruc,$correo){

		$subject="Envio de contrato para revisión";
		$random_hash=md5(date('r',time()));
		$headers='MIME-Version: 1.0' . "\r\n";
	    $headers.='Content-type: text/html; charset=utf-8' . "\r\n";
		$headers.="From: Sistema de gestion de contratos <consultas@extraley.com.pe>\r\n";
		$headers.="Reply-To: Sistema de gestion de contratos <consultas@extraley.com.pe>\r\n";
		
		$message = "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"width:100.0%;background:#e9e9e9;\">";
			$message .= "<tbody><tr><td style=\"padding:0in 0in 0in 0in;\"><div align=\"center\">";
				$message .= "<table width=\"850\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"width:600.5pt;\">";
					$message .= "<tbody><tr><td style=\"padding:0in 0in 0in 0in;\"><div align=\"center\">";
						$message .= "<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\"><tbody><tr><td style=\"padding:0in 0in 0in 0in;\">";
							$message .= "<div><p align=\"center\" style=\"text-align:center;line-height:22.5pt;\"><img src=\"".base_url()."assets/img/logo.png\"></p></div>";
							$message .= "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\" style=\"width:100.0%;background:white;border-top:solid #4ce50d 4.5pt;border-left:none;border-bottom:solid #d1d1d1 1.0pt;border-right:none;border-radius:5px;\">";
								$message .= "<tbody><tr><td style=\"border:none;padding:26.25pt 0in 7.5pt 0in;\">";
									$message .= "<div>";
									
									$message .= "<p align=\"center\" style=\"text-align:left;padding:0 30px;\"><span style=\"font-family:arial;font-weight:bold;font-size:18px;\">";
									$message .= "Se acaba de realizar un contrato.";
									$message .= "</span></p>";

									$message .= "<p align=\"center\" style=\"text-align:left;padding:0 30px;\"><span style=\"font-family:arial;font-size:16px;\">";
									$message .= "El usuario ".$usuario." identificado con D.N.I. N° ".$dniusuario." acaba de realizar un ".$tipocontrato." para el empleado ".$empleado." identificado con D.N.I. N° ".$dniempleado." para el puesto de ".$puesto." para la empresa ".$razonSocial." identificado con R.U.C. N° ".$ruc.".";
									$message .= "</span></p>";

									$message .= "<p align=\"center\" style=\"text-align:left;padding:0 30px;\"><span style=\"font-family:arial;font-size:16px;\">";
									$message .= "Por favor ingrese a la pagina <a href=\"".base_url()."\">".base_url()."</a> para poder evaluar dicho contrato.";
									$message .= "</span></p>";

									$message .= "<p align=\"center\" style=\"text-align:center;\">";
									$message .= "</p>";

									$message .= "</div>";
									$message .= "<p><span>&nbsp;</span></p>";
								$message .= "</td></tr></tbody>";
							$message .= "</table></td></tr></tbody>";
						$message .= "</table></div></td></tr>";
					$message .= "</tbody>";
				$message .= "</table></div><br><br>\r\n\r\n</td></tr>";
			$message .= "</tbody>";
		$message .= "</table>";

		$mail=mail($correo,$subject,$message,$headers);
	}


	public function editContract(){
		if($_POST){
			$this->load->model("contract_model");
			$id = trim($_POST['id']);
			$contract = $this->contract_model->selectContractById($id);
			$empresa = $contract->id_business;
			
			$type = trim($_POST['type']);
			$plazo = trim($_POST['plazo']);
			$dateInicio = trim($_POST['dateinicio']);
			$dateFin = trim($_POST['datefin']);
			$work = trim($_POST['work']);
			$user = $this->session->userdata('user');
			$employee = trim($_POST['employee']);
			$comment = trim($_POST['comment']);
			$clauses = trim($_POST['clauses']);
			$lugarfirma = trim($_POST['lugarfirma']);
			$tipoRemuneracion = trim($_POST['tipoRemuneracion']);
			$montoRemuneracion = trim($_POST['montoRemuneracion']);

			$date = trim($_POST['date']);
			$detalleworkcontract = trim($_POST['detalleworkcontract']);
			$explicaworkcontract = trim($_POST['explicaworkcontract']);

			$clausesarray = explode(",", $clauses);

			$dateinicioarray = explode("/", $dateInicio);
			$datefinarray = explode("/", $dateFin);
			$datearray = explode("/", $date);

			$dateInicio = $dateinicioarray[2]."-".$dateinicioarray[1]."-".$dateinicioarray[0];
			$date = $datearray[2]."-".$datearray[1]."-".$datearray[0];
			$dateFin = ($plazo != 1) ? Date("Y-m-d") :$datefinarray[2]."-".$datefinarray[1]."-".$datefinarray[0];
			
			$id = $this->contract_model->updateContract($type,$plazo,$dateInicio,$dateFin,$date,
														$work,$user,$employee,$comment,$clausesarray,
														$tipoRemuneracion,$montoRemuneracion,$detalleworkcontract,$explicaworkcontract,$lugarfirma,$id,$empresa);

			if($id['status']){
				echo json_encode(array("status"=>true));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo registrar el contrato."));
			}
			

		}else{
			echo json_encode(array("status"=>false,"msg"=>"Error en el envio de datos"));
		}
	}


	


}