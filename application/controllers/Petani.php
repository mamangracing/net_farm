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

	public function detail_pekerjaan($id_pekerjaan = null)
	{
		$data['judul_table'] = 'Detail Pengerjaan';
		$data['transaksi'] = $this->db->query("
			SELECT * FROM pekerjaan p JOIN trans_getwork t ON p.id_pekerjaan = t.id_pekerjaan JOIN users u ON t.user_getid = u.id_user WHERE p.id_pekerjaan = '$id_pekerjaan'  
			")->result_array();
		$data['post'] = $this->Work->cek('trans_post');
		$data['work'] = $this->Work->cek('trans_getwork');

		$this->load->view('users/petani/transaksi', $data);
	}

	public function daftar_pekerjaan()
	{
		$user = $this->session->id;
		$data['judul_table'] = 'Daftar Pekerjaan';
		$data['transaksi'] = $this->db->query("SELECT * FROM pekerjaan JOIN penjadwalan ON pekerjaan.id_pekerjaan = penjadwalan.id WHERE pekerjaan.id_user = '$user'")->result_array();
		$data['post'] = $this->Work->cek('trans_post');
		
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
					$config['max_height'] = '2000';
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

			$this->form_validation->set_rules('tglAwal','TglAwal','required|trim',[
				'required' => 'Tanggal harus di isi']);

			$this->form_validation->set_rules('meter','Meter','required|trim',[
				'required' => 'Panjang ladang harus diisi']);


			if($this->form_validation->run() == false){

				$data['date'] = $format_date;

				$this->load->view('users/petani/posting',$data);

			} else {


				$date = new Datetime('now', new DateTimeZone('Asia/Jakarta'));
				$format_date = $date->format('Y-m-d H:i:s');

				$type = $this->input->post('tipe');
				$tglAwal = $this->input->post('tglAwal');
				$juru = $this->input->post('meter');
				$pekerjaan = $this->input->post('work_type');
				$upah = $this->input->post('upah');

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

				if($pekerjaan == 1){

					$type = "Membajak Sawah";
				} else {
					$type = "Mengelola Ladang";
				}

				$data = [
					'nama_pekerjaan' => $type,
					'meter' => $juru,
					'id_user' => $this->session->id,
					'tgl_awal' => $tglAwal,
					'harga' => $upah,
					'tipe_kerja' => 'harian',
					'gambar' => $nm_gambar,
				];

				$jadwal = [
					'work_status' => 0,
					'get_work' => 0,
					'is_posted' => 0,
					'tgl_mulai' => $tglAwal,
					'created_at' => $format_date
				];

				$data_pekerjaan = $this->db->query("SELECT * FROM pekerjaan WHERE tgl_awal='$tglAwal'")->result_array();
				$check = count($data_pekerjaan);

				if($check >= 4){

					$this->session->set_flashdata('pesan','<div class="alert alert-message alert-danger text-center" role="alert">Tanggal yang diminta sudah penuh silahkan input ulang </div>');

					redirect('petani/posting');

				} else {

					$this->Work->save('pekerjaan',$data);
					$this->Work->save('penjadwalan',$jadwal);
			
					$this->session->set_flashdata('pesan','<div class="alert alert-message text-center alert-success" role="alert">Silahkan lengkapi pembayaran !!</div>');

					redirect('petani/daftar_pekerjaan');
				
				}
			}

		}else{

			$this->load->view('errors/403');
		}
	}

	public function detail_post($id_pekerjaan)
	{
		if($this->session->role_id == '2'){

			$this->form_validation->set_rules('nama','Nama','required|trim|min_length[9]', [
				'required' => 'Nama tidak boleh kosong',
				'min_length' => 'Nama gak boleh kurang dari 9']);

			$this->form_validation->set_rules('tglAwal','TglAwal','required|trim',[
				'required' => 'Tanggal harus di isi']);

			$this->form_validation->set_rules('juru','Juru','required|trim',[
				'required' => 'Panjang juru harus diisi']);

			if($this->form_validation->run() == false ){

				$date = new Datetime('now', new DateTimeZone('Asia/Jakarta'));
				$format_date = $date->format('Y-m-d');

				$data['date'] = $format_date;
				$data['pekerjaan'] = $this->Work->show_Job('pekerjaan','id_pekerjaan',$id_pekerjaan);
				
				$this->load->view('users/petani/update_posting',$data);
			} else {
				$this->_update_posting($id_pekerjaan);
			}

		} else {
			$this->load->view('errors/403');
		}
	}

	private function _update_posting($id_pekerjaan)
	{
		$date = new Datetime('now', new DateTimeZone('Asia/Jakarta'));
		$format_date = $date->format('Y-m-d h:i:s');

		$type = $this->input->post('tipe');
		$tglAwal = $this->input->post('tglAwal');
		$juru = $this->input->post('juru');
		$nama = $this->input->post('nama');
		$upah = $this->input->post('upah');

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
			'nama' => $nama,
			'juru' => $juru,
			'tgl_awal' => $tglAwal,
			'harga' => $upah,
			'tipe_kerja' => 'harian',
			'gambar' => $nm_gambar,
			'is_posted' => 0,
			'created_at' => $format_date
		];

		$where = ['id_pekerjaan' => $id_pekerjaan];

		$this->Work->update('pekerjaan',$where, $data);

		$this->session->set_flashdata('pesan','<div class="alert alert-message alert-success text-center" role="alert">Data berhasil diupdate</div>');

		redirect('petani/daftar_pekerjaan');
	}

	public function delete_job($id_pekerjaan = null)
	{
		$data = $this->Work->show_Job('pekerjaan','id_pekerjaan',$id_pekerjaan);

		$cek = $this->Work->show_Job('trans_post','id_pekerjaan',$id_pekerjaan);

		if(count($data) == 1){

			if($cek){

				$hapus = $this->db->query("
					DELETE pekerjaan, trans_post, penjadwalan FROM pekerjaan JOIN trans_post ON pekerjaan.id_pekerjaan = trans_post.id_pekerjaan JOIN penjadwalan ON pekerjaan.id_pekerjaan = penjadwalan.id WHERE pekerjaan.id_pekerjaan = '$id_pekerjaan'");

				$this->session->set_flashdata('pesan','<div class="text-center alert alert-success alert-message" role="alert">Pekerjaan berhasil dihapus !! </div>');

				redirect('petani/daftar_pekerjaan');
			
			} else {

				$hapus = $this->db->query("
				DELETE pekerjaan, penjadwalan FROM pekerjaan JOIN penjadwalan ON pekerjaan.id_pekerjaan = penjadwalan.id WHERE pekerjaan.id_pekerjaan = '$id_pekerjaan'");
				
				$this->session->set_flashdata('pesan','<div class="text-center alert alert-success alert-message" role="alert">Pekerjaan berhasil dihapus !! </div>');

				redirect('petani/daftar_pekerjaan');
			}

		} else {

			$this->session->set_flashdata('pesan','<div class="text-center alert alert-danger alert-message" role="alert">Pekerjaan belum dipost !!</div>');

			redirect('petani/transaksi');
		}
	}

	public function edit_post($id_pekerjaan = null)
	{
		$data = $this->Work->show_Job('pekerjaan','id_pekerjaan',$id_pekerjaan);

		if(count($data) == 1){

			$this->load->view('users/petani/posting',$data);
		
		} else {

			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-message text-center" role="alert">Pekerjaan belum di post !!</div>');

			redirect('petani/daftar_pekerjaan');
		}
	}

	public function up_bukti($id_pekerjaan)
	{
		if($this->session->role_id == 2){

			$date = new Datetime('now', new DateTimeZone('Asia/Jakarta'));
			$format_date = $date->format('Y-m-d h:i:s');	
			$get_data = $this->db->get_where('pekerjaan',['id_pekerjaan' => $id_pekerjaan])->row();

			$sumUpah = $get_data->harga;
			$admin = 30/100;
			$biayaAdmin = $get_data->juru * 200000 * $admin;
			$total = $sumUpah + $biayaAdmin;

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
	}

	public function detail_kerja($id_user = null, $id_pekerjaan = null)
	{
		if($this->session->role_id == '2'){

			$data['judul_table'] = 'Detail Pengerjaan';
			$arr = $this->Work->detail_get($id_user, $id_pekerjaan);

			foreach ($arr as $key) {
				$data['nama_user'] = $key['nama_user'];
				$data['nama_pekerjaan'] = $key['nama_pekerjaan'];
				$data['tgl_awal'] = $key['tgl_awal'];
				$data['mulai_kerja'] = $key['created_at'];
				$data['meter'] = $key['meter'];
				$data['tipe_kerja'] = $key['tipe_kerja'];
				$data['harga'] = $key['harga'];
				$data['img'] = $key['bukti_upload'];
				$data['profil'] = $key['profil'];
				$data['nohp'] = $key['nohp'];
				$data['email'] = $key['email'];
				$data['role'] = $key['role_id'];
				$data['status'] = $key['work_status'];
			}
				
			if($arr[0]['id_user'] == $this->session->id) {

				$this->load->view('users/petani/detail_pengerjaan', $data);
			} else {
				$this->load->view('errors/403');
			}

		} else {
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

	public function bookings()
	{
		$this->Work->show_Job('pekerjaan','juru',4);
	}
}