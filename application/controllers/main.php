<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {


	public function index()
	{
		
		$this->load->model('room_model');
		$data['pictures'] = $this->room_model->get_slider_pictures();
		$this->load->view('index_view',$data);
	}
	//prikazuje login_view
	
	//prosledjujem red za koji hotel zelim da ucitam .. on se u view povecava za 1 na next a smanjuje za 1 u prev // u sustini stranicenje za 1 unos 
	public function show_hotels($red)
	{
		$this->load->model('hotel_model');
		$data['hotel']=$this->hotel_model->get_hotel($red);
		$data['red']=$red;
		$data['num_rows']=$this->hotel_model->get_hotel_num_rows();
		$this->load->view('hotel-single',$data);
	}



	public function show_rooms()
	{
		$this->load->view('rooms');
	}
	public function show_room()
	{
		$this->load->view('room');	
	}
	public function show_contact()
	{
		$this->load->view('contact');
	}
	public function show_register()
	{
		$this->load->view('register');
	}
	public function show_login()
	{
		$this->load->view('login');
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
	public function show_admin()
	{
		if($this->session->userdata['uloga']!=1)
		{
			redirect('/main/restricted');
		}
		else
		{
			$this->load->view('admin');	
		}

	}

		
	//metoda za proveru logovanja
	public function valja()
	{
		if($this->session->userdata('je_logovan'))
		{
			$this->load->view('valja_view');
		}
		else
		{
			redirect('main/restricted');
		}
	}
	

	//logout metoda - brisanje sesije
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('main');
	}

	}

