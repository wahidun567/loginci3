<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        // $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        // echo'selamat datang ' . $data['user']['name'];
        $data = [
            'user' => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
            'title' => 'Welcome Back'
        ];

        $this->load->view('/templates/sidebar', $data);
        $this->load->view('/templates/topbar', $data);
        $this->load->view('/user/index', $data);
        $this->load->view('/templates/footbar', $data);
    }
}
