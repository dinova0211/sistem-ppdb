<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class adminController extends CI_Controller {
    
	public function index()
	{
		$this->load->view('admin/pages/login.php');
	}

	public function loginProses(){
		$username = $this->input->post('nip');
		$password = $this->input->post('password');

		if($username == '12345678' && $password == 'admin'){
 
			$data_session = array(
				'nip' => $username
			);
 
			$this->session->set_userdata($data_session);
 
			redirect("jurusanController/index");
 
		}else{
			echo "Username dan password salah !";
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('adminController');
	}
}
