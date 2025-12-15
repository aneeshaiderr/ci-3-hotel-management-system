<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');

    }

    public function index() {

        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');

        $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');

        $this->form_validation->set_rules('user_email', 'Email', 'required|trim|valid_email');

        $this->form_validation->set_rules('contact_no', 'Contact', 'required|trim');

        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('auth/signup');
        } else {

            $this->session->set_flashdata('succMsg', 'Signup successful!');
            redirect('signup');
        }
    }
}
