<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('userModel');
        $this->load->library(['session']);

        $this->load->library('CreateUserRequest');
    }

     public function index()
    {
        if ($this->input->method() === 'post') {

            if (!$this->createuserrequest->validate()) {
                $this->session->set_flashdata('errors', $this->createuserrequest->errors());
                $this->session->set_flashdata('old', $this->createuserrequest->all());
                redirect('signup');
                return;
            }

            $data = $this->createuserrequest->all();

            $roleRow = $this->db->where('name', $data['role'])->get('roles')->row();
            $role_id = $roleRow ? $roleRow->id : 3;

            $group_id = ($data['role'] === 'staff') ? 2 : 3;

            $userData = [
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'email'      => $data['email'],
                'contact_no' => isset($data['contact_no']) ? $data['contact_no'] : '',
                'password'   => password_hash($data['password'], PASSWORD_BCRYPT),
                'role_id'    => $role_id,
                'active'     => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $inserted = $this->userModel->signup($userData, $group_id);

            if ($inserted) {
                $this->session->set_flashdata('succMsg', 'Signup successful! You can now login.');
                redirect('login');
                return;
            }

            $this->session->set_flashdata('errors', [
                'general' => 'Signup failed, please try again.'
            ]);
            redirect('signup');
            return;
        }

        $data['errors'] = $this->session->flashdata('errors');
        $data['old']    = $this->session->flashdata('old');

        $this->render('auth/signup', $data);
    }
}
