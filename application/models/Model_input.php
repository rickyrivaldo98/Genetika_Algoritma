<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_input extends CI_Model
{

    public $id_data;
    // fungsi untuk menginput data ke database
    function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    // fungsi untuk mengedit data
    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    // fungsi untuk mengupdate atau mengubah data di database
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    // fungsi untuk menghapus data dari database
    function delete_data($where, $table)
    {
        $this->db->delete($table, $where);
    }

    function delete_all($table)
    {
        $this->db->empty_table($table);
    }

    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }
    function insert_multiple($data, $table)
    {
        $this->db->insert_batch($table, $data);
    }


    function insert_input($judul)
    {
        $this->id = $this->input->post('id');
        $this->id_data = uniqid();
        $this->CSV = $this->_uploadCSV();
        $data = array(
            'id' => $this->id,
            'nama'    => $judul,
            'csv' => $this->CSV,
        );
        $this->db->insert('data', $data);
    }

    function edit_input($judul, $id)
    {
        $this->db->where('id', $id);
        $this->id_data = $this->input->post('old_data');
        // $thumbnail = $_FILES["thumbnail"]["name"];
        if (!empty($_FILES["CSV"]["name"])) {
            $this->CSV = $this->_uploadCSV();
        } else {
            $this->CSV = $this->input->post('old_data');
        };
        $data = array(
            'nama'    => $judul,
            'csv' => $this->CSV,
        );
        $this->db->update('data', $data);
    }

    public function _uploadCSV()
    {
        $config['upload_path']          = './assets/upload/data/';
        $config['allowed_types']        = 'csv';
        $config['file_name']            = $this->id_data;
        $config['overwrite']            = TRUE;
        $config['max_size']             = 5000; // 1MB
        $this->upload->initialize($config);

        $this->load->library('upload', $config);

        // if ($this->upload->do_upload('CSV')) {
        //     return $this->upload->data("file_name");
        // }
        if (!$this->upload->do_upload('CSV')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);
            redirect('Page', 'refresh');
        } else {
            $CSV = $this->upload->data();
            $result  = array('csv' => $CSV);
            $file = $result['csv']['file_name'];
            return $file;
        }
    }

    function get_input_by_id($id)
    {
        $query = $this->db->get_where('data', array('id' =>  $id));
        return $query;
    }

    //ini untuk admin nampilin semua artikel sesuai siapa yg bikin
    function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('data');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function delete_input($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('data');
    }
}
