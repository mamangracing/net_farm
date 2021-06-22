<?php defined('BASEPATH') or exit ('no direct script access allowed');

class Admin extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Usermodel');
		$this->load->model('Work');
		if($this->session->userdata('email') != TRUE){
			redirect('login');
		} 
	}

	public function index(){
		redirect('dashboard');
	}

	public function prof_petani($id_user = null)
	{
		if($this->session->role_id == '1'){
			
			$user = $this->db->query("SELECT * FROM users WHERE id_user = $id_user")->result_array();
			
			foreach($user as $key){
				$data['nama'] = $key['nama'];
				$data['email'] = $key['email'];
				$data['nohp'] = $key['nohp'];
				$data['alamat'] = $key['alamat'];
				$data['norek'] = $key['rekening'];
				$data['kategori'] = "Petani";
				$data['img'] = $key['image'];
			}

			$this->load->view('users/petani/edit_profile', $data);	
		}
	}

	public function d_petani(){
		if($this->session->role_id == '1'){
			// $cek = $this->Sumber->l_petani();
			$data['json'] = $this->Usermodel->lookMember(['role_id' => 2]);
			return $this->load->view('users/admin/vl_petani',$data);

		}else{
			$this->load->view('errors/403');
		}
	}

	public function d_buruh(){
		if($this->session->role_id == '1'){
			$data['json'] = $this->Usermodel->lookMember(['role_id' => 3]);
			return $this->load->view('users/admin/vl_buruh',$data);
		}else{
			$this->load->view('errors/403');
		}
	}

	public function update()
	{
		$role = $this->input->post('role');

		$where = ['id_user' => $this->input->post('id_user')];
		$data = [
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'nohp' => $this->input->post('nohp'),
			'alamat' => $this->input->post('alamat'),
			'rekening' => $this->input->post('rekening'),
		];

		$this->Usermodel->UpdateData($where, $data);

		if($role == '2'){

			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-message text-center" role="alert">Data berhasil di update !! </div>');

			redirect('admin/d_petani');
		}else{

			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-message text-center" role="alert">Data berhasil di update !! </div>');

			redirect('admin/d_buruh');
		}
	}

	public function hapus($id,$role){
		$where = ['id_user' => $id];
		$this->Usermodel->hapusData($where);
		if($role == '2'){
			redirect('admin/d_petani');
		}else{
			redirect('admin/d_buruh');
		}
	}

	public function transaksi(){
		
		$get_data = $this->Work->showTrans();
		$data['transaksi'] = $get_data;
		$data['judul_table'] = 'Daftar Transaksi';
		
		$this->load->view('users/petani/transaksi',$data);
	}

	public function acc($id = null){

		echo is_null($id) == true ? redirect(base_url()) : "";
		
		$this->db->set('is_posted', 1);
		$this->db->where('id_pekerjaan',$id);
		$this->db->update('pekerjaan');
		$this->session->set_flashdata('pesan','
					<div class="alert alert-success alert-with-icon alert-message" data-notify="container">
			          <i class="material-icons" data-notify="icon">add_alert</i>
			          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			            <i class="material-icons">close</i>
			          </button>
			          <span data-notify="message">pekerjaan Berhasil di posting !</span>
			        </div>');
		redirect('admin/transaksi');
	}

	public function postingan(){
		$get['detail'] = $this->Work->info_getwork();
		
		$this->load->view('users/admin/d_post',$get);
	}
}