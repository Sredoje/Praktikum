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
	public function get_hotel() {
		$hotel_id=$_POST['id'];

		$this->load->model('hotel_model');
		$data['hotel']=$this->hotel_model->get_hotel($hotel_id);
		$data['num_rows']=$this->hotel_model->get_hotel_num_rows();
		$data['row']=$hotel_id;
		echo json_encode($data);
	}
	

}

