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
		$cek['search'] = $this->Work->show_job('penjadwalan','work_status',1);
		$cek['pembayaran'] = $this->Work->show_job('pembayaran','user_get',$user);
		
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
		$this->form_validation->set_rules('image','File','trim|xss_clean');

		if($this->form_validation->run() == false ){

			$data['judul_table'] = 'UPLOAD BUKTI PEKERJAAN';
			$data['keterangan'] = 'Silahkan upload bukti Pekerjaan !! ';
			$data['id_pekerjaan'] = $id_pekerjaan;

			$this->load->view('users/mitra/upload_bukti',$data);
		
		} else {
			
			$upload_image = $_FILES['image']['name'];
			
			if($upload_image){

				$config['upload_path'] = './assets/img/bukti';
				$config['allowed_types'] = 'gif|png|jpg|jpeg';
				$config['max_size'] = '3000';
				$config['max_width'] = '1024';
				$config['max_height'] = '1000';
				$config['file_name'] = 'bukti' . time();

				$this->load->library('upload', $config);

				if($this->upload->do_upload('userfile')){
					$nm_gambar = $this->upload->data('file_name');
				}
			}

			$cek = $this->Work->show_Job('pembayaran','id_pekerjaan',$id_pekerjaan);

			if($cek){

			} else {

				$pembayaran = [
					'id_pekerjaan' => $id_pekerjaan,
					'status_pembayaran' => 0,
					'user_get' => $this->session->id 
				];

				$this->Work->save('pembayaran',$pembayaran);
			}

			$where = [
				'id' => $id_pekerjaan,
				'user_getid' => $this->session->id
			];

			$data = [
				'work_status' => 2,
				'get_work' => 0,
				'bukti_upload' => 'default.jpg'
			];

			
			$this->Work->update('penjadwalan',$where, $data);

			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-message text-center" role="alert">Pekerjaan selesai !!</div>');

			redirect('mitra/riwayat');
		}
	}
}