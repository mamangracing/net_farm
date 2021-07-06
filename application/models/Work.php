<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Work extends CI_Model
{

	public function show_saldo($user = null)
	{
		$this->db->select_sum('P.harga');
		$this->db->from('pekerjaan P');
		$this->db->join('pembayaran B', 'P.id_pekerjaan = B.id_pekerjaan');
		$this->db->where('B.status_pembayaran',1);
		$this->db->where('B.user_get',$user);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function detail_get($user = null, $id_pekerjaan = null)
	{
		$this->db->select('P.id_pekerjaan, P.nama as nama_pekerjaan, P.id_user, P.tgl_awal, P.juru, P.tipe_kerja, P.harga, P.gambar, U.nama as nama_user, U.email, U.nohp, U.role_id, J.work_status');
		$this->db->from('penjadwalan J');
		$this->db->join('users U', 'J.user_getid = U.id_user');
		$this->db->join('pekerjaan P', 'J.id = P.id_pekerjaan');
		$this->db->where('U.id_user',$user);
		$this->db->where('J.id',$id_pekerjaan);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getWork()
	{
		return $this->db->get_where('pekerjaan',array('is_posted'=>1))->result_array();
	}

	public function show_Job($table = null, $where = null, $data = null)
	{
		return $this->db->get_where($table,[$where => $data])->result_array();
	}

	public function cek_booking($table = null, $where1 = null, $user, $where2 = null, $data)
	{
		return $this->db->get_where($table,array($where1 => $user, $where2 => $data))->result_array();
	}

	public function update($table = null, $where = null, $data = null)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
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
		$this->db->select('P.id_pekerjaan,U.nama as Pemosting, P.nama, P.juru, P.tgl_awal, P.id_user, P.harga, P.is_posted, T.img_bukti as bukti, T.created_at');
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

	public function cek($table = null)
	{
		return $this->db->get_where($table)->result_array();
	}

	public function cekID($id = null)
	{
		$q = $this->db->get_where('pekerjaan',$id);
		return $q->row();
	}

	public function info_getwork()
	{
		$this->db->select('P.id_pekerjaan, P.nama as nama, U.nama as nama_petani, U.nohp, U.rekening, J.created_at, B.status_pembayaran');
		$this->db->from('penjadwalan J');
		$this->db->join('pekerjaan P', 'P.id_pekerjaan = J.id');
		$this->db->join('users U', 'on U.id_user = J.user_getid');
		$this->db->join('pembayaran B', 'P.id_pekerjaan = B.id_pekerjaan');
		$this->db->order_by('J.id DESC');

		if($this->session->role_id == 1){
			$this->db->where('J.work_status', 2);
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	public function getRiwayat_k($id = null){
		$this->db->select('P.nama as nama_pekerjaan, P.juru, P.harga, P.tgl_awal, P.tipe_kerja, J.user_getid ,J.work_status, J.id');	
		$this->db->from('pekerjaan P');
		$this->db->join('penjadwalan J', 'P.id_pekerjaan = J.id');
		$this->db->join('users U','J.user_getid = U.id_user');
		$this->db->where('U.id_user', $id);
		$this->db->order_by('tgl_awal');
		$query = $this->db->get();
		return $query->result_array();
	}
}