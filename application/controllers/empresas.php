<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Empresas extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$this->load->model("business_model");
			$this->load->model("distrito_model");
			$row= $this->distrito_model->selectdepartamentos();

			$dataHeader['modulo'] = 'pageBu';
			$dataFooter['modulo'] = 'pageBu';
			$data['departamento'] = $row;
			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));

			$this->load->view('template/header',$dataHeader);
			$this->load->view('business',$data);
			$this->load->view('template/footer',$dataFooter);
		}else{
        	header('Location: '.base_url());
     	}
	}
	public function view($id)
	{
		if($this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$this->load->model("business_model");
			$this->load->model("type_model");
			
			$data['laboral']= $this->type_model->selectAllContractTypeByType(1);
			$data['civil']= $this->type_model->selectAllContractTypeByType(2);
			$typesBusiness= $this->business_model->selectAlltypesBusinessByBusiness($id);
			$arraytypesBusiness = array();
			foreach ($typesBusiness as $key) {
				$arraytypesBusiness[$key->id] = $key->id;
			}
			$data['typesBusiness']= $arraytypesBusiness;
			$data['id']= $id;

			$dataHeader['modulo'] = 'pagebusinessview';
			$dataFooter['modulo'] = 'pagebusinessview';
			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));

			$this->load->view('template/header',$dataHeader);
			$this->load->view('seleccionarTiposContratos',$data);
			$this->load->view('template/footer',$dataFooter);
		}else{
        	header('Location: '.base_url());
     	}
	}
	public function clausulas($id,$tipo)
	{
		if($this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$this->load->model("business_model");
			$this->load->model("type_model");
			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
			$dataHeader['modulo'] = 'pageclausulas';
			$dataFooter['modulo'] = 'pageclausulas';
			$data["name"] = $this->type_model->selectContractTypeById($tipo)->name;
			$data["empresa"] = $id;
			$data["tipo"] = $tipo;
			$this->load->view('template/header',$dataHeader);
			$this->load->view('clausulas',$data);
			$this->load->view('template/footer',$dataFooter);
        }else{
        	header('Location: '.base_url());
     	}
	}


	public function changeStatus(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$id = trim($_POST['id']);
			$status = trim($_POST['status']);
			$this->load->model("business_model");
			$rows = $this->business_model->changeStatus($id,$status);
			$mensaje = ($status==1)?"Se activo con exito":"Se ha desactivado con exito";
			if($rows != 0){
				echo json_encode(array("status"=>true,"msg"=>$mensaje));
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo cambiar de estado"));
			}
		}else{
        	header('Location: '.base_url());
     	}
	}
	public function selectBusiness(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$id = trim($_POST['id']);

			$this->load->model("business_model");
			$row = $this->business_model->getBusinessById($id);

			if($row){
				$row2 = $this->business_model->getGerenteByBusiness($id);
				if($row2){
					echo json_encode(array("status"=>true,"datos"=>$row,"dni"=>$row2->dni_user,"apellidos"=>$row2->apellidos_user,"nombres"=>$row2->nombres_user,"direccion"=>$row2->direccion_user,"email"=>$row2->email_user,"telefono"=>$row2->telefono_user,"pass"=>"**********"));
				}else{
					echo json_encode(array("status"=>false,"msg"=>"No se pudo consultar los datos del gerente"));
				}
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo consultar los datos"));
			}
		}else{
        	header('Location: '.base_url());
     	}
	}
	public function updateBusiness(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$id = trim($_POST['idbusinessEdit']);
			$ruc = trim($_POST['rucBusinessEdit']);
			$name = trim($_POST['razonBusinessEdit']);
			$address = trim($_POST['direccionBusinessEdit']);
			$phone = trim($_POST['telefonoBusinessEdit']);
			$email = trim($_POST['emailBusinessEdit']);
			$url = trim($_POST['urlBusinessEdit']);
			
			$gdniBusinessEdit = trim($_POST['gdniBusinessEdit']);
			$gapellidosBusinessEdit = trim($_POST['gapellidosBusinessEdit']);
			$gnombresBusinessEdit = trim($_POST['gnombresBusinessEdit']);
			$gemailBusinessEdit = trim($_POST['gemailBusinessEdit']);
			$gdireccionBusinessEdit = trim($_POST['gdireccionBusinessEdit']);
			$gtelefonoBusinessEdit = trim($_POST['gtelefonoBusinessEdit']);
			$gpassBusinessEdit = trim($_POST['gpassBusinessEdit']);
			$revision = trim($_POST['grevisionBusinessEdit']);

			$distrito = trim($_POST['distritoBusinessEdit']);
			$partida = trim($_POST['partidaBusinessEdit']);
			$descripcion = trim($_POST['descripcionBusinessEdit']);
			$gnusuariosBusinessEdit = trim($_POST['gnusuariosBusinessEdit']);

			$pass = ($gpassBusinessEdit=="")?"":encriptar($gpassBusinessEdit);

			$this->load->model("business_model");
			$row = $this->business_model->getBusinessById($id);

			if($row){
				if(! $this->business_model->comprobarBusinessruc($id,$ruc)){

					if(isset($_FILES['fileimageeditLogo'])){
						$logo = uniqid().$_FILES['fileimageeditLogo']['name'];
						$fichero_subido = "assets/img/business/".$logo;
						if (move_uploaded_file($_FILES['fileimageeditLogo']['tmp_name'], $fichero_subido)) {
							if($row->logo!="default.png"){
								unlink("assets/img/business/".$row->logo);
							}
						    $update = $this->business_model->updateBusiness($id,$ruc,$name,$address,$phone,$email,$url,$logo,$gdniBusinessEdit,$gapellidosBusinessEdit,$gnombresBusinessEdit,$gemailBusinessEdit,$gdireccionBusinessEdit,$gtelefonoBusinessEdit,$pass,$revision,$distrito,$descripcion,$partida,$gnusuariosBusinessEdit);
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
						$update = $this->business_model->updateBusiness($id,$ruc,$name,$address,$phone,$email,$url,$logo,$gdniBusinessEdit,$gapellidosBusinessEdit,$gnombresBusinessEdit,$gemailBusinessEdit,$gdireccionBusinessEdit,$gtelefonoBusinessEdit,$pass,$revision,$distrito,$descripcion,$partida,$gnusuariosBusinessEdit);
					    if($update){
					    	echo json_encode(array("status"=>true,"logo"=>$logo));
					    }else{
					    	echo json_encode(array("status"=>false,"msg"=>"No se realizo ningun cambio"));
					    }
					}

				}else{
					echo json_encode(array("status"=>false,"msg"=>"Ese ruc ya existe"));
				}
				
			}else{
				echo json_encode(array("status"=>false,"msg"=>"No se pudo consultar los datos"));
			}
		}else{
        	header('Location: '.base_url());
     	}
	}
	public function addBusiness(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$ruc = trim($_POST['rucBusinessAdd']);
			$name = trim($_POST['razonBusinessAdd']);
			$address = trim($_POST['direccionBusinessAdd']);
			$phone = trim($_POST['telefonoBusinessAdd']);
			$email = trim($_POST['emailBusinessAdd']);
			$url = trim($_POST['urlBusinessAdd']);
			
			$gdniBusinessAdd = trim($_POST['gdniBusinessAdd']);
			$gapellidosBusinessAdd = trim($_POST['gapellidosBusinessAdd']);
			$gnombresBusinessAdd = trim($_POST['gnombresBusinessAdd']);
			$gemailBusinessAdd = trim($_POST['gemailBusinessAdd']);
			$gdireccionBusinessAdd = trim($_POST['gdireccionBusinessAdd']);
			$gtelefonoBusinessAdd = trim($_POST['gtelefonoBusinessAdd']);
			$gpassBusinessAdd = trim($_POST['gpassBusinessAdd']);
			$revision = trim($_POST['grevisionBusinessAdd']);

			$distrito = trim($_POST['distritoBusinessAdd']);
			$partida = trim($_POST['partidaBusinessAdd']);
			$descripcion = trim($_POST['descripcionBusinessAdd']);
			$gnusuariosBusinessAdd = trim($_POST['gnusuariosBusinessAdd']);

			$pass = encriptar($gpassBusinessAdd);

			$this->load->model("business_model");

			if(! $this->business_model->comprobarBusinessrucAdd($ruc)){

				if(isset($_FILES['fileimageAddLogo'])){
					$logo = uniqid().$_FILES['fileimageAddLogo']['name'];
					$fichero_subido = "assets/img/business/".$logo;
					if (move_uploaded_file($_FILES['fileimageAddLogo']['tmp_name'], $fichero_subido)) {
					    $update = $this->business_model->addBusiness($ruc,$name,$address,$phone,$email,$url,$logo,$gdniBusinessAdd,$gapellidosBusinessAdd,$gnombresBusinessAdd,$gemailBusinessAdd,$gdireccionBusinessAdd,$gtelefonoBusinessAdd,$pass,$revision,$distrito,$descripcion,$partida,$gnusuariosBusinessAdd);
					    if($update){
					    	echo json_encode(array("status"=>true,"logo"=>$logo));
					    }else{
					    	echo json_encode(array("status"=>false,"msg"=>"No se realizo ningun cambio"));
					    }
					} else {
					    echo json_encode(array("status"=>false,"msg"=>"No se pudo subir la imagen"));
					}
				}else{
					$logo = "default.png";
					$update = $this->business_model->addBusiness($ruc,$name,$address,$phone,$email,$url,$logo,$gdniBusinessAdd,$gapellidosBusinessAdd,$gnombresBusinessAdd,$gemailBusinessAdd,$gdireccionBusinessAdd,$gtelefonoBusinessAdd,$pass,$revision,$distrito,$descripcion,$partida,$gnusuariosBusinessAdd);
				    if($update){
				    	echo json_encode(array("status"=>true,"logo"=>$logo));
				    }else{
				    	echo json_encode(array("status"=>false,"msg"=>"No se realizo ningun cambio"));
				    }
				}

			}else{
				echo json_encode(array("status"=>false,"msg"=>"Ese ruc ya existe"));
			}
		}else{
        	header('Location: '.base_url());
     	}
	}
	public function selectAllBusiness(){
		if($this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$this->load->model("business_model");
			$rows = $this->business_model->getAllBusiness();
			echo json_encode(array("status"=>true,"datos"=>$rows));
		}else{
        	header('Location: '.base_url());
     	}
	}

	public function selectAllBusinessRevision(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$this->load->model("business_model");
			$user = $_POST['id'];
			$rows = $this->business_model->getAllBusinessRevision();
			$rows2 = $this->business_model->getAllPermisosByUser($user);
			echo json_encode(array("status"=>true,"datos"=>$rows,"empresas"=>$rows2));
		}else{
        	header('Location: '.base_url());
     	}
	}

	public function getProvincias(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$this->load->model("distrito_model");
			$id=trim($_POST['id']);
			$row= $this->distrito_model->selectprovincia($id);
			echo json_encode(array("status"=>true,"datos"=>$row));
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}
	public function getDistritos(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$this->load->model("distrito_model");
			$id=trim($_POST['id']);
			$row= $this->distrito_model->selectdistrito($id);
			echo json_encode(array("status"=>true,"datos"=>$row));
		}else{
			echo json_encode(array("status"=>false,"msg"=>"No tienes permiso."));
		}
	}



	public function changeContratoType(){
		if($_POST and $this->session->userdata('session') and $this->session->userdata('rol') and $this->session->userdata('rol')==3){
			$empresa = trim($_POST['empresa']);
			$tipo = trim($_POST['tipo']);
			$estado = trim($_POST['estado']);
			$this->load->model("business_model");

			if($estado==0){
				$mensaje = "Se activo de forma correcta";
				$rows = $this->business_model->addtypesBusiness($empresa,$tipo);
			}else{
				$mensaje = "Se desactivo de forma correcta";
				$rows = $this->business_model->deletetypesBusiness($empresa,$tipo);
			}
			
			if($rows != 0){
				echo json_encode(array("status"=>true,"msg"=>$mensaje));
			}else{
				echo json_encode(array("status"=>false,"msg"=>$mensaje."No se pudo cambiar de estado"));
			}
		}else{
        	header('Location: '.base_url());
     	}
	}

}