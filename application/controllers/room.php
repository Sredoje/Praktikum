<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room extends CI_Controller 
{
	public function show_rooms($hotel_id)
	{
		$this->load->model('room_model');
		$this->load->model('hotel_model');
		$data['rooms']=$this->room_model->get_all_rooms_for_hotel($hotel_id);
		$data['hotels']=$this->hotel_model->all_hotels();
		$this->load->view('rooms',$data);
	}
	public function show_room($room_id) {
		$this->load->model('room_model');
		$data['room']=$this->room_model->get_room_by_id($room_id);
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
				$this->load->view('moderator',$data);
			}
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

	
}
/* End of file room.php */
/* Location: ./application/controllers/room.php */

