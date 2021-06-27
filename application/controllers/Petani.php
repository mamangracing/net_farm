<?php defined('BASEPATH') or exit ('no direct script access allowed');

class Petani extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('Work');
		$this->load->model('Usermodel');
		if($this->session->userdata('email') != TRUE){
			redirect('login');
		}
	}

	public function index()
	{
		return redirect('dashboard');
	}

	public function edit_profile()
	{
		if($this->session->role_id == '2'){
			$user = $this->Usermodel->lookMember(['role_id' => 2, 'id_user' => $this->session->id]);
			$arr = json_decode($user,true);
			foreach ($arr as $key) {
			$data['nama'] = $key['nama'];
			$data['email'] = $key['email'];
			$data['nohp'] = $key['nohp'];
			$data['alamat'] = $key['alamat'];
			$data['norek'] = $key['rekening'];
			$data['kategori'] = "Petani";
			$data['img'] = $key['image'];
			
			}

			$this->form_validation->set_rules('nama','Nama lengkap','required|trim', [
			'required' => 'Nama tidak boleh kosong']);	
			if($this->form_validation->run() == false){
				$this->load->view('users/petani/edit_profile',$data);
			}else{
				$nama = htmlspecialchars($this->input->post('nama'),ENT_QUOTES);
				$email = htmlspecialchars($this->input->post('email'),ENT_QUOTES);
				$alm = htmlspecialchars($this->input->post('alm'),ENT_QUOTES);
				$norek = htmlspecialchars($this->input->post('norek'),ENT_QUOTES);
				$pass = $this->input->post('pass') ? password_hash($this->input->post('pass'), PASSWORD_DEFAULT) : $arr[0]['password'];

				$upload_image = $_FILES['image']['name'];

				if($upload_image){

					$config['upload_path'] = './assets/img/profile';
					$config['allowed_types'] = 'gif|png|jpg|jpeg';
					$config['max_size'] = '3000';
					$config['max_width'] = '1024';
					$config['max_height'] = '1000';
					$config['file_name'] = 'profile-' . time();

					$this->load->library('upload', $config);

					if($this->upload->do_upload('image')){
	
						$gambar_lama = $key['image'];
						
						if($gambar_lama != 'default.jpg'){
							unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
						}
						$gambar_baru = $this->upload->data('file_name');
						
						$this->db->set('image', $gambar_baru);
					}else{
						// print_r($this->upload->display_errors());
						// die();
						$this->session->set_flashdata('pesan','
							<div class="alert alert-danger alert-with-icon alert-message" data-notify="container">
					          <i class="material-icons" data-notify="icon">add_alert</i>
					          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					            <i class="material-icons">close</i>
					          </button>
					          <span data-notify="message">Gagal Mengganti foto profil !</span>
					        </div>');
						redirect('petani/edit_profile');
					}	
				}
				$this->db->set('nama', $nama);
				$this->db->set('email', $email);
				$this->db->set('alamat', $alm);
				$this->db->set('rekening',$norek);
				$this->db->set('password', $pass);
				$this->db->where('id_user',$this->session->id);
				$this->db->update('users');
				$this->session->set_flashdata('pesan','
					<div class="alert alert-success alert-with-icon alert-message" data-notify="container">
			          <i class="material-icons" data-notify="icon">add_alert</i>
			          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			            <i class="material-icons">close</i>
			          </button>
			          <span data-notify="message">Profile berhasil di ubah !</span>
			        </div>');
				redirect('petani/edit_profile');
			}
		}else{
			$this->load->view('errors/403');
		}
	}

	public function posting()
	{
		$date = new Datetime('now', new DateTimeZone('Asia/Jakarta'));
		$format_date = $date->format('Y-m-d h:i:s');

		if($this->session->role_id == '2'){

			$this->form_validation->set_rules('nama','Nama','required|trim|min_length[9]', [
				'required' => 'Nama tidak boleh kosong',
				'min_length' => 'Nama gak boleh kurang dari 9']);

			$this->form_validation->set_rules('batas','batas waktu','required|trim',[
				'required' => 'batas waktu harus di isi']);

			$this->form_validation->set_rules('juru','Juru','required|trim',[
				'required' => 'Panjang juru harus diisi']);


			if($this->form_validation->run() == false){

				$this->load->view('users/petani/posting');

			}else{

				$nm = $this->input->post('nama');
				$juru = $this->input->post('juru');
				$tgl = $this->input->post('tgl');
				$upah = $this->input->post('upah');
				$type = $this->input->post('tipe');

				$up_gambar = $_FILES['image']['name'];

				if($up_gambar){
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

				$data = [
					'nama' => $nm,
					'juru' => $juru,
					'batas_waktu' => $tgl,
					'upah' => $upah,
					'tipe_kerja' => 'harian',
					'gambar' => $nm_gambar,
					'is_posted' => 0,
					'created_at' => $format_date
				];
				var_dump($tgl);
				// $id_pekerjaan = $this->Work->save('pekerjaan',$data);
				
				// $this->session->set_flashdata('pesan','<div class="alert alert-message text-center alert-success" role="alert">Silahkan lengkapi pembayaran !!</div>');

				// redirect('petani/daftar_pekerjaan');
			}

		}else{

			$this->load->view('errors/403');
		}
	}

	public function delete_job($id_pekerjaan = null)
	{
		$data = $this->Work->show_Job($id_pekerjaan);

		if(count($data) == 1){

			$tes = $this->db->query("
				DELETE pekerjaan, trans_post FROM pekerjaan JOIN trans_post ON pekerjaan.id_pekerjaan = trans_post.id_pekerjaan WHERE pekerjaan.id_pekerjaan='$id_pekerjaan'");

			$this->session->set_flashdata('pesan','<div class="text-center alert alert-success alert-message" role="alert">Pekerjaan berhasil dihapus !! </div>');

			redirect('petani/daftar_pekerjaan');

		} else {

			$this->session->set_flashdata('pesan','<div class="text-center alert alert-danger alert-message" role="alert">Pekerjaan belum dipost !!</div>');

			redirect('petani/transaksi');
		}
	}

	public function edit_post($id_pekerjaan = null)
	{
		$data = $this->Work->show_Job($id_pekerjaan);

		if(count($data) == 1){

			$this->load->view('users/petani/posting',$data);
		
		} else {

			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-message text-center" role="alert">Pekerjaan belum di post !!</div>');

			redirect('petani/daftar_pekerjaan');
		}
	}

	public function daftar_pekerjaan()
	{
		$data['judul_table'] = 'Daftar Pekerjaan';
		$data['transaksi'] = $this->db->query('SELECT * FROM pekerjaan')->result_array();
		$data['post'] = $this->db->query('SELECT id_pekerjaan FROM trans_post')->result_array();
		
		$this->load->view('users/petani/transaksi',$data);
	}

	public function pay_post($id_pekerjaan)
	{
		if($this->session->role_id == '2'){

		$get_pekerjaan = $this->db->where('id_pekerjaan', $id_pekerjaan)->get('pekerjaan')->row();
		$detail['row'] = $get_pekerjaan; 

		$this->load->view('users/petani/detail',$detail);

		}else{
			$this->load->view('errors/403');
		}
	}

	public function detail_post($id_pekerjaan)
	{

	}

	public function up_bukti($id_pekerjaan)
	{
		if($this->session->role_id == 2){

		$date = new Datetime('now', new DateTimeZone('Asia/Jakarta'));
		$format_date = $date->format('Y-m-d h:i:s');	
		$get_data = $this->db->get_where('pekerjaan',['id_pekerjaan' => $id_pekerjaan])->row();
		$by_admin = $get_data->upah * 30/100;
		$total = $get_data->upah + $by_admin;

		$file = $_FILES['image']['name'];

		if($file){
			$config['upload_path'] = './assets/img/bukti';
			$config['allowed_types'] = 'png|jpg|jpeg';
			$config['max_size'] = '3000';
			$config['max_width'] = '4024';
			$config['max_height'] = '4000';
			$config['file_name'] = 'img_' . time();

			$this->load->library('upload', $config);

			if($this->upload->do_upload('image')){
				$nm_gambar = $this->upload->data('file_name');
			}

			$data = [
				'id_user' => $this->session->id,
				'img_bukti' => $nm_gambar,
				'id_pekerjaan' => $id_pekerjaan,
				'totalAmount' => $total,
				'created_at' => $format_date,
			];

			$this->Work->saveTrans($data);

			$this->session->set_flashdata('notif','
					<div class="alert alert-success alert-with-icon alert-message" data-notify="container">
			          <i class="material-icons" data-notify="icon">add_alert</i>
			          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			            <i class="material-icons">close</i>
			          </button>
			          <span data-notify="message">Postingan menunggu persetujuan Admin !</span>
			        </div>');
			redirect('dashboard');
		}
		}else{
			$this->load->view('errors/403');
		}
	}

	// public function transaksi(){
		
	// 	$get_data = $this->Work->showTrans($this->session->id);

	// 	$data['transaksi'] = $get_data;
	// 	$data['judul_table'] = 'Daftar Transaksi';

	// 	// foreach($get_data as $data){
	// 	// 	echo "<pre>";
	// 	// 	print_r($data);
	// 	// 	foreach ($data as $key => $value) {
	// 	// 		print_r($key .' => 	'.$value);	
	// 	// 	}
		
	// 	// }
	// 	// die();
	// 	$this->load->view('users/petani/transaksi',$data);
	// }

	public function ajax()
	{
		$this->db->query("select batas_waktu from pekerjaan")->result_array();
	}
}