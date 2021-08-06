<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
	
	public function __construct(){

		parent::__construct();
		$this->load->model('Work');
	}

	public function index(){

		$data['title'] = 'Home | Netfarm';
		$data['judul_table']="Visi Misi";
		$data['posting'] = $this->db->query("SELECT P.id_pekerjaan, P.nama_pekerjaan, U.nama as pemilik_ladang, P.tipe_kerja, P.meter, P.harga, J.created_at as mulai_kerja, P.tgl_awal, P.gambar FROM pekerjaan P JOIN penjadwalan J ON P.id_pekerjaan = J.id JOIN users U ON P.id_user = U.id_user WHERE J.is_posted = 1")->result_array();
		
		$this->load->view('template/header',$data);
		$this->load->view('template/contents',$data);
		$this->load->view('template/footer',$data);
	}


}
