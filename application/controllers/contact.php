<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {
	public function show_contact() {
		$this->load->view('contact');
	}
	public function send_mail() {
		$this->load->library('email');
		$mail = $this->input->post('email');
		$name = $this->input->post('name');
		$message = $this->input->post('message');
		$this->email->from($mail, $name);
		$this->email->to('sredojecutovic@gmail.com'); 
		$this->email->subject('Hotels mail');
		$this->email->message($message);	


		$this->email->send();
		$data['message'] = "Succesfully sent mail";
		$this->load->view('contact',$data);
	}
}


