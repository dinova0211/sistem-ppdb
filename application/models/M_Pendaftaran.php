<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pendaftaran extends CI_Model
{
    private $_table = "pendaftaran";

    public function getAll()
    {
        $result = $this->db->select('*')
        ->from('pendaftaran')
        ->join('siswa', 'siswa.id_siswa = pendaftaran.siswa_id')
        ->join('jurusan', 'jurusan.id_jurusan = pendaftaran.jurusan_id')
        ->get()->result();
        return $result;
    }
}