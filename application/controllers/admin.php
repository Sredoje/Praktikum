<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	public function show_admin() {
		$this->load->model('users_model');
		$data['moderators'] = $this->users_model->get_all_moderators();
		$this->load->view('admin',$data);
	}
	public function moderator_valid() {
			$this->load->model('users_model');
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
		$this->users_model->remove_moderator($this->input->post('remove_mod'));
		$data['message'] = "Successfully removed moderator";
		$data['moderators'] = $this->users_model->get_all_moderators();
		$this->load->view('admin',$data);
	}

}
/* End of file admin.php */
/* Location: ./application/controllers/hotel.php */

