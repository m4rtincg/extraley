<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function index(){
		if($this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')!=1){
			$this->load->model("business_model");
			$this->load->model("user_model");

			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
			$dataHeader['modulo'] = 'pageUser';
			$dataFooter['modulo'] = 'pageuser';

			$this->load->view('template/header',$dataHeader);
			$this->load->view('usuarios');
			$this->load->view('template/footer',$dataFooter);
        }else{
        	header('Location: '.base_url());
     	}
	}

	public function view($id){
		if($this->session->userdata('session')){
			$this->load->model("business_model");
			$this->load->model("user_model");

			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
			$dataHeader['modulo'] = 'pageprivilegios';
			$dataFooter['modulo'] = 'pageprivilegios';
			$data['id'] = $id;
			$data["user"] = $this->business_model->getUserById($id);

			$this->load->view('template/header',$dataHeader);
			$this->load->view('privilegios',$data);
			$this->load->view('template/footer',$dataFooter);
        }else{
        	header('Location: '.base_url());
     	}
	}


	public function addusers(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')!=1){
			$dni = trim($_POST['dniUserAdd']);
			$apellidos = trim($_POST['apellidosUserAdd']);
			$nombres = trim($_POST['nombresUserAdd']);
			$direccion = trim($_POST['direccionUserAdd']);
			$email = trim($_POST['emailUserAdd']);
			$telefono = trim($_POST['telefonoUserAdd']);
			$pass = encriptar(trim($_POST['passwordUserAdd']));
			$id_business = $this->session->userdata('business');

			$this->load->model("user_model");

			if(! $this->user_model->comprobardniAdd($dni,$id_business)){

			   $add = $this->user_model->adduser($dni,$apellidos,$nombres,$direccion,$email,$telefono,$pass,$id_business);
			    if($add){
			    	echo json_encode(array("status"=>true));
			    }else{
			    	echo json_encode(array("status"=>false,"msg"=>"No se pudo registrar el usuario"));
			    }
					
			}else{
				echo json_encode(array("status"=>false,"msg"=>"Ese dni ya existe"));
			}
		}else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}


	public function editusers(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')!=1){

			$id = trim($_POST['iduserEdit']);
			$dni = trim($_POST['dniUserEdit']);
			$apellidos = trim($_POST['apellidosUserEdit']);
			$nombres = trim($_POST['nombresUserEdit']);
			$direccion = trim($_POST['direccionUserEdit']);
			$email = trim($_POST['emailUserEdit']);
			$telefono = trim($_POST['telefonoUserEdit']);
			$pass = trim($_POST['passwordUserEdit']);
			$id_business = $this->session->userdata('business');
			$pass = ($pass=="")? false : encriptar($pass);

			$this->load->model("user_model");

			if(! $this->user_model->comprobardniEdit($id,$dni,$id_business)){

			   $add = $this->user_model->edituser($id,$dni,$apellidos,$nombres,$direccion,$email,$telefono,$pass);
			    if($add){
			    	echo json_encode(array("status"=>true));
			    }else{
			    	echo json_encode(array("status"=>true,"msg"=>"No se realizo ningun cambio en la bd"));
			    }
					
			}else{
				echo json_encode(array("status"=>false,"msg"=>"Ese dni ya existe"));
			}
		}else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}

	public function selectByAll()
	{
		if($this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')!=1){
			$this->load->model("user_model");
			$rows = $this->user_model->selectByAll($this->session->userdata('business'));
			$admin = ($this->session->userdata('rol')==3)?true:false;
			echo json_encode(array("status"=>true,"datos"=>$rows,"ex"=>$admin));
		}else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}

	public function changestatus()
	{
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')!=1){
			$id = trim($_POST['id']);
			$status = trim($_POST['status']);

			$this->load->model("user_model");

	

			   $add = $this->user_model->deleteuser($id,$status);
			    if($add){
			    	echo json_encode(array("status"=>true,"msg"=>"Se ha cambiado de estado correctamente."));
			    }else{
			    	echo json_encode(array("status"=>false,"msg"=>"No se pudo cambiar el estado"));
			    }
				
		}else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}

	public function selectUser()
	{
		if($this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')!=1){
			$id = trim($_POST['id']);

			$this->load->model("user_model");
			$rows = $this->user_model->selectById($id);
			if($rows){
			echo json_encode(array("status"=>true,"datos"=>$rows));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se encontro ese usuario"));
			}
		}else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}

	public function asignarprivilegios(){
		if($this->session->userdata('session')){
			$usuario = $_POST['usuario'];
			$empresa = $_POST['empresa'];
			$this->load->model("business_model");
			$rows = $this->business_model->addPermisos($empresa,$usuario);
			if($rows){
				echo json_encode(array("status"=>true));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo asignar"));
			}

		}else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}

	public function cancelarasignarprivilegios(){
		if($this->session->userdata('session')){
			$usuario = $_POST['usuario'];
			$empresa = $_POST['empresa'];
			$this->load->model("business_model");
			$rows = $this->business_model->deletePermisos($empresa,$usuario);
			if($rows){
				echo json_encode(array("status"=>true));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo cancelar la asignación"));
			}

		}else{
        	echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
     	}
	}
}
