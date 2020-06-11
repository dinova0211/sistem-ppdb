<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class JurusanController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_Jurusan");
        $this->load->library('form_validation');
        
        if($this->session->userdata('nip') != "12345678"){
			redirect("adminController/login");
		}
    }

    public function index()
    {
        $data["jurusan"] = $this->M_Jurusan->getAll();
        $this->load->view("admin/pages/jurusan/index", $data);
    }

    public function add()
    {
        $jurusan = $this->M_Jurusan;
        $validation = $this->form_validation;
        $validation->set_rules($jurusan->rules());

        if ($validation->run()) {
            $jurusan->save();
            redirect('JurusanController/index');
        }

        $this->load->view("admin/pages/jurusan/add");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('JurusanController/index');
       
        $jurusan = $this->M_Jurusan;
        $validation = $this->form_validation;
        $validation->set_rules($jurusan->rules());

        if ($validation->run()) {
            $jurusan->update();
            // $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('JurusanController/index');
        }

        $data["jurusan"] = $jurusan->getById($id);
        if (!$data["jurusan"]) show_404();
        
        $this->load->view("admin/pages/jurusan/edit", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->M_Jurusan->delete($id)) {
            redirect('JurusanController/index');
        }
    }
}