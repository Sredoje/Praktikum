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
	public function edit_room_ceo($name,$category,$about,$space,$from,$to,$room_hotel,$id_user,$fac,$mini,$medium,$full,$room_id)
	{
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
			    WHERE room_id='$room_id'";
		$this->db->query($sql);
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
	public function all_rooms_from_user($id_usera) {
		$query = $this->db->query("SELECT * 
								   FROM rooms r JOIN users_room ur 
								   ON r.room_id=ur.id_room 
								   WHERE ur.id_user='$id_usera'");
		return $query->result_array();
	}
	public function get_room_for_id($room_id) {
		$query=$this->db->query("SELECT *
								 FROM rooms
								 WHERE room_id = '$room_id'");
		return $query->result_array();
	}
	public function add_room_pictures($file_path,$room_id) {
		$query = "INSERT INTO room_pictures (room_id,picture_path) 
				VALUES ('$room_id','$file_path')";
		$this->db->query($query);
	}
	public function get_room_pictures($room_id) {
		$query=$this->db->query("SELECT *
				 FROM room_pictures
				 WHERE room_id='$room_id' "); 
		return $query->result_array();
	}
	public function delete_room_picture($id_room,$filename) {

		$this->db->delete('room_pictures', array('room_id' => $id_room, 'picture_path' => $filename)); 

	}
	public function get_hotel_id($room_id) {
		$query=$this->db->query("SELECT room_hotel
				 FROM rooms
				 WHERE room_id='$room_id' "); 
		return $query->result_array();
	}
	public function add_booked_room($room_id,$from,$to,$packet,$user_id) {
		$data = array(
		   'room_id' => $room_id ,
		   'from' => $from ,
		   'to' => $to ,
		   'packet' => $packet ,
		   'id_user'=> $user_id
		);
		$this->db->insert('room_booked', $data); 
	}
	public function books_by_room($room_id) {
		$query = $this->db->get_where('room_booked', array('room_id' => $room_id));
		return $query->result_array();
	}
	public function get_last_booked() {
		$this->db->select_max('book_id');
		$query = $this->db->get('room_booked');
		$data=$query->result_array();
		$sql = $this->db->get_where('room_booked', array('book_id' => $data[0]['book_id']));
		return $sql->result_array();
	}
	public function add_slider_picture($pathname) {
		$query = "INSERT INTO main_slider (slider_picture) 
				VALUES ('$pathname')";
		$this->db->query($query);
	}
	public function get_slider_pictures() {
		$query = $this->db->query("SELECT *
									FROM main_slider");
		return $query->result_array();
	}
	public function delete_slider($id_slider) {
		$this->db->delete('main_slider', array('id_slider' => $id_slider)); 
	}


	
}
