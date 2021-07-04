<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Usermodel extends CI_Model{

	public function lookMember($role = null)
	{
		$hasil = $this->db->get_where('users', $role)->result();
		$json = json_encode($hasil);
		return $json;
	}

	public function save_users($table = null, $data = null)
	{
		return $this->db->insert($table, $data);
	}

	public function UpdateData($where, $data)
	{
		$this->db->where($where);
		return $this->db->update('users',$data);
	}

	public function hapusData($where = null)
	{
		$this->db->where($where);
		return $this->db->delete('users');
	}
}