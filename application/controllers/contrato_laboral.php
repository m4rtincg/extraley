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
        	header('Location: '.base_url());
     	}
	}

	public function getWork(){
		if($_POST && $this->session->userdata('session')){
			$id = $_POST['id'];
			$this->load->model("work_model");
			$work = $this->work_model->selectById($id);
			echo json_encode(array('status'=>true, 'deswork'=>$work->descripcion_work, 'titlework'=>$work->name_work));
        }else{
        	header('Location: '.base_url());
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
				echo json_encode(array("status"=>true));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo registrar el contrato."));
			}
			

		}else{
			echo json_encode(array("status"=>false,"msg"=>"Error en el envio de datos"));
		}
	}


	


}