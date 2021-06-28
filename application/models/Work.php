<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Work extends CI_Model
{

	public function show_saldo($id = null)
	{
		$this->db->select_sum('P.upah');
		$this->db->from('pekerjaan P');
		$this->db->join('trans_getwork T', 'P.id_pekerjaan = T.id_pekerjaan');
		$this->db->join('users U','T.user_getid = U.id_user');
		$this->db->where('U.id_user', $id);
		$this->db->where('T.work_status',1);
		$query = $this->db->get();
		return $query->row();
	}

	public function getWork()
	{
		return $this->db->get_where('pekerjaan',array('is_posted'=>1));
	}

	public function show_Job($data = null)
	{
		return $this->db->get_where('pekerjaan',['id_pekerjaan' => $data])->result_array();
	}

	public function save($table = null, $data = null)
	{
		return $this->db->insert($table,$data);
	}

	public function saveTrans($data = null)
	{
		return $this->db->insert('trans_post',$data);
	}

	public function showTrans($id = null)
	{
		$this->db->select('P.id_pekerjaan,U.nama as Pemosting,P.nama,P.id_user,P.upah,P.is_posted,T.img_bukti as bukti,T.totalAmount as total,T.created_at');
		$this->db->from('pekerjaan P');
		$this->db->join('trans_post T', 'P.id_pekerjaan = T.id_pekerjaan');
		$this->db->join('users U', 'T.id_user = U.id_user');

		if($this->session->role_id != 1){
			$this->db->where('U.id_user', $id);
		}
		
		$this->db->order_by('P.id_pekerjaan DESC');
		$query = $this->db->get();
		return $query->result_array();	
	}

	public function cek($table = null,$data = null)
	{
		$q = $this->db->get_where($table,$data);
		return $q->row();
	}

	public function cekID($id = null)
	{
		$q = $this->db->get_where('pekerjaan',$id);
		return $q->row();
	}

	public function info_getwork()
	{
		$this->db->select('T.get_status,P.nama as nama,U.nama as nama_petani,U.nohp,U.rekening,T.created_at');
		$this->db->from('trans_getwork T');
		$this->db->join('pekerjaan P', 'P.id_pekerjaan = T.id_pekerjaan');
		$this->db->join('users U', 'on U.id_user = T.user_getid');
		$this->db->order_by('T.id DESC');

		if($this->session->role_id == 1){
			$this->db->where('T.work_status', 2);
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	public function getRiwayat_k($id = null){
		$this->db->select('P.nama as nama_pekerjaan,P.upah,T.work_status,T.get_status');
		$this->db->from('pekerjaan P');
		$this->db->join('trans_getwork T', 'P.id_pekerjaan = T.id_pekerjaan');
		$this->db->join('users U','T.user_getid = U.id_user');
		$this->db->where('U.id_user', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
}