<?php defined('BASEPATH') or exit ('no direct script access allowed');

class Admin extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usermodel');
		$this->load->model('Work');
		if($this->session->userdata('email') != TRUE){
			redirect('login');
		} 
	}

	public function index()
	{
		redirect('dashboard');
	}

	public function postingan()
	{
		$get['detail'] = $this->Work->info_getwork();
		
		$this->load->view('users/admin/d_post',$get);
	}

	public function profil($id_user = null)
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

	public function d_petani()
	{
		if($this->session->role_id == '1'){
			// $cek = $this->Sumber->l_petani();
			$data['json'] = $this->Usermodel->lookMember(['role_id' => 2]);
			return $this->load->view('users/admin/vl_petani',$data);

		}else{
			$this->load->view('errors/403');
		}
	}

	public function d_buruh()
	{
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

	public function hapus($id,$role)
	{
		$where = ['id_user' => $id];
		$this->Usermodel->hapusData($where);
		if($role == '2'){
			redirect('admin/d_petani');
		}else{
			redirect('admin/d_buruh');
		}
	}

	public function transaksi()
	{
		
		$get_data = $this->Work->showTrans();
		$data['transaksi'] = $get_data;
		$data['judul_table'] = 'Daftar Transaksi';
		
		$this->load->view('users/petani/transaksi',$data);
	}

	public function acc($id = null)
	{

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

	public function up_bukti($id_pekerjaan = null)
	{
		$this->form_validation->set_rules('image','File','trim|xss_clean');

		if($this->form_validation->run() == false){

			$data['judul_table'] = 'UPLOAD BUKTI TRANSFER';
			$data['keterangan'] = 'Silahkan upload bukti Transfer !! ';
			$data['id_pekerjaan'] = $id_pekerjaan;

			$this->load->view('users/mitra/upload_bukti',$data);
		} else {

			if($this->session->role_id == 1){

				$upload = $_FILE['image']['name'];

				if($upload){

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
				$where = [
					'id_pekerjaan' => $id_pekerjaan
				];

				$data = [
					'id_users' => $this->session->id,
					'status_pembayaran' => 1,
					'tgl_upload' => date('Y-m-d'),
					'akses' => 'Admin'
				];

				$this->Work->update('pembayaran',$where,$data);

				$this->session->set_flashdata('pesan','<div class="alert alert-message alert-success text-center" role="alert">Butki berhasil diupload</div>');

				redirect('admin/postingan');

			} else {
				$this->load->view('errors/403');
			}
		}
	}
}