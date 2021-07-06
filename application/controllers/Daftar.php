<?php
defined('BASEPATH') or exit ('no direct script access allowed');

class Daftar extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Usermodel');
	}

	public function index(){

		if($this->session->userdata('email')){
			redirect('dashboard');
		}

		$this->form_validation->set_rules('nama','Nama Lengkap','required|min_length[3]',[
			'required' => 'Nama Belum isi !!',
			'min_length' => 'Nama terlalu pendek']);

		$this->form_validation->set_rules('email','Alamat Email','required|trim|valid_email|is_unique[users.email]',[
			'valid_email' => 'Email Tidak Benar !!',
			'required' => 'Email Belum di isi!!',
			'is_unique' => 'Email Sudah terdaftar !!!']);

		$this->form_validation->set_rules('password','Password','required|trim|min_length[3]',[
			'matches' => 'Password Tidak sama !',
			'min_length' => 'Password Terlalu Pendek !']); 

		$this->form_validation->set_rules('alamat','Alamat','required|trim|min_length[9]',[
			'min_length' => 'Min kata 9 karakter',
			'required' => 'Alamat tidak boleh kosong']);

		$this->form_validation->set_rules('nohp','nomor hp','required|trim|numeric|min_length[11]|max_length[13]',
			[
			'required' => 'nomor hp tidak boleh kosong',
			'numeric' => 'nohp harus berupa nomor',
			'min_length' => 'nohp terlalu pendek',
			'max_length' => 'nohp terlalu panjang'
			]);

		if($this->form_validation->run() == false){

			$data['title'] = "Form Pendaftaran";
			$this->load->view('auth/register',$data);

		}else{

			$email = $this->input->post('email', true);
			$nama = $this->input->post('nama',true);
			$pilih = $this->input->post('pilih',true);
			$nohp = $this->input->post('nohp',true);
			$alamat = $this->input->post('alamat',true);

			$data = [
				'nama' => htmlspecialchars($nama, ENT_QUOTES),
				'email' => htmlspecialchars($email,ENT_QUOTES),
				'nohp' => $nohp,
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => $pilih,
				'is_active' => 1,
				'alamat' => $alamat
			];

			if($pilih == 2){
				$status = "Petani";
			} else {
				$status = "Buruh";
			}

			$user_group = [
				'role_id' => $pilih,
				'status' => $status
			];

			$this->Usermodel->save_users('users_group',$user_group);

			//jika yang daftar sebagai petani
			if($pilih == 2){

				$this->Usermodel->save_users('users',$data);
				
				$this->session->set_flashdata('pesan','<div class="alert alert-success alert-message" role="alert">Selamat akun anda berhasil di buat !!</div>');

				redirect('login');
			} 
			else {

				$this->Usermodel->save_users('users',$data);
				
				$this->session->set_flashdata('pesan','<div class="alert alert-success alert-message" role="alert">Selamat akun anda berhasil di buat !!</div>');

				redirect('login');
			}
		}
	}
}