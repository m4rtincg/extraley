<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class actualizarEmpresa extends CI_Controller {

	public function index(){
		$this->load->model("business_model");
		$this->load->model("user_model");
		$this->load->model("distrito_model");
		
		$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
		$dataHeader['modulo'] = 'page_actualizar';
		$dataFooter['modulo'] = 'page_actualizar';

		$data['business'] = $this->business_model->getBusinessById($this->session->userdata('business'));
		$row= $this->distrito_model->selectdepartamentos();

		$data['departamento'] = $row;
        
		$this->load->view('template/header',$dataHeader);
		$this->load->view('actualizarEmpresa',$data);
		$this->load->view('template/footer',$dataFooter);
	}

	public function update(){
		if($_POST and $this->session->userdata('session')){
			$this->load->model("business_model");
			$id_business=trim($_POST['id_business']);
			$ruc=trim($_POST['ruc']);
			$name_razonSocial=trim($_POST['razonsocial']);
			$address=trim($_POST['address']);
			$phone=trim($_POST['phone']);
			$email=trim($_POST['email']);
            $url=trim($_POST['url']);
            $distrito=trim($_POST['distrito']);
            $actividad=trim($_POST['actividad']);
            $partida=trim($_POST['partida']);
            
			$row = $this->partida->actualizarDatosEmpresa($id_business, $ruc,$name_razonSocial, $address,$phone, $email,$url,$distrito,$actividad,$partida);
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
