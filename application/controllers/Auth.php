<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
        /* pengkondisian */
        /* jika gagal tampilkan kondisi seperti ini =if= */
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Login Page!'
            ];
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_header');
            /* jika benar =else= tampilan masuk ke login submit validasi success */
        } else {
            $this->_login();
        }
    }




    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        /* pengkondisian untuk menyaring bisa masuk dengan email n password yang sudah ada jika null maka dikembalikan ke tampilan login dan disertai alert danger */
        /* penggunaan if bersarang */
        if ($user) {
            /* usernya ada maka tampilan akan masuk ke laman berikutnya dan jika tidak ada maka else */
            /* kondisi jika usernya aktif */
            if ($user['is_active'] == 1) {
                /* ngecek password */
                /* jika berhasil semua pengkondisiannya maka akan masuk pada if ini */
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    /* kondisi dimana dia admin atau bukan */
                    if ($user['role_id'] == 1) {
                        redirect('/1qa2ws3ed4rf5tg6yh7uj8ik9ol0p/admin890');
                    } else {
                        redirect('User');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong password!.
                    </div>');
                    redirect('auth');
                }
                /* isinya apa */
            } else {
                /* dan jika gagal isinya apa */
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                This Email has not been activated!.
                </div>');
                redirect('auth');
            }
            /* tutup kondisi aktif */
        } else {
            /* user tidak ada dan akan dikembalikan ke login dengan alert */
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email is not registered!.
            </div>');
            redirect('auth');
        }
    }
    /* penututp kondisi */



    /* bagian registration */
    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'User Registration'
            ];
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_header');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_create' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulations your account has been created, please to Login
            </div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been logged out
            </div>');
        redirect('auth');
    }
}
