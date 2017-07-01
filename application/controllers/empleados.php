<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empleados extends CI_Controller {

	public function index(){
		if($this->session->userdata('session')){
			$this->load->model("business_model");
			$this->load->model("employee_model");

			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
			$dataHeader['modulo'] = 'pageEmpleados';
			$dataFooter['modulo'] = 'pageEmpleados';

			$this->load->view('template/header',$dataHeader);
			$this->load->view('empleados');
			$this->load->view('template/footer',$dataFooter);
        }else{
        	header('Location: '.base_url());
     	}
	}
	public function addemployees(){
		if($_POST and $this->session->userdata('session')){
			
			$nombres = trim($_POST['nombresEmployeeAdd']);
			$apellidos = trim($_POST['apellidosEmployeeAdd']);
			$dni = trim($_POST['dniEmployeeAdd']);
			$direccion = trim($_POST['direccionEmployeeAdd']);
			$email = trim($_POST['emailEmployeeAdd']);
			$telefono = trim($_POST['telefonoEmployeeAdd']);

			$id_business = $this->session->userdata('business');
			$this->load->model("employee_model");

			if(! $this->employee_model->comprobardniAdd($dni,$id_business)){

			   $add = $this->employee_model->insertEmployee($nombres,$apellidos,$dni,$direccion,$email,$telefono,$id_business);
			    if($add){
			    	echo json_encode(array("status"=>true));
			    }else{
			    	echo json_encode(array("status"=>false,"msg"=>"No se pudo registrar el empleado"));
			    }
					
			}else{
				echo json_encode(array("status"=>false,"msg"=>"Ese dni ya existe"));
			}
		}else{
        	header('Location: '.base_url());
     	}
	}


	public function editemployees(){
		if($_POST and $this->session->userdata('session')){
			$id = trim($_POST['idemployeeEdit']);
			$nombres = trim($_POST['nombresEmployeeEdit']);
			$apellidos = trim($_POST['apellidosEmployeeEdit']);
			$dni = trim($_POST['dniEmployeeEdit']);
			$direccion = trim($_POST['direccionEmployeeEdit']);
			$email = trim($_POST['emailEmployeeEdit']);
			$telefono = trim($_POST['telefonoEmployeeEdit']);
			
			$id_business = $this->session->userdata('business');
			$this->load->model("employee_model");

			if(! $this->employee_model->comprobardniEdit($id,$dni,$id_business)){

			   $add = $this->employee_model->editemployee($id,$nombres,$apellidos,$dni,$direccion,$email,$telefono);
			    if($add){
			    	echo json_encode(array("status"=>true));
			    }else{
			    	echo json_encode(array("status"=>true,"msg"=>"No se realizo  cambio en la bd"));
			    }
					
			}else{
				echo json_encode(array("status"=>false,"msg"=>"Ese dni ya existe"));
			}
		}else{
        	header('Location: '.base_url());
     	}
	}

	public function selectAllEmployee()
	{
		if($this->session->userdata('session')){
			$this->load->model("employee_model");
			$rows = $this->employee_model->selectByAll($this->session->userdata('business'));
			echo json_encode(array("status"=>true,"datos"=>$rows));
		}else{
        	header('Location: '.base_url());
     	}
	}

	public function changestatus()
	{
		if($_POST and $this->session->userdata('session')){
			$id = trim($_POST['id']);
			$status = trim($_POST['status']);

			$this->load->model("employee_model");

			   $add = $this->employee_model->deleteemployee($id,$status);
			    if($add){
			    	echo json_encode(array("status"=>true,"msg"=>"Se ha cambiado de estado correctamente."));
			    }else{
			    	echo json_encode(array("status"=>false,"msg"=>"No se pudo cambiar el estado"));
			    }
				
		}else{
        	header('Location: '.base_url());
     	}
	}

	public function selectEmployee()
	{
		if($this->session->userdata('session')){
			$id = trim($_POST['id']);

			$this->load->model("employee_model");
			$rows = $this->employee_model->selectById($id);
			if($rows){
			echo json_encode(array("status"=>true,"datos"=>$rows));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se encontro ese empleado"));
			}
		}else{
        	header('Location: '.base_url());
     	}
    }

    //Baja
    public function selectBaja()
	{
		if($this->session->userdata('session')){
			$id = trim($_POST['id']);

			$this->load->model("employee_model");
			$rows = $this->employee_model->selectBajaById($id);
			if($rows){
			echo json_encode(array("status"=>true,"datos"=>$rows));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se encontro esa baja."));
			}
		}else{
        	header('Location: '.base_url());
     	}
    }
    public function cancelarBaja()
	{
		if($this->session->userdata('session')){
			$id = trim($_POST['id']);

			$this->load->model("employee_model");
			$rows = $this->employee_model->deletebaja($id);
			if($rows){
			echo json_encode(array("status"=>true,"datos"=>$rows));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo cancelar."));
			}
		}else{
        	header('Location: '.base_url());
     	}
    }
    public function updateBaja()
	{
		if($this->session->userdata('session')){
			$id = trim($_POST['id']);
			$banco = trim($_POST['banco']);
			$fecha_culminacion = trim($_POST['fecha_culminacion']);
			$cuenta = trim($_POST['cuenta']);
			$lugar1 = trim($_POST['lugar1']);
			$fecha1 = trim($_POST['fecha1']);
			$fecha_inicio = trim($_POST['fecha_inicio']);
			$fecha_fin = trim($_POST['fecha_fin']);
			$lugar2 = trim($_POST['lugar2']);
			$fecha2 = trim($_POST['fecha2']);

			$this->load->model("employee_model");
			$rows = $this->employee_model->updatebaja($id,$banco,$fecha_culminacion,$cuenta,$lugar1,$fecha1,$fecha_inicio,$fecha_fin,$lugar2,$fecha2);
			if($rows){
			echo json_encode(array("status"=>true,"datos"=>$rows));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se encontro ese usuario"));
			}
		}else{
        	header('Location: '.base_url());
     	}
    }
    public function addBaja()
	{
		if($this->session->userdata('session')){
			$id = trim($_POST['id']);

			$this->load->model("employee_model");
			$rows = $this->employee_model->insertbaja($id,$banco,$fecha_culminacion,$cuenta,$lugar1,$fecha1,$fecha_inicio,$fecha_fin,$lugar2,$fecha2);
			if($rows){
			echo json_encode(array("status"=>true,"datos"=>$rows));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se encontro ese usuario"));
			}
		}else{
        	header('Location: '.base_url());
     	}
    }



}