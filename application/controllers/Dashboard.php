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
		$user = $this->session->id;
		$data['data'] = $this->Work->show_saldo($this->session->id);
		$data['selesai'] = $this->Work->cek_booking('penjadwalan','work_status',2,'user_getid',$user);
		
		$this->load->view('users/v_dashboard',$data);
	}
}