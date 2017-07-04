<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracion extends CI_Controller {

	public function index(){
			if($this->session->userdata('session')){
			$this->load->model("business_model");
			$this->load->model("config_model");
		
			$data["configuracion"] = $this->config_model->getConfig();
			$data['sliders'] = $this->config_model->getSliders();
			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
			$dataHeader['modulo'] = 'page_configuracion';
			$dataFooter['modulo'] = 'page_configuracion';

			$this->load->view('template/header',$dataHeader);
			$this->load->view('configuracion',$data);
			$this->load->view('template/footer',$dataFooter);

        }else{
        	header('Location: '.base_url());
     	}
	}

	public function update(){
		if($_POST and $this->session->userdata('session')){
			$this->load->model("config_model");
			$dias=trim($_POST['diasconfig']);

			$row = $this->config_model->updateConfig($dias);
			if($row){
				echo json_encode(array("status"=>true));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se realizo ningun cambio."));
			}
			
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}

	public function addSlider(){
		if($_FILES and $this->session->userdata('session')){
			$this->load->model("config_model");
			
			$logo = uniqid()."-".$_FILES['file']['name'];
			$fichero_subido = "assets/img/slider/".$logo;
			if (move_uploaded_file($_FILES['file']['tmp_name'], $fichero_subido)) {
			    $newid = $this->config_model->addSlider($logo);
				if($newid){
					echo json_encode(array('status'=>true, 'id'=>$newid, 'name'=>$logo));
				}else{
					echo json_encode(array('status'=>false));
				}
			} else {
			    echo json_encode(array("status"=>false,"msg"=>"No se pudo subir la imagen"));
			}
			
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}

	public function deleteSlider(){
		if($_POST and $this->session->userdata('session')){
			$this->load->model("config_model");
			$id=trim($_POST['id']);
			$row = $this->config_model->getSlidersById($id);

			if(unlink("assets/img/slider/".$row->name_imagen)){
				$foro = $this->config_model->deleteSlider($id);
				if($foro){
					echo json_encode(array('status'=>true));
				}else{
					echo json_encode(array('status'=>false, 'msg'=>'Error de conexion con la BD.'));
				}
			}else{
				echo json_encode(array('status'=>false , 'msg'=>'No se pudo eliminar la firma'));
			}
			
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}



	public function addMessage(){
		if($_POST and $this->session->userdata('session')){
			$this->load->model("message_model");
			$msg=trim($_POST['mensajeAdd']);

			$row = $this->message_model->insertMessage($msg);
			if($row){
				echo json_encode(array("status"=>true));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo registrar."));
			}
			
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}
	public function deleteMessage(){
		if($_POST and $this->session->userdata('session')){
			$this->load->model("message_model");
			$id=trim($_POST['id']);

			$row = $this->message_model->deleteMessage($id);
			if($row){
				echo json_encode(array("status"=>true));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo eliminar."));
			}
			
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}
	public function updateMessage(){
		if($_POST and $this->session->userdata('session')){
			$this->load->model("message_model");
			$id=trim($_POST['idmensajeedit']);
			$msg=trim($_POST['mensajeEdit']);

			$row = $this->message_model->updateMessage($id, $msg);
			if($row){
				echo json_encode(array("status"=>true));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se realizo ningun cambio."));
			}
			
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}
	public function selectAllMessage(){
		if($this->session->userdata('session')){
			$this->load->model("message_model");

			$row = $this->message_model->selectAllMessage();
			echo json_encode(array("status"=>true,"datos"=>$row));
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}
	public function selectMessage(){
		if($_POST and $this->session->userdata('session')){
			$this->load->model("message_model");
			$id=trim($_POST['id']);

			$row = $this->message_model->selectAllMessageById($id);
			if($row){
				echo json_encode(array("status"=>true, "datos"=>$row));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo encontrar este mensaje."));
			}
			
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}
}

