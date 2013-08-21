<?php

class Users_model extends CI_Model{


	public function valja_zapis()
	{
		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password',$this->input->post('password'));
		$query=$this->db->get('users');
		if($query->num_rows()==1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function get_id($username)
	{
		// ovo vraca vrednost id_user ali samo ako upit vraca jednu vrednost
		$query = $this->db->query("SELECT id_user 
								   FROM users 
								   WHERE username='$username'");
		$row = $query->row_array();
		return $row['id_user'];
	}
	public function get_uloga($username)
	{
		$query=$this->db->query("SELECT uloga 
								 FROM users 
								 WHERE username='$username'");
		$row=$query->row_array();
		return $row['uloga'];
	}
	public function mod_exist() {
		$this->db->where('username',$this->input->post('mod_name'));
		$query=$this->db->get('users');
		if($query->num_rows()==0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function insert_user($username,$password,$role) {
		$data = array(
			'username' => $username,
			'password' => $password,
			'uloga' => $role
			);
		$this->db->insert('users', $data);
	}
	public function get_all_moderators(){
		$this->db->where('uloga',2);
		$query = $this->db->get('users');
		return $query->result_array();
	}
	public function remove_moderator($id) {
		$this->db->delete('users', array('id_user' => $id)); 
	}

}