<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class siswaController extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		$this->load->model('m_Siswa');
		$this->load->model('m_jurusan');
		$this->load->model('m_pendaftaran');
		$this->load->library('form_validation');
	}

	public function login()
	{
		$this->load->view('siswa/login');
	}

	public function register()
	{
		$this->load->view('siswa/register');
	}

	public function dataDiri() 
	{
		$data = $this->m_Siswa->ambilData($this->session->userdata['nisn']);
		$this->load->view('siswa/dataDiri', $data);
	}

	
	public function dashboard()
	{
		$data = $this->m_Siswa->ambilData($this->session->userdata['nisn']);
		$_data = array(
			'nisn' => $data->nisn,
			'nama' => $data->nama
		);
		$this->load->view('siswa/index', $_data);
	}
	
	public function insertSiswa()
	{
		$this->form_validation->set_rules('nisn', 'nisn', 'required',['required' => 'NISN wajib diisi !']);
		$this->form_validation->set_rules('nama', 'nama', 'required', ['required' => 'Nama wajib diisi !']);
		$this->form_validation->set_rules('email', 'email', 'required',['required' => 'Email wajib diisi !']);
		$this->form_validation->set_rules('sandi', 'sandi', 'required', ['required' => 'Password wajib diisi !']);
		$siswa = $this->M_Siswa;
		
		if($this->form_validation->run() == FALSE) {
			$this->load->view('siswa/register');
		}else{
			$siswa->save();
			$this->session->set_flashdata('pesan', '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data berhasil di tambahkan !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				$this->session->set_flashdata('seconds_redirect', 5);
				
				$this->session->set_flashdata('url_redirect', base_url('siswaController/login'));
				
				redirect('siswaController/login');
		}
	}
		
	public function updateDataDiri($id)
	{
		$where = array('id_siswa' => $id);
		$data['siswa'] = $this->m_Siswa->editData($where, 'siswa')->result();
		$this->load->view('siswaController/dataDiri', $data);
	}
		
	public function updateDataDiriAksi()
	{
		$id = $this->input->post('id_siswa');
		$alamat = $this->input->post('alamat');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$nomor_hp = $this->input->post('nomor_hp');
		$agama = $this->input->post('agama');
		$asal_smp = $this->input->post('asal_smp');
		
		$data = array(
			'alamat' => $alamat,
			'tempat_lahir' => $tempat_lahir,
			'tanggal_lahir' => $tanggal_lahir,
			'jenis_kelamin' => $jenis_kelamin,
			'nomor_hp' => $nomor_hp,
			'agama' => $agama,
			'asal_smp' => $asal_smp
		);
		
		$where = array(
			'nisn' => $this->session->userdata('nisn')
		);

		$this->m_Siswa->updateData($where,$data,'siswa');
		
		$this->session->set_flashdata('pesan', '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data berhasil di tambahkan !
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('siswaController/dataDiri');	
			}
			
			public function loginSiswa()
			{
				$this->form_validation->set_rules('nisn', 'nisn', 'required',['required' => 'NISN wajib diisi !']);
				$this->form_validation->set_rules('sandi', 'sandi', 'required', ['required' => 'Password wajib diisi !']);
				
		if($this->form_validation->run() == FALSE) {
			$this->load->view('siswa/login');
		}else{
			
			$nisn = $this->input->post('nisn');
			$sandi = $this->input->post('sandi');

			$n = $nisn;
			$s = md5($sandi); 
			$cek = $this->m_Siswa->cekLogin($n, $s);
			
			if($cek->num_rows() > 0){
				foreach($cek->result() as $ck){
					$sess_data['nisn'] = $ck->nisn;
					$this->session->set_userdata($sess_data);
				}
				redirect('siswaController/dashboard');
			}else{
				$this->session->set_flashdata('pesan', 
					'<div class="alert alert-danger alert-dismissible fade show" role="alert">
					NISN dan Password Anda salah !
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
					redirect('siswaController/login');
				}
			
			}
			
		}
		
	public function registrasiPendaftaran()
	{
		$data['jurusan'] = $this->m_jurusan->getAll();
		$data['siswa'] = $this->m_Siswa->ambilData($this->session->userdata['nisn']);
		// $data['pendaftar'] = $this->m_pendaftaran->getByid($data['siswa']->id_siswa);
		$data['pendaftar'] = $this->m_pendaftaran->getAll();
		$cek=false;
		foreach($data['pendaftar'] as $d)
		{
			if($d->siswa_id == $data['siswa']->id_siswa)
			{
				$cek=true;
			}
		}
		if($cek)
		{
			// redirect('siswaController/dashboard');
			$this->load->view('siswa/terdaftar',$data['siswa']);
		}
		else
		{
			
			$this->load->view('siswa/registrasiPendaftaran',$data);
		}
	}
	
	public function aksiDaftar()
	{
		$data = $this->m_Siswa->ambilData($this->session->userdata['nisn']);
		$siswa_id = $data->id_siswa;
		$pendaftaran = $this->m_pendaftaran;
		$pendaftaran->insertDaftar($siswa_id);
		$post = $this->input->post();
		redirect('siswaController/registrasiPendaftaran', $_data);
		
	}
	
	public function logoutSiswa()
	{
		$this->session->sess_destroy();
		redirect('siswaController/login');
	}
	
}
