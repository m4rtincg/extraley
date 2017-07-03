<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class actualizarDatos extends CI_Controller {

	public function index(){
		$this->load->model("business_model");
		$this->load->model("user_model");
		
		$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
		$dataHeader['modulo'] = 'page_actualizar';
		$dataFooter['modulo'] = 'page_actualizar';

		$this->load->model("user_model");
		$data['user'] = $this->user_model->selectById($this->session->userdata('user'));
		$data['id'] = $this->session->userdata('user');

		$this->load->view('template/header',$dataHeader);
		$this->load->view('actualizarDatos',$data);
		$this->load->view('template/footer',$dataFooter);
	}

	public function update(){
		if($_POST and $this->session->userdata('session')){
			$this->load->model("user_model");
			$iduser=$this->session->userdata('user');
			$apellidosuser=trim($_POST['apellidosuser']);
			$nombresuser=trim($_POST['nombresuser']);
			$direccionuser=trim($_POST['direccionuser']);
			$emailuser=trim($_POST['emailuser']);
			$telefonouser=trim($_POST['telefonouser']);

			$row = $this->user_model->actualizarDatos($iduser, $apellidosuser,$nombresuser, $direccionuser,$emailuser, $telefonouser);
			
			if($row){
				if($this->session->userdata('rol')==3){
					$this->user_model->actualizarDatos(2, $apellidosuser,$nombresuser, $direccionuser,$emailuser, $telefonouser);
				}
				echo json_encode(array("status"=>true));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se realizo ningun cambio."));
			}
			
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}

	public function change_pass(){
		if($_POST and $this->session->userdata('session')){
			$this->load->model("user_model");
			$passactual=trim($_POST['passactual']);
			$passnew =trim($_POST['passnew']);
			$passnewrepetida=trim($_POST['passnewrepetida']);

			$user = $this->user_model->selectById($this->session->userdata('user'));
			if($passnew != $passnewrepetida){
				echo json_encode(array("status"=>false,"msg"=>"Las nuevas contraseñas no son iguales."));
			}else if($user->password != encriptar($passactual)){
				echo json_encode(array("status"=>false,"msg"=>"La contraseña actual no coincide."));
			}else{
				$newpassword = encriptar($passnew);
				$row = $this->user_model->actualizarDatosPassword($this->session->userdata('user'), $newpassword);
				
				if($row){
					if($this->session->userdata('rol')==3){
						$this->user_model->actualizarDatosPassword(2, $newpassword);
					}
					echo json_encode(array("status"=>true));
				}else{
					echo json_encode(array("status"=>false,"msg"=>"No se realizo ningun cambio."));
				}
			}
			

			
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}

}