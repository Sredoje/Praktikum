<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Controller 
{

	public function show_hotels()
	{
		$row=0;
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
	
	//validacija unosa hotela
	public function form_hotel_valid()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('hotel_name', 'Hotel name', 'required|min_length[6]|callback_hotel_validation');
		$this->form_validation->set_rules('hotel_text', 'About hotel', 'required|min_length[10]');
		$hotelime=$this->input->post('hotel_name');
		if($this->form_validation->run())
		{
			if(!$this->do_upload())
			{
				$data['hotel_message']="<p>Error at uploading hotel picture. Check type and size</p>";
				$this->load->view('moderator',$data);
			}
			else
			{
				$data['hotel_message']="<p>Succesfully added hotel, you should add some rooms to your hotel<br></p>";
				$this->load->model('hotel_model');
				$this->hotel_model->insert_hotel($this->input->post('hotel_name'),$this->input->post('hotel_text'),$this->session->userdata['id_usera']);
				$data['all_hotels_from_user']=$this->hotel_model->all_hotel_by_user($this->session->userdata['id_usera']);
				$this->load->view('moderator',$data);
			}
		}
		else
		{
			$this->show_moderator();
		}

	}
	//validacija editovanja hotela
	public function form_hotel_edit()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('edit_name', 'Edited hotel name', 'required|min_length[6]');
		$this->form_validation->set_rules('edit_text', 'Edited about hotel', 'required|min_length[10]');
		$hotelime=$this->input->post('edit_name');

		if($this->form_validation->run())
		{
			$this->load->model('room_model');
			if(!$this->edit_upload($this->input->post('edit_select')))
			{
				$data['hotel_message']="<p>Error at uploading hotel picture. Check type and size</p>";
				$this->load->model('hotel_model');
				$data['all_hotels_from_user']=$this->hotel_model->all_hotel_by_user($this->session->userdata['id_usera']);
				$this->load->view('moderator',$data);
			}
			else
			{
				$data['hotel_message']="<p>Succesfully edited hotel<br></p>";
				$this->load->model('hotel_model');

				$this->hotel_model->edit_hotel($this->input->post('edit_name'),$this->input->post('edit_text'),$this->session->userdata['id_usera'],$this->input->post('edit_select'));
				$data['all_hotels_from_user']=$this->hotel_model->all_hotel_by_user($this->session->userdata['id_usera']);
				$data['room_category']=$this->room_model->get_room_category();
				$this->load->view('moderator',$data);
			}
		}
		else
		{
			$this->show_moderator();
		}
	}
	
	//metoda za upload slike hotela
	function do_upload()
	{
		$field_name="prva_slika";
		$config['upload_path'] = './img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($field_name))
		{
			return false;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$fajl=$this->upload->data();
			$this->load->model('hotel_model');
			$this->hotel_model->insert_hotel_picture($fajl['file_name']);
			return true;
		}
	}
	
	//metoda za edit sike hotela
	public function edit_upload($id_hotel)
	{
		$field_name="edit_slika";
		$config['upload_path'] = './img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload($field_name))
		{
			return false;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$fajl=$this->upload->data();
			$this->load->model('hotel_model');
			$this->hotel_model->edit_hotel_picture($fajl['file_name'],$id_hotel);
			return true;
		}
	}
// proverava da li vec postoji hotel sa tim imenom
	public function hotel_validation()
	{
		$this->load->model('hotel_model');
		if($this->hotel_model->validate_hotel_credentials())
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('hotel_validation','That hotel already exists!');
			return false;
		}
	}	
	public function add_hotel_action() {
		$this->load->model('hotel_model');
		$hotel_id=$this->input->post('action_hotel');
		$start_date=$this->input->post('action_start');
		$end_date=$this->input->post('action_end');
		$mini=$this->input->post('action_mini');
		$medium=$this->input->post('action_medium');
		$full=$this->input->post('action_full');
		$this->hotel_model->add_hotel_action($hotel_id,$start_date,$end_date,$mini,$medium,$full);

		$this->load->model('hotel_model');
		$this->load->model('room_model');
		$data['all_hotels_from_user']=$this->hotel_model->all_hotel_by_user($this->session->userdata['id_usera']);
		$data['all_rooms_from_user']=$this->room_model->all_rooms_from_user($this->session->userdata['id_usera']);
		$data['room_category']=$this->room_model->get_room_category();
		$data['hotel_message']="<p>Succesfully added action<br></p>";
		$this->load->view('moderator',$data);

	}
	public function delete_hotel_action($action_id) {
		$this->load->model('hotel_model');
		$this->hotel_model->delete_action($action_id);
		$this->load->model('hotel_model');
		$this->load->model('room_model');
		$data['all_hotels_from_user']=$this->hotel_model->all_hotel_by_user($this->session->userdata['id_usera']);
		$data['all_rooms_from_user']=$this->room_model->all_rooms_from_user($this->session->userdata['id_usera']);
		$data['room_category']=$this->room_model->get_room_category();
		$data['hotel_message']="<p>Succesfully deleted action<br></p>";
		$this->load->view('moderator',$data);
	}

}
/* End of file hotel.php */
/* Location: ./application/controllers/hotel.php */

