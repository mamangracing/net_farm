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
	public function update(){
		$id = $this->input->post('id_user');
		$role = $this->input->post('role');
		$this->Usermodel->UpdateData($id);
		if($role == '2'){
		redirect('admin/d_petani');
		}else{
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