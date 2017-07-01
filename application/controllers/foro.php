<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Foro extends CI_Controller {

	public function index(){
		if($this->session->userdata('session')){
			$this->load->model("business_model");
			$this->load->model("foro_model");
			$this->load->model("contract_model");
			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
			$dataHeader['modulo'] = 'pageforo';
			$dataFooter['modulo'] = 'pageforo';

			$contract = $_GET['id'];
			$this->foro_model->update_view($contract,$this->session->userdata('user'));
			$data['foros'] = $this->foro_model->selectByContract($contract);
			$data['fecha'] = $this->foro_model->date();
			$data['id'] = $contract;
			$data["iduser"] = $this->session->userdata('user');
			$data['contrato'] = $this->contract_model->selectContractById($contract);
			$this->load->view('template/header',$dataHeader);
			$this->load->view('foro',$data);
			$this->load->view('template/footer',$dataFooter);
        }else{
        	header('Location: '.base_url());
     	}
	}
	public function addForo(){
		if($_POST && $this->session->userdata('session')){
			$this->load->model("foro_model");
			$id = trim($_POST['id']);
			$texto = trim($_POST['texto']);
			$fecha = trim($_POST['fecha']);

			$foro = $this->foro_model->insertForo($id,$this->session->userdata('user'),$texto,1);
			if($foro){
				echo json_encode(array('status'=>true));
			}else{
				echo json_encode(array('status'=>false));
			}
			
        }else{
        	header('Location: '.base_url());
     	}
	}
	public function actForo(){
		if($_POST && $this->session->userdata('session')){
			$this->load->model("foro_model");
			$id = trim($_POST['id']);
			$fecha = trim($_POST['fecha']);

			$this->foro_model->update_view($id,$this->session->userdata('user'));
			$foro = $this->foro_model->selectBydate($id,$fecha);
			if($foro){
				echo json_encode(array('status'=>true,'foro'=>$foro));
			}else{
				echo json_encode(array('status'=>false));
			}
			
        }else{
        	header('Location: '.base_url());
     	}
	}
	public function upload(){
 		if($_POST && $_FILES && $this->session->userdata('session')){
			$this->load->model("foro_model");
			$id=$_POST['id'];
			
			$logo = uniqid()."-".$_FILES['file']['name'];
			$fichero_subido = "assets/img/foros/".$logo;
			if (move_uploaded_file($_FILES['file']['tmp_name'], $fichero_subido)) {
			    $foro = $this->foro_model->insertForo($id,$this->session->userdata('user'),$logo,2);
				if($foro){
					echo json_encode(array('status'=>true));
				}else{
					echo json_encode(array('status'=>false, 'msg'=>'No se pudo enviar mensaje.'));
				}
			} else {
			    echo json_encode(array("status"=>false,"msg"=>"No se pudo subir la imagen"));
			}
			
        }else{
        	header('Location: '.base_url());
     	}
	}
}
?>