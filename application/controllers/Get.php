<?php defined('BASEPATH') or exit ('no direct script access allowed');

class Get extends CI_Controller{
	
	public function __construct(){	
		parent::__construct();
		$this->load->model('Work');
	}

	public function index()
	{
		$this->load->view('errors/403');
	}

	public function work($id = null)
	{
		$date = new Datetime('now', new DateTimeZone('Asia/Jakarta'));
		$format_date = $date->format('Y-m-d h:i:s');
		echo is_null($id) == true ? redirect(base_url()) : "";
		
		if($this->session->role_id == 3){

			$user = $this->session->id;

			$d = [
				'id_pekerjaan' => $id,
				'user_getid' => $this->session->id
			];

			$cek = $this->Work->cek_booking('penjadwalan','user_getid',$user,'get_work',1);
			$cekWork = $this->Work->cek('pekerjaan',['id_pekerjaan' => $id]);

			if($cek){

				echo "<script>var base_url = window.location.origin+ '/netfarm';
				alert('Anda memiliki pekerjaan yang belum selesai');
				window.location.replace(base_url);	</script>";

			}elseif(!$cek && $cekWork){
				
				$user = $this->session->id;
				$this->db->query("UPDATE pekerjaan SET is_posted = 2 WHERE id_pekerjaan = '$id'");
				$this->db->query("UPDATE penjadwalan SET get_work = 1, user_getid ='$user' WHERE id = '$id'");
				
				$this->session->set_flashdata('info','<div class="alert alert-success alert-message">
	          <div class="container">
	            <div class="alert-icon">
	              <i class="material-icons">info_outline</i>
	            </div><button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">
	                <i class="material-icons">clear</i>
	              </span>
	            </button>
	            <b>Info alert :</b> Pekerjaan berhasil di ambil, silahkan silahkan cek di dashboard !
	          </div>
	        </div>');

				redirect(base_url());

			}else{

				show_404();
			}

		}else{

			redirect('daftar');
		}
	}
}