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

	public function start_work($id_pekerjaan = null)
	{
		$this->db->query("UPDATE trans_getwork SET work_status = 1 WHERE id_pekerjaan='$id_pekerjaan'");		
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert-message text-center" role="alert">Mulai Kerja !!</div>');

		redirect('mitra/riwayat');
	}

	public function finish_work($id_pekerjaan = null)
	{
		$this->db->query("UPDATE trans_getwork SET work_status = 2 WHERE id_pekerjaan='$id_pekerjaan'");		
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert-message text-center" role="alert">Pekerjaan selesai !!</div>');

		redirect('mitra/riwayat');
	}
}