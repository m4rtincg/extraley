<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		if($this->session->userdata('session')){
			header('Location: home');
        }else{
            $this->load->model("config_model");
			$data['name'] = $this->config_model->getConfig()->nombre_login;
			$data['sliders'] = $this->config_model->getSliders();
			$this->load->view('login',$data);
        }
	}
	public function logear(){
		if ($_POST) {
			$this->load->model("user_model");
			$ruc = trim($_POST['ruc']);
			$dni = trim($_POST['dni']);
			$pass = encriptar(trim($_POST['pass']));

			$usuario = $this->user_model->login($ruc, $dni, $pass);

			if($usuario){
				$this->session->set_userdata('session',true);
				$this->session->set_userdata('rol',$usuario->tipo);
				$this->session->set_userdata('user',$usuario->id_user);
				$this->session->set_userdata('business',$usuario->id_business);

				echo json_encode(array("status"=>true, "msg"=>"Bienvenido al sistema."));
			}else{
				echo json_encode(array("status"=>false, "msg"=>"Los datos que ingresastes son incorrectos."));
			}
			
		}else{
			echo json_encode(array("status"=>false, "msg"=>"No tienes permiso."));
		}
	}
	public function logout(){
		if($this->session->userdata('session')){
            $this->session->sess_destroy();
          	header('Location: '.base_url());
        }else{
            header('Location: '.base_url());
        }
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */