<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin890 extends CI_Controller
{
    public function index()
    {
        // $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        // echo'selamat datang ' . $data['user']['name'];
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title' => 'My Profile Admin'
        ];

        $this->load->view('/templates/sidebar', $data);
        $this->load->view('/templates/topbar', $data);
        $this->load->view('/admin/index', $data);
        $this->load->view('/templates/footbar', $data);
    }
}
