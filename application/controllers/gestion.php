<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'libraries/tcpdf/tcpdf.php';


class gestion extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('session')){
			$this->load->model("business_model");
			$dataHeader["user"] = $this->business_model->getUserById($this->session->userdata('user'));
			$dataHeader["modulo"] = 'pagegestion';
			$dataFooter["modulo"] = 'pagegestion';
			$this->load->view('template/header',$dataHeader);
			$this->load->view('gestion');
			$this->load->view('template/footer',$dataFooter);
        }else{
        	header('Location: '.base_url());
     	}
	}
}