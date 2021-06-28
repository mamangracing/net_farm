<?php defined('BASEPATH') or exit ('no direct script access allowed');


class Mitra extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Work');

	}

	public function index()
	{
		redirect('dashboard');
	}

	public function riwayat()
	{
		$cek['data'] = $this->Work->getRiwayat_k($this->session->id);
		$this->load->view('users/mitra/riwayat_kerja',$cek);
	}
}