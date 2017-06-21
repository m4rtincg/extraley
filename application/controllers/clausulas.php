<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clausulas extends CI_Controller {

	public function index(){
		if($this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$this->load->model("business_model");
			$this->load->model("type_model");
			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
			$dataHeader['modulo'] = 'pageclausulas';
			$dataFooter['modulo'] = 'pageclausulas';
			$data["types"] = $this->type_model->selectAll();
			$this->load->view('template/header',$dataHeader);
			$this->load->view('clausulas',$data);
			$this->load->view('template/footer',$dataFooter);
        }else{
        	header('Location: '.base_url());
     	}
	}
	public function actualizarData(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$id= trim($_POST['id']);
			$this->load->model("clauses_model");
			
			$data= $this->clauses_model->getClausesByTypeAdmin($id);
			echo json_encode(array("status"=>true,"datos"=>$data));
        }else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}
	public function deleteClausesTemplate(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$id= trim($_POST['id']);
			$this->load->model("clauses_model");
			
			$data= $this->clauses_model->deleteClausesTemplate($id);
			if($data){
				echo json_encode(array("status"=>true,"msg"=>"Se elimino de forma correcta"));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo eliminar"));
			}
			
        }else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}
	public function newClauses(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$this->load->model("clauses_model");
			$newtitle = trim($_POST['newtitle']);
			$newdescripcion = trim($_POST['des']);
			$select = trim($_POST['select']);

			$row = $this->clauses_model->comprobate_name($select,$newtitle);

			if(!$row){
				$data= $this->clauses_model->newClausesTemplate($newtitle,$newdescripcion,$select);

				if($data['status']){
					echo json_encode($data);
				}else{
					echo json_encode(array("status"=>false,"msg"=>"No se ha podido registrar."));
				}
			}else{
				echo json_encode(array("status"=>false,"msg"=>"Ese nombre ya se encuentra en la plantilla."));
			}
			
        }else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}
	public function editClauses(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$this->load->model("clauses_model");
			$edittitle = trim($_POST['edittitle']);
			$editdescripcion = trim($_POST['des']);
			$ideditclauses = trim($_POST['ideditclauses']);
			$idedittypeclauses = trim($_POST['idedittypeclauses']);

			$row = $this->clauses_model->comprobate_name_edit($idedittypeclauses,$edittitle,$ideditclauses);

			if(!$row){
				$data= $this->clauses_model->editClausesTemplate($edittitle,$editdescripcion,$idedittypeclauses,$ideditclauses);

				if($data['status']){
					echo json_encode($data);
				}else{
					echo json_encode(array("status"=>false,"msg"=>"No se ha podido modificar."));
				}
			}else{
				echo json_encode(array("status"=>false,"msg"=>"Ese nombre ya se encuentra en la plantilla."));
			}

        }else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}
	public function changerequired(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$this->load->model("clauses_model");
			$id = trim($_POST['id']);
			$estado = trim($_POST['estado']);

			$data= $this->clauses_model->changeRequired($id,$estado);

			$msg="La clausula no es requerido";
			if($estado==0){
				$msg="La clausula se ha vuelto requerido.";
			}

			if($data){
				echo json_encode(array("status"=>true,"msg"=>$msg));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se ha podido registrar."));
			}
			
        }else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}
	public function getTypeContract(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$id= trim($_POST['id']);
			$this->load->model("type_model");
			
			$data= $this->type_model->selectAllContractTypeByType($id);
			echo json_encode(array("status"=>true,"datos"=>$data));
			
        }else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}
	public function updatesort(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$id= trim($_POST['id']);
			$datos= trim($_POST['datos']);
			$this->load->model("clauses_model");
			
			$arraydatos = explode(",", $datos);

			$x=count($arraydatos);
			foreach($arraydatos as $val){
				$this->clauses_model->updatesort($id, $val, $x);
				$x = $x-1;
			}
			echo json_encode(array("status"=>true));
			
        }else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}
}