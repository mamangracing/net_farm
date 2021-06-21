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

			$data =[
				'work_status' => 1,
				'id_pekerjaan' => $id,
				'user_getid' => $this->session->id,
				'created_at' => $format_date,
				'get_status' => 1
			];

			$d = [
				'id_pekerjaan' => $id,
				'user_getid' => $this->session->id
			];

			$cek = $this->Work->cek('trans_getwork',$d);
			$cekWork = $this->Work->cek('pekerjaan',['id_pekerjaan' => $id]);

			if($cek){

				echo "<script>var base_url = window.location.origin+ '/netfarm';
				alert('pekerjaan sudah anda ambil');
				window.location.replace(base_url);	</script>";

			}elseif(!$cek && $cekWork){
				
				$update = $this->db->query('UPDATE pekerjaan SET is_posted = 2 WHERE id_pekerjaan',$id);

				$this->Work->save('trans_getwork',$data);
				$this->session->set_flashdata('info','<div class="alert alert-success alert-message">
	          <div class="container">
	            <div class="alert-icon">
	              <i class="material-icons">info_outline</i>
	            </div><button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">
	                <i class="material-icons">clear</i>
	              </span>
	            </button>
	            <b>Info alert :</b> Pekerjaan berhasil di ambil, silahkan tunggu persetujuan petani !
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