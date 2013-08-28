<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room extends CI_Controller 
{
	public function show_rooms($hotel_id)
	{
		$this->load->model('room_model');
		$this->load->model('hotel_model');
		$data['rooms']=$this->room_model->get_all_rooms_for_hotel($hotel_id);
		$data['hotels']=$this->hotel_model->all_hotels();
		$data['hotel_id']=$hotel_id;

		$this->load->view('rooms',$data);
	}
	public function show_room($room_id) {
		$this->load->model('room_model');
		$this->load->model('hotel_model');
		$data['room']=$this->room_model->get_room_by_id($room_id);
		$data['room_pictures']=$this->room_model->get_room_pictures($room_id);
		$hotel_id=$this->room_model->get_hotel_id($room_id);
		$data['booked_rooms'] = $this->room_model->books_by_room($room_id);
		$data['hotel_action']=$this->hotel_model->get_actions($hotel_id[0]['room_hotel']);
		$this->load->view('room',$data);
		// $data['room_facilities']=$this->room_model->get_room_facilities();
		 
            
       
	}
	public function show_hotels($row)
	{
		$this->load->model('hotel_model');
		$data['hotel']=$this->hotel_model->get_hotel($row);
		$data['num_rows']=$this->hotel_model->get_hotel_num_rows();
		$data['row']=$row;
		$this->load->view('hotel-single',$data);
	}
	public function show_moderator()
	{
		$this->load->model('hotel_model');
		$this->load->model('room_model');
		$data['all_hotels_from_user']=$this->hotel_model->all_hotel_by_user($this->session->userdata['id_usera']);
		$data['all_rooms_from_user']=$this->room_model->all_rooms_from_user($this->session->userdata['id_usera']);
		$data['room_category']=$this->room_model->get_room_category();
		$this->load->view('moderator',$data);

	}
	//validacija unosa sobe	
	function form_room_valid()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('room_name', 'Room name', 'required|min_length[6]|callback_proveri_zapise_rooma');
		$this->form_validation->set_rules('room_about', 'About room', 'required|min_length[10]');
		$this->form_validation->set_rules('room_space', 'Room space', 'required|integer');
		$this->form_validation->set_rules('room_from', 'Room from', 'required|integer');
		$this->form_validation->set_rules('room_to', 'Room to', 'required|integer'); 
		$this->form_validation->set_rules('mini_price', 'Room mini packet cost', 'required|integer');
		$this->form_validation->set_rules('medium_price', 'Room medium packet cost', 'required|integer');
		$this->form_validation->set_rules('full_price', 'Room full packet cost', 'required|integer');
		
		$roomime=$this->input->post('room_name');
		if($this->form_validation->run())
		{
			if(!$this->do_upload2())
			{
				$data['hotel_message']="<p>Error at uploading room picture. Check type and size</p>";
				$this->load->model('hotel_model');
				$this->load->model('room_model');
				$data['all_hotels_from_user']=$this->hotel_model->all_hotel_by_user($this->session->userdata['id_usera']);
				$data['room_category']=$this->room_model->get_room_category();
				$this->load->view('moderator',$data);
			}
			else
			{
				$data['hotel_message']="<p>Succesfully added room, you should add some pictures to your room<br></p>";
				$this->load->model('room_model');
				$this->load->model('hotel_model');
				$facilities=$this->serialize_facilities();
				$this->room_model->unesi_room_ceo($this->input->post('room_name'),$this->input->post('room_category'),$this->input->post('room_about'),$this->input->post('room_space'),$this->input->post('room_from'),$this->input->post('room_to'),$this->input->post('room_hotel'),$this->session->userdata['id_usera'],$facilities,$this->input->post('mini_price'),$this->input->post('medium_price'),$this->input->post('full_price'));
				$data['all_hotels_from_user']=$this->hotel_model->all_hotel_by_user($this->session->userdata['id_usera']);
				$data['all_rooms_from_user']=$this->room_model->all_rooms_from_user($this->session->userdata['id_usera']);
				$data['room_category']=$this->room_model->get_room_category();
				$this->load->view('moderator',$data);
			}
		}
		else
		{
			$this->show_moderator();
		}
			
	}
	public function edit_room_valid() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('edit_room_name', 'Room name', 'required|min_length[6]');
		$this->form_validation->set_rules('edit_room_about', 'About room', 'required|min_length[10]');
		$this->form_validation->set_rules('edit_room_space', 'Room space', 'required|integer');
		$this->form_validation->set_rules('edit_room_from', 'Room from', 'required|integer');
		$this->form_validation->set_rules('edit_room_to', 'Room to', 'required|integer'); 
		$this->form_validation->set_rules('edit_mini_price', 'Room mini packet cost', 'required|integer');
		$this->form_validation->set_rules('edit_medium_price', 'Room medium packet cost', 'required|integer');
		$this->form_validation->set_rules('edit_full_price', 'Room full packet cost', 'required|integer');
		if($this->form_validation->run()) {
				$data['hotel_message']="<p>Succesfully edited room<br></p>";
				$this->load->model('room_model');
				$this->load->model('hotel_model');
				$facilities=$this->edit_serialize_facilities();
				$this->room_model->edit_room_ceo($this->input->post('edit_room_name'),$this->input->post('edit_room_category'),$this->input->post('edit_room_about'),$this->input->post('edit_room_space'),$this->input->post('edit_room_from'),$this->input->post('edit_room_to'),$this->input->post('edit_room_hotel'),$this->session->userdata['id_usera'],$facilities,$this->input->post('edit_mini_price'),$this->input->post('edit_medium_price'),$this->input->post('edit_full_price'),$this->input->post('edit_room_select'));
				$data['all_hotels_from_user']=$this->hotel_model->all_hotel_by_user($this->session->userdata['id_usera']);
				$data['all_rooms_from_user']=$this->room_model->all_rooms_from_user($this->session->userdata['id_usera']);
				$data['room_category']=$this->room_model->get_room_category();
				$this->load->view('moderator',$data);
		}
		else
		{
			$this->show_moderator();
		}

	} 
	public function serialize_facilities(){
		$facilities=$this->input->post('room_facilities');
		$facilities_string="";

		// for ($i=0; $i < count($facilities); $i++) { 
		// 	$facilities_string=$facilities[i];
		// }
		
		return serialize($facilities);
	}
	public function edit_serialize_facilities(){
		$facilities=$this->input->post('edit_room_facilities');
		$facilities_string="";

		// for ($i=0; $i < count($facilities); $i++) { 
		// 	$facilities_string=$facilities[i];
		// }
		
		return serialize($facilities);
	}
	//metoda za unos slike sobe
	function do_upload2()
	{

		$field_name="room_picture";
		$config['upload_path'] = './img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		// $config['max_width']  = '10240';
		// $config['max_height']  = '7680';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload($field_name))
		{
			return false;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$fajl=$this->upload->data();
			$this->load->model('room_model');
			$this->room_model->unesi_room_sliku($fajl['file_name']);
			return true;
		}
	}
	function do_upload3(){
		$room_id=$this->input->post('add_room_pictures');
		$field_name = "room_pictures";
		$config['upload_path'] = './img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['width']	 = 175;
		$config['height']	= 120;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($field_name))
		{

			$data['hotel_message']="<p>Error uploading room pictures<br></p>";
			$this->load->model('room_model');
			$this->load->model('hotel_model');
			$facilities=$this->edit_serialize_facilities();
			$this->room_model->edit_room_ceo($this->input->post('edit_room_name'),$this->input->post('edit_room_category'),$this->input->post('edit_room_about'),$this->input->post('edit_room_space'),$this->input->post('edit_room_from'),$this->input->post('edit_room_to'),$this->input->post('edit_room_hotel'),$this->session->userdata['id_usera'],$facilities,$this->input->post('edit_mini_price'),$this->input->post('edit_medium_price'),$this->input->post('edit_full_price'),$this->input->post('edit_room_select'));
			$data['all_hotels_from_user']=$this->hotel_model->all_hotel_by_user($this->session->userdata['id_usera']);
			$data['all_rooms_from_user']=$this->room_model->all_rooms_from_user($this->session->userdata['id_usera']);
			$data['room_category']=$this->room_model->get_room_category();
			$this->load->view('moderator',$data);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$fajl=$this->upload->data();
			$this->load->model('room_model');
			$this->room_model->add_room_pictures($fajl['file_name'],$room_id);
			$data['hotel_message']="<p>Succesfully added room picture<br></p>";
			$this->load->model('hotel_model');
			$facilities=$this->edit_serialize_facilities();
			$this->room_model->edit_room_ceo($this->input->post('edit_room_name'),$this->input->post('edit_room_category'),$this->input->post('edit_room_about'),$this->input->post('edit_room_space'),$this->input->post('edit_room_from'),$this->input->post('edit_room_to'),$this->input->post('edit_room_hotel'),$this->session->userdata['id_usera'],$facilities,$this->input->post('edit_mini_price'),$this->input->post('edit_medium_price'),$this->input->post('edit_full_price'),$this->input->post('edit_room_select'));
			$data['all_hotels_from_user']=$this->hotel_model->all_hotel_by_user($this->session->userdata['id_usera']);
			$data['all_rooms_from_user']=$this->room_model->all_rooms_from_user($this->session->userdata['id_usera']);
			$data['room_category']=$this->room_model->get_room_category();
			$this->load->view('moderator',$data);
		}
	}

	public function proveri_zapise_rooma()
	{
		$this->load->model('room_model');
		if($this->room_model->valja_zapis())
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('proveri_zapise_rooma','That room already exists!');
			return false;
		}
	}
	public function delete_room_picture($id,$filename) {
		$this->load->model('room_model');
		$this->load->model('hotel_model');
		$this->room_model->delete_room_picture($id,$filename);
		$data['hotel_message']="<p>Succesfully deleted room picture<br></p>";
		$data['all_hotels_from_user']=$this->hotel_model->all_hotel_by_user($this->session->userdata['id_usera']);
		$data['all_rooms_from_user']=$this->room_model->all_rooms_from_user($this->session->userdata['id_usera']);
		$data['room_category']=$this->room_model->get_room_category();
		$this->load->view('moderator',$data);
	}
	//Booking room
	public function book_room($room_id) {
		$this->load->model('room_model');
		$from = $this->input->post('from');
		$to = $this->input->post('to');
		$packet = $this->input->post('packet');
		$all_booked_rooms = $this->room_model->books_by_room($room_id);
		$data['book_errors']=array();
		$data['book_errors'] = array('succes'=>true );
		foreach ($all_booked_rooms as $booked_room) {
			$from_booked = strtotime($booked_room['from']);
			$to_booked = strtotime($booked_room['to']);
			$current_from = strtotime($from);
			$current_to = strtotime($to);
			
			if($current_from < $from_booked && $current_to < $from_booked || $current_from > $to_booked && $current_to > $to_booked) {
				$data['book_errors'] = array('error_from' =>$booked_room['from'] ,'error_to' =>$booked_room['to'],'succes'=>true );
				
			}
			else {
				$data['book_errors'] = array('error_from' =>$booked_room['from'] ,'error_to' =>$booked_room['to'],'succes'=>false );
				break;
				
			}

		}
		if($data['book_errors']['succes']===true) {
			$data['test']="";
			$user_id=$this->session->userdata['id_usera'];
			$this->room_model->add_booked_room($room_id,$from,$to,$packet,$user_id);
		}
		else {
			$data['test']= "nije uspeo";
		}

		$this->load->model('hotel_model');
		$data['room']=$this->room_model->get_room_by_id($room_id);
		$data['room_pictures']=$this->room_model->get_room_pictures($room_id);
		$hotel_id=$this->room_model->get_hotel_id($room_id);
		$data['hotel_action']=$this->hotel_model->get_actions($hotel_id[0]['room_hotel']);
		$data['booked_rooms'] = $this->room_model->books_by_room($room_id);
		$this->load->view('room',$data);

	}
	public function make_pdf()
	 {
	 	$this->load->model('room_model');
	 	$this->load->model('hotel_model');
	 	$this->load->model('users_model');
	 	$data['booked'] = $this->room_model->get_last_booked();
	 	$booked = $data['booked'][0];
	 	$data['room'] = $this->room_model->get_room_by_id($booked['room_id']);
	 	$data['action'] = $this->hotel_model ->get_actions($data['room']['room_hotel']);
	 	$data['hotel'] = $this->hotel_model -> get_hotel_by_id($data['room']['room_hotel']);
	 	$data['user'] = $this->users_model->get_user_by_id($booked['id_user']);
	 	$data['actual_data'] = array();
	 	$start = strtotime($booked['from']);
		$end = strtotime($booked['to']);
		$days_between = ceil(abs($end - $start) / 86400);
	 	if(empty($data['action'])){
	 		$data['test'] = "NEMA AKCIJA";
	 		$packet=$booked['packet'];
	 		$cost=$days_between*$data['room'][$packet.'_price'];
	 		$data['actual_data'] = array(
	 		'from' => $booked['from'],
	 		'to' => $booked['to'],
	 		'hotel' =>$data['hotel'][0]['ime'],
	 		'room' =>$data['room']['room_name'],
	 		'days'=>$days_between,
	 		'cost'=>$cost,
	 		'username'=>$data['user'][0]['username']);
	 	}
	 	else {
	 		$data['proba'] = false;
	 		$data['test']="IMA AKCIJA";
	 		foreach ($data['action'] as $action) {
				$from_booked = strtotime( $booked['from']);
				$to_booked = strtotime($booked['to']);
				$action_from = strtotime($action['action_start_date']);
				$action_to = strtotime($action['action_end_date']);
				
				if($from_booked >= $action_from && $to_booked <= $action_to) {
					$data['proba'] = array(
						'from'=>$action['action_start_date'],
						'to'=>$action['action_end_date'],
						'mini'=>$action['action_mini'],
						'medium'=>$action['action_medium'],
						'full'=>$action['action_full']
						);	
					break;	
				}
			}

	 		$packet=$booked['packet'];
	 		if($data['proba']===false) {
	 			$cost=$days_between*$data['room'][$packet.'_price']."$";
	 		}
	 		else {
	 			$cost=$days_between*$data['proba'][$packet]. "$<br> Action price included";
	 		}
	 		$data['actual_data'] = array(
	 		'from' => $booked['from'],
	 		'to' => $booked['to'],
	 		'hotel' =>$data['hotel'][0]['ime'],
	 		'room' =>$data['room']['room_name'],
	 		'days'=>$days_between,
	 		'cost'=>$cost,
	 		'username'=>$data['user'][0]['username'] );

	 	}

	   	$this->load->helper('pdf_helper');
	   	$pdf_filename = "Hotel reservation";
	  	$prikaz = $this->load->view('pdf',$data,true);
	   	// $this->load->view('pdf',$data);
	  	generate_pdf($prikaz, $pdf_filename);	


	 }
	
	
}
/* End of file room.php */
/* Location: ./application/controllers/room.php */

