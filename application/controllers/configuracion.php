<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracion extends CI_Controller {

	public function index(){
			if($this->session->userdata('session')){
			$this->load->model("business_model");
			$this->load->model("config_model");
		
			$data["configuracion"] = $this->config_model->getConfig();
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
			$nombre=trim($_POST['nombreconfig']);

			$row = $this->config_model->updateConfig($nombre);
			if($row){
				echo json_encode(array("status"=>true));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se realizo ningun cambio."));
			}
			
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}
}

