<?php defined('BASEPATH') or exit ('no direct script access allowed');

class Dashboard extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
		$this->load->model('Work');
		$this->load->helper('short_number');
		if($this->session->userdata('email') != TRUE){
			redirect('login');
		}
	}

	public function index()
	{
		$data['data'] = $this->Work->show_saldo($this->session->id);
		
		$this->load->view('users/v_dashboard',$data);
	}
}