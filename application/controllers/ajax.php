<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {


	public function index()
	{
		$this->load->view('index_view');
	}
	public function get_hotel_all()
	{
		$this->load->model('hotel_model');
		$id_hotel=$_POST['podaci'];
		$rez=$this->hotel_model->get_hotel_by_id($id_hotel); 
		foreach ($rez as $red)
	    {
			echo $red['ime'].",".$red['tekst'];
		}
	}
	

}

