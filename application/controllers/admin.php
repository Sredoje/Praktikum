<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	public function show_admin() {
		$this->load->model('users_model');
		$this->load->model('room_model');
		$data['moderators'] = $this->users_model->get_all_moderators();
		$data['slider_pictures'] = $this->room_model->get_slider_pictures();
		$this->load->view('admin',$data);
	}
	public function moderator_valid() {
			$this->load->model('users_model');
			$this->load->model('room_model');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('mod_name', 'Username', 'required|callback_proveri_zapise');
		//callback function mora da vrati true da bi se ceo form_validation ispunio a ako vrati false onda se ispisuje $this->form_validation->set_message('proveri_zapise','Wrong username//password');
			$this->form_validation->set_rules('mod_pass', 'Password', 'required');
			if($this->form_validation->run()){

				$data['message'] = "Successfully added moderator";
				
				$this->users_model->insert_user($this->input->post('mod_name'),$this->input->post('mod_pass'),2);
				$data['moderators'] = $this->users_model->get_all_moderators();
				$this->load->view('admin',$data);

			}
			else{

				$data['message'] = "User already exist";
				$data['moderators'] = $this->users_model->get_all_moderators();
				$data['slider_pictures'] = $this->room_model->get_slider_pictures();
				$this->load->view('admin',$data);
			}

		}
	public function proveri_zapise(){
			$this->load->model('users_model');
			
			if($this->users_model->mod_exist()){
				return true;
			}
			else{
				$this->form_validation->set_message('proveri_zapise','Wrong username or password');
				return false;
			}
	}
	public function remove_moderator() {
		$this->load->model('users_model');
		$this->load->model('room_model');
		$this->users_model->remove_moderator($this->input->post('remove_mod'));
		$data['message'] = "Successfully removed moderator";
		$data['moderators'] = $this->users_model->get_all_moderators();
		$data['slider_pictures'] = $this->room_model->get_slider_pictures();
		$this->load->view('admin',$data);
	}
	public function do_upload2()
	{

		$field_name="slider_image";
		$config['upload_path'] = './img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['width']	 = 960;
		$config['height']	= 380;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload($field_name))
		{
			$this->load->model('users_model');
			$this->load->model('room_model');
			$data["message"]="Error while uploading slider picture, please check file type and size!";
			$data['moderators'] = $this->users_model->get_all_moderators();
			$data['slider_pictures'] = $this->room_model->get_slider_pictures();
			$this->load->view('admin',$data);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$fajl=$this->upload->data();
			$this->load->model('room_model');
			$this->load->model('users_model');
			$this->room_model->add_slider_picture($fajl['file_name']);
			$data["message"]="Successfully uploaded slider picture!";
			$data['moderators'] = $this->users_model->get_all_moderators();
			$data['slider_pictures'] = $this->room_model->get_slider_pictures();
			$this->load->view('admin',$data);
		}
	}
	public function delete_slider($id_slider) {
		$this->load->model('room_model');
		$this->load->model('users_model');
		$this->room_model->delete_slider($id_slider);
		$data["message"]="Successfully deleted slider picture!";
		$data['moderators'] = $this->users_model->get_all_moderators();
		$data['slider_pictures'] = $this->room_model->get_slider_pictures();
		$this->load->view('admin',$data);
	}


}
/* End of file admin.php */
/* Location: ./application/controllers/hotel.php */

