<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_Jurusan extends CI_Model
{
    private $_table = "jurusan";

    public $id_jurusan;
    public $nama_jurusan;

    public function rules()
    {
        return [
            ['field' => 'nama_jurusan',
            'label' => 'jurusan',
            'rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id_jurusan" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $insert_id = $this->db->query('SELECT * FROM jurusan')->num_rows();
        $this->id_jurusan = $insert_id+1;
        $this->nama_jurusan = $post["nama_jurusan"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_jurusan = $post["id"];
        $this->nama_jurusan = $post["nama_jurusan"];
        return $this->db->update($this->_table, $this, array('id_jurusan' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_jurusan" => $id));
    }
}