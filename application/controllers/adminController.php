<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class adminController extends CI_Controller {
    
	public function index()
	{
		$this->load->view('admin/index.php');
	}
}
