<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller 
{
	public function show_register() {
		$this->load->view('register');
	}
	public function register_valid() {

		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|callback_user_validation');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[repassword]');
		$this->form_validation->set_rules('repassword', 'Repeat Password', 'required|min_length[6]');
		$this->form_validation->set_rules('mail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('tel', 'Telephone', 'required|integer');
		if($this->form_validation->run())
		{

			$this->load->model('users_model');
			$this->users_model->insert_normal_user($this->input->post('username'),$this->input->post('password'),3,$this->input->post('mail'),$this->input->post('tel'),$this->input->post('address'));
			$data['message'] = "Succesfuly added user";
			$this->load->view('register',$data);

		}
		else
		{
			$this->show_register();
		}

	
	}
	public function user_validation()
	{
		$this->load->model('users_model');
		if($this->users_model->user_exist())
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('user_validation','That user already exists!');
			return false;
		}
	}	
	public function redirecting(){
		$uloga=$this->session->userdata['uloga'];
		if($uloga==1){
			$this->load->model('users_model');
			$data['moderators'] = $this->users_model->get_all_moderators();
			$this->load->view('admin',$data);
		}
		if($uloga==2){
			$this->show_moderator();
		}
		if($uloga==3){
			$this->load->view('korisnik');
		}
	}

}
/* End of file register.php */
/* Location: ./application/controllers/login.php */
