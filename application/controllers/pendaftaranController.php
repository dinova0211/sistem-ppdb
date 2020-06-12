<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class pendaftaranController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_Pendaftaran");
        $this->load->library('form_validation');
        if($this->session->userdata('nip') != "12345678"){
			redirect("adminController/login");
		}
    }

    public function index()
    {
        $data["pendaftaran"] = $this->M_Pendaftaran->getAll();
        $this->load->view("admin/pages/pendaftaran/index", $data);
    }

}
