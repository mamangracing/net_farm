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
		$user = $this->session->id;
		$cek['data'] = $this->Work->getRiwayat_k($this->session->id);
		$cek['pembayaran'] = $this->db->query("SELECT * FROM pembayaran WHERE user_get ='$user' ORDER BY status_pembayaran")->result_array();
		//var_dump($cek['pembayaran']);
		$this->load->view('users/mitra/riwayat_kerja',$cek);
	}

	public function start_work($id_pekerjaan = null)
	{
		$user = $this->session->id;

		$cek = $this->Work->cek_booking('penjadwalan','work_status','1','user_getid',$user);

		if($cek){

			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-message text-center" role="alert">Uppss masih ada pekerjaan yang belum selesai nih!!</div> ');

			redirect('mitra/riwayat');

		} else {
			$this->db->query("UPDATE penjadwalan SET work_status = 1 WHERE id='$id_pekerjaan'");

			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-message text-center" role="alert">Mulai Kerja !!</div>');

			redirect('mitra/riwayat');
		}
	}

	public function finish_work($id_pekerjaan = null)
	{

		$data['judul_table'] = 'UPLOAD BUKTI PEKERJAAN';
		$data['keterangan'] = 'Silahkan upload bukti Pekerjaan !! ';
		$data['id_pekerjaan'] = $id_pekerjaan;

		$this->load->view('users/mitra/upload_bukti',$data);
		
	}

	public function save_work($id_pekerjaan = null) {

		$date = new Datetime('now', new DateTimeZone('Asia/Jakarta'));
		$format_date = $date->format('Y-m-d H:i:s');
			
		$upload_image = $_FILES['image']['name'];

		if($upload_image){
			$config['upload_path'] = './assets/img/images';
			$config['allowed_types'] = 'png|jpg|jpeg';
			$config['max_size'] = '3000';
			$config['max_width'] = '4024';
			$config['max_height'] = '4000';
			$config['file_name'] = 'img_' . time();

			$this->load->library('upload', $config);

			if($this->upload->do_upload('image')){
				$nm_gambar = $this->upload->data('file_name');
				
			}
		}

		$cek = $this->Work->show_Job('pembayaran','id_pekerjaan',$id_pekerjaan);

		$where = [
			'id' => $id_pekerjaan,
			'user_getid' => $this->session->id
		];

		$data = [
			'work_status' => 2,
			'get_work' => 0,
			'bukti_upload' => $nm_gambar,
			'created_at' => $format_date
		];
		
		$this->Work->update('penjadwalan',$where, $data);

		$this->session->set_flashdata('pesan','<div class="alert alert-success alert-message text-center" role="alert">Pekerjaan selesai !!</div>');

		redirect('mitra/riwayat');
	}
}