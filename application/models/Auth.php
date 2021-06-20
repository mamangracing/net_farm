<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Model{
	
	public function authUsers($data = null){
		return $this->db->get_where('users', $data);
	}
}