<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CreateUserRequest
{
    protected $ci;
    public $data = [];
    public $errors = [];

    public function __construct()
    {
        $this->ci = get_instance();
        $this->data = $this->ci->input->post();
    }

    public function validate()
    {
        $this->ci->load->library('form_validation');
        $this->ci->form_validation->set_data($this->data);

        $this->ci->form_validation->set_rules('first_name', 'First Name', 'required|trim');
        $this->ci->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
        $this->ci->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->ci->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->ci->form_validation->set_rules('role', 'Role', 'required');

        if ($this->ci->form_validation->run() === FALSE) {
            $this->errors = $this->ci->form_validation->error_array();
            return false;
        }

        return true;
    }

    public function all()
    {
        return $this->data;
    }

    public function errors()
    {
        return $this->errors;
    }
}
