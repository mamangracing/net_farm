<?php
defined('BASEPATH') or exit ('no direct script access allowed');

class Login extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata('email')){
			redirect('dashboard');
		}

		$this->form_validation->set_rules('email','email','required|trim|valid_email',[
			'required' => 'email wajib di isi',
			'valid_email' => 'email tidak valid']);

		$this->form_validation->set_rules('password','Password','required|trim',[
			'required' => 'Password tidak boleh kosong']);

		if($this->form_validation->run() == FALSE){
			$data['title'] = 'Masuk';
			$data['user'] = '';

			$this->load->view('auth/login',$data);

		}else{
			$this->_login();
		}
	}

	private function _login()
	{
		$email = htmlspecialchars($this->input->post('email',true), ENT_QUOTES);
		$password = htmlspecialchars($this->input->post('password', true), ENT_QUOTES);
		$user = $this->Auth->authUsers(['email' => $email])->row_array();

		if($user){

			if($user['is_active'] == 1){

				if(password_verify($password,$user['password'])){

					$data = [
						'id' => $user['id_user'],
						'nama' => $user['nama'],
						'email' => $user['email'],
						'role_id' => $user['role_id']];
					$this->session->set_userdata($data);
					
					if($user['role_id'] == 1){
						// if($user['image'] == 'default.jpg'){
						// 	$this->session->set_flashdata('pesan','<div class="alert alert-info alert-message">Silahkan ganti foto profil anda</div>');
						// }
						redirect('dashboard');

					}elseif($user['role_id'] == 2){

						if($user['image'] == 'default.jpg'){
							$this->session->set_flashdata('warn','
						<div class="alert alert-warning alert-with-icon alert-message" data-notify="container">
			          		<i class="material-icons" data-notify="icon">add_alert</i>
			          		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			            		<i class="material-icons">close</i>
			          		</button>
			          		<span data-notify="message">silhkan lengkapi profile anda !</span>
			        	</div>');
						}

						redirect('dashboard');

					}else{

						if($user['image'] == 'default.jpg'){

							$this->session->set_flashdata('warn','
						<div class="alert alert-warning alert-with-icon alert-message" data-notify="container">
			         		<i class="material-icons" data-notify="icon">add_alert</i>
			          		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			            		<i class="material-icons">close</i>
			          		</button>
			          		<span data-notify="message">silhkan lengkapi profile anda !</span>
			        	</div>');
						}

						redirect('home');			
					}

				}else{

					$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-message">Password Salah !!</div>');

					redirect('login');
				}

			}else{

				$this->session->set_flashdata('pesan','<div class="alert alert-warning alert-message" role="alert"><div class="alert-icon"><i class="material-icons">warning</i></div>Akun belom di aktifasi</div>');

				redirect('login');
			}

		}else{

			$this->session->set_flashdata('pesan','<div class="alert alert-warning alert-message" role="alert"><div class="alert-icon"><i class="material-icons">warning</i></div>Email tidak terdaftar !</div>');

				redirect('login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}