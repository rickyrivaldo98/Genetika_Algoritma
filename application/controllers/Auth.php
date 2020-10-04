<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{

    private $_table = "user";

    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
    }
    public function index()
    {
        if ($this->session->userdata('authenticated')) // Jika user sudah login (Session authenticated ditemukan)
            redirect('Page'); // Redirect ke page welcome
        $this->load->view('login.php'); // Load view login.php
    }
    public function login()
    {
        $Username = $this->input->post('username', TRUE);
        $Password = $this->input->post('password', TRUE);
        $user = $this->LoginModel->get($Username);

        $validate = $this->LoginModel->validate($Username, $Password);

        if (empty($user)) {
            $this->session->set_flashdata('message', 'Login Gagal, Username atau Password Salah');
            redirect('auth');
        } else {
            date_default_timezone_set('Asia/Jakarta');

            if ($validate->num_rows() > 0) {
                $data = $validate->row_array();
                $user_name = $data['user_name'];
                $name = $data['name'];
                $level = $data['user_level'];
                $id = $data['user_id'];

                $session = array(
                    'authenticated' => true,
                    'username' => $user_name,
                    'name' => $name,
                    'level' => $level,
                    'logged_in' => TRUE,
                    'id' => $id
                );
                $this->session->set_userdata($session);

                // access login for admin
                if ($level === '1') {
                    redirect('Page');
                    // access login for staff
                } elseif ($level === '2') {
                    redirect('Page');
                }
            } else {
                $this->session->set_flashdata('message', 'Password Salah');
                redirect('auth');
            }
        }
    }
    public function logout()
    {
        $this->session->sess_destroy(); // Hapus semua session
        redirect('auth'); // Redirect ke halaman login
    }
}
