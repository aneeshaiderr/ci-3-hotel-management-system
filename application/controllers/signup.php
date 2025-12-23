<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('userModel');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }

    public function index()
    {
        if ($this->input->method() === 'post') {

            $first_name = trim($this->input->post('first_name'));

            $last_name  = trim($this->input->post('last_name'));

            $email      = trim($this->input->post('email'));

            $password   = $this->input->post('password');

            if ($first_name === '' || $last_name === '' || $email === '' || $password === '') {

                $this->session->set_flashdata('error', 'All required fields must be filled.');

                redirect('signup');

                exit;
            }

            $userData = [
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'email'      => $email,
                'contact_no' => $this->input->post('contact_no') ?: '',
                'password'   => password_hash($password, PASSWORD_BCRYPT),
                'role_id'    => 3,
                'active'     => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];


            $inserted = $this->userModel->signup($userData, 3);

            if ($inserted) {

                $this->session->set_flashdata('success', 'Signup successful! You can now login.');

                redirect('login');
                exit;
            }

            $this->session->set_flashdata('error', 'Signup failed!');
            redirect('signup');
            exit;
        }

        $this->load->view('auth/signup');
    }
}

