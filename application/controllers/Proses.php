<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Load library phpspreadsheet
// require 'assets/vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Csv;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\IOFactory;

class Proses extends CI_Controller
{

  private $_tabel = "data";

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Model_input', 'model_input');
  }

  public function index()
  {
    if ($this->session->userdata('authenticated')) // Jika user sudah login (Session authenticated ditemukan)
      redirect('Page'); // Redirect ke page welcome
    $this->load->view('proses.php'); // Load view login.php
  }

  public function geneAlgo($id)
  {
    $_path = "assets/upload/data/";
    $namaCSV = $this->model_input->get_input_by_id($id)->result_array();
    $namaCSV = $namaCSV[0]['csv'];
    $nama = explode('.', $namaCSV, 2);
    $data['csv'] = $nama[0];
    $data['url'] = base_url() . $_path . $namaCSV;
    $this->load->view('proses', $data);
  }
}


/* End of file Proses.php */
/* Location: ./application/controllers/Proses.php */