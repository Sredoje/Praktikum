<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public function show_loginn(){
		$this->load->library('form_validation');
		$this->load->view('index_view');
	}
	public function show_login(){
		$this->load->view('login');
	}
	public function show_moderator()
	{
		$this->load->model('hotel_model');
		$this->load->model('room_model');
		$data['all_hotels_from_user']=$this->hotel_model->all_hotel_by_user($this->session->userdata['id_usera']);
		$data['room_category']=$this->room_model->get_room_category();
		$this->load->view('moderator',$data);
	}
	public function form_valid(){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_proveri_zapise');
		//callback function mora da vrati true da bi se ceo form_validation ispunio a ako vrati false onda se ispisuje $this->form_validation->set_message('proveri_zapise','Wrong username//password');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if($this->form_validation->run()){

				$this->load->model('users_model');
			//prosledjuje get_id() username kako bi dohvatio id_usera
				$id=$this->users_model->get_id($this->input->post('username'));
				$uloga=$this->users_model->get_uloga($this->input->post('username'));

				$data=array(
					'username' =>$this->input->post('username'),
					'je_logovan' =>1,
					'id_usera' =>$id,
					'uloga'=>$uloga,
					);
				$this->session->set_userdata($data);
				
				 redirect('/login/redirecting');


			}
			else{

				$this->load->view('login');

			}

		}
	public function proveri_zapise(){

			$this->load->model('users_model');
			if($this->users_model->valja_zapis()){
				return true;
			}
			else{
				$this->form_validation->set_message('proveri_zapise','Wrong username or password');
				return false;
			}
		}
	public function redirecting(){
		$uloga=$this->session->userdata['uloga'];
		if($uloga==1){
			$this->load->view('admin');
		}
		if($uloga==2){
			$this->show_moderator();
		}
		if($uloga==3){
			$this->load->view('korisnik');
		}
	}

}
/* End of file login.php */
/* Location: ./application/controllers/login.php */

