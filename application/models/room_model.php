<?php

class Room_model extends CI_Model{

//vraca sve kategorije
	public function get_room_category()
	{
		$upit=$this->db->query("SELECT * FROM room_category");
		return $upit->result_array();
	}
//proverava zapis sobe
	public function valja_zapis()
	{
		$this->db->where('room_name',$this->input->post('room_name'));	
		$query=$this->db->get('rooms');
		if($query->num_rows()==0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
//unosi sliku za sobu
	public function unesi_room_sliku($slika)
	{
		$sql = "INSERT INTO rooms (room_picture) 
				VALUES ('$slika')";
		$this->db->query($sql);
	}
//unosi sve podatke o sobi
	public function unesi_room_ceo($name,$category,$about,$space,$from,$to,$room_hotel,$id_user,$fac,$mini,$medium,$full)
	{
		$last_id=$this->db->insert_id();
		$sql = "UPDATE rooms
				SET room_name='$name',
				room_category='$category',
				room_about='$about',
				room_space='$space',
				room_from='$from',
				room_facilities='$fac',
				room_to='$to',
				room_hotel='$room_hotel',
				mini_price='$mini',
				medium_price='$medium',
				full_price='$full'
			    WHERE room_id='$last_id'";
		$this->db->query($sql);
		$sql2 = "INSERT INTO users_room (id_user,id_room) 
				 VALUES ('$id_user','$last_id')";
		$this->db->query($sql2);
	}
	public function get_room_facilities(){
		$upit=$this->db->query("SELECT room_facilities
								FROM rooms WHERE room_id='17'");
		return $upit->result_array();
	}
	public function get_all_rooms_for_hotel($hotel_id){
		$upit=$this->db->query("SELECT * 
								FROM  rooms AS r
								JOIN room_category c ON r.room_category = c.id_category
								WHERE room_hotel ='$hotel_id'");
		return $upit->result_array();
	}
	public function get_room_by_id($room_id) {
		$query=$this->db->query("SELECT *
								 FROM rooms
								 WHERE room_id = '$room_id'");
		return $query->row_array();
	}


	
}
