<?php

class Hotel_model extends CI_Model{


	

	public function get_hotel($red)
	{
		$upit=$this->db->query("SELECT * 
								FROM hotel");
		$red = $upit->row_array($red);
		return $red;
	}
	public function get_hotel_by_id($id)
	{
		$upit=$this->db->query("SELECT * 
								FROM hotel 
								WHERE id_hotel='$id'");
		return $upit->result_array();
	}
	public function get_hotel_num_rows()
	{
		$upit=$this->db->query("SELECT *
							    FROM hotel");
		return $upit->num_rows();
	}
	public function validate_hotel_credentials()
	{
		$this->db->where('ime',$this->input->post('hotel_name'));
		$query=$this->db->get('hotel');
		if($query->num_rows()==0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function edit_valja_zapis()
	{
		$this->db->where('ime',$this->input->post('edit_name'));
		$query=$this->db->get('hotel');
		if($query->num_rows()==0){
			return true;
		}
		else
		{
			return false;
		}
	}
	public function insert_hotel_picture($slika)
	{
		$sql = "INSERT INTO hotel
		(slika1) VALUES ('$slika')";
		$this->db->query($sql);
	}
	public function edit_hotel_picture($slika,$id_hotel)
	{
		$sql = "UPDATE hotel 
				SET slika1='$slika' 
				WHERE id_hotel='$id_hotel'";
		$this->db->query($sql);
	}


	public function insert_hotel($ime,$tekst,$id_user)
	{
		$last_id=$this->db->insert_id();
		$sql = "UPDATE hotel
				SET ime='$ime',tekst='$tekst' 
				WHERE id_hotel='$last_id'";
		$this->db->query($sql);
		$sql2 = "INSERT INTO users_hotel (id_user,id_hotel) 
				 VALUES ('$id_user','$last_id')";
		$this->db->query($sql2);

	}
	public function edit_hotel($ime,$tekst,$id_user,$id_hotel)
	{
		$sql = "UPDATE hotel
				SET ime='$ime',tekst='$tekst' 
				WHERE id_hotel='$id_hotel'";
		$this->db->query($sql); 
	}
	public function all_hotel_by_user($id_user)
	{
		$query = $this->db->query("SELECT * 
								   FROM hotel h JOIN users_hotel uh 
								   ON h.id_hotel=uh.id_hotel 
								   WHERE uh.id_user='$id_user'");
		return $query->result_array();

	}
	public function all_hotels(){
		$query = $this->db->query("SELECT *
									FROM hotel");
		return $query->result_array();
	}


	
	
}