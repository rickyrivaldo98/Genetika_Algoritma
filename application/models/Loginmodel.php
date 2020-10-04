<?php
class LoginModel extends CI_Model
{

    function validate($username, $password)
    {
        $this->db->where('user_name', $username);
        $this->db->where('user_password', $password);
        $result = $this->db->get('user', 1);
        return $result;
    }

    public function get($Username)
    {
        $this->db->where('user_name', $Username); // Untuk menambahkan Where Clause : username='$username'
        $result = $this->db->get('user')->row(); // Untuk mengeksekusi dan mengambil data hasil query
        return $result;
    }
}
