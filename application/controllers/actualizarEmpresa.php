<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class actualizarEmpresa extends CI_Controller {

	public function index(){
		$this->load->model("business_model");
		$this->load->model("user_model");
		$this->load->model("distrito_model");
		
		$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
		$dataHeader['modulo'] = 'page_actualizar_empresa';
		$dataFooter['modulo'] = 'page_actualizar_empresa';

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
			$name=trim($_POST['razonsocial']);
			$address=trim($_POST['address']);
			$phone=trim($_POST['phone']);
			$email=trim($_POST['email']);
			$revision=trim($_POST['revision']);
            $url=trim($_POST['url']);
            $distrito=trim($_POST['distrito']);
            $actividad=trim($_POST['actividad']);
            $partida=trim($_POST['partida']);
            $id = $this->session->userdata('business');

			$row = $this->business_model->getBusinessById($id);
			$ruc = $row->ruc;
			if($row){
				
				if(isset($_FILES['fileimageeditLogo'])){
					$logo = uniqid().$_FILES['fileimageeditLogo']['name'];
					$fichero_subido = "assets/img/business/".$logo;
					if (move_uploaded_file($_FILES['fileimageeditLogo']['tmp_name'], $fichero_subido)) {
						if($row->logo!="default.png"){
							unlink("assets/img/business/".$row->logo);
						}
					    $update = $this->business_model->updateBusiness2($id,$name,$address,$phone,$email,$url,$logo,$revision,$distrito,$actividad,$partida);
					    if($update){
					    	echo json_encode(array("status"=>true,"logo"=>$logo));
					    }else{
					    	echo json_encode(array("status"=>false,"msg"=>"No se realizo ningun cambio"));
					    }
					} else {
					    echo json_encode(array("status"=>false,"msg"=>"No se pudo subir la imagen"));
					}
				}else{
					$logo = $row->logo;
					$update = $this->business_model->updateBusiness2($id,$name,$address,$phone,$email,$url,$logo,$revision,$distrito,$actividad,$partida);
				    if($update){
				    	echo json_encode(array("status"=>true,"logo"=>$logo));
				    }else{
				    	echo json_encode(array("status"=>false,"msg"=>"No se realizo ningun cambio"));
				    }
				}

				
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo consultar los datos"));
			}
			
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}

	
	}
