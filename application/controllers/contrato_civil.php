<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contrato_civil extends CI_Controller {

	public function index(){
		if($this->session->userdata('session')){
			$this->load->model("business_model");

			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
			$dataHeader['modulo'] = 'pagecv';
			$dataFooter['modulo'] = 'pagecv';
			
			$this->load->view('template/header',$dataHeader);
			$this->load->view('contrato-civil');
			$this->load->view('template/footer',$dataFooter);
        }else{
        	header('Location: '.base_url());
     	}
	}

}