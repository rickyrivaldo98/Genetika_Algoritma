<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Page extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_input', 'model_input');
        $this->load->library('upload');
        $this->load->helper(array('form', 'url'));
    }
    public function index()
    {
        $data['input'] = $this->model_input->get_all_data();
        $this->load->view("dashboard", $data);
    }

    public function tambahinput()
    {
        $this->load->view("tambahinput");
    }

    public function editinput($id)
    {
        $data['input'] = $this->model_input->get_input_by_id($id)->result();

        $this->load->view("editinput", $data);
    }

    public function save()
    {
        $judul = $this->input->post('judul', TRUE);
        $this->model_input->insert_input($judul);
        $this->session->set_flashdata('success', 'Input Berhasil Ditambah');
        redirect(base_url() . 'Page');
    }

    public function edit()
    {
        $id = $this->input->post('id', TRUE);
        $judul = $this->input->post('judul', TRUE);
        $this->model_input->edit_input($judul, $id);
        $this->session->set_flashdata('info', 'Input Berhasil Diubah');
        redirect(base_url() . 'Page');
    }

    public function delete($id)
    {
        $this->model_input->delete_input($id);
        $this->session->set_flashdata('danger', 'Input Berhasil Dihapus');
        redirect('Page');
    }
}
