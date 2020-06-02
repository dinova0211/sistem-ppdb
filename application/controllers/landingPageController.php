<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class landingPageController extends CI_Controller {
    
	public function index()
	{
		$this->load->view('landingpage/landingPage.php');
	}
}