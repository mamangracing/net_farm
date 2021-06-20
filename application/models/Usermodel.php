<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Usermodel extends CI_Model{

	public function lookMember($role = null)
	{
		$hasil = $this->db->get_where('users', $role)->result();
		$json = json_encode($hasil);
		return $json;
	}

	public function simpan_petani($data = null)
	{
		return $this->db->insert('petani', $data);
	}

	public function simpan_buruh($data = null)
	{
		return $this->db->insert('buruh', $data);
	}

	public function UpdateData($id = null)
	{
		$name = $this->input->post('nama');
		$email = $this->input->post('email');
		$nohp = $this->input->post('nohp');
		$this->db->set('nama', $name);
		$this->db->set('email', $email);
		$this->db->set('nohp', $nohp);
		$this->db->where('id', $id);
		$result = $this->db->update('users');
		return $result;

	}

	public function hapusData($where = null)
	{
		$this->db->where($where);
		return $this->db->delete('users');
	}
}