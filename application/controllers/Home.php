<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
	
	public function __construct(){

		parent::__construct();
		$this->load->model('Work');
	}

	public function index(){
		$data['title'] = 'Home | Netfarm';
		$data['posting'] = $this->Work->getWork()->result_array();
		
		$this->load->view('template/header',$data);
		$this->load->view('template/contents',$data);
		$this->load->view('template/footer',$data);
	}

	public function visi(){
		echo "ANJING";
	}

	public function Tentang_netfarm(){
		echo "Bangsat";
			
	}

}