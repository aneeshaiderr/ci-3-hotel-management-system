<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'twig']);
        $this->load->helper(['url', 'form']);
        $this->load->model('userModel');


        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }

    }



    public function index()
    {

             $roleId = (int) $this->session->userdata('role_id');

             $userId = (int) $this->session->userdata('user_id');



        if ($roleId === 1) {

            $users = $this->userModel->getAllUsers();

            $this->render('dashboard/User/index', [
                'users'   => $users,

            ]);

            return;
        }

        if ($roleId === 2) {


            $users = $this->userModel->getAllUsers();



            $this->render('dashboard/Staff/staff', [
                'users'   => $users,

            ]);

            return;
        }

        if ($roleId === 3) {
            $user = $this->userModel->findUserById($userId);
            $currentReservation = $this->userModel->getCurrentReservation($userId);

            $this->render('dashboard/User/user', [
                'user'               => $user,
                'currentReservation' => $currentReservation,


            ]);
        }
    }


    public function userAllDetails()
    {
        $userId = $this->input->get('id') ?: $this->session->userdata('user_id');

        $allReservations = $this->userModel->getAllReservationsByUser($userId);
        $currentReservation = $this->userModel->getCurrentReservation($userId);

        if ($currentReservation) {
            $reservations = array_filter($allReservations, function ($r) use ($currentReservation) {
                return $r['id'] != $currentReservation['id'];
            });
            array_unshift($reservations, $currentReservation);
        } else {
            $reservations = $allReservations;
        }

         $this->render('dashboard/User/user', [
            'reservations' => $reservations
        ]);
    }


    public function show($id = null)
    {
        $id = $id ?: $this->input->get('id');

        $user = $this->userModel->findUserById($id);

        if (!$user) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('dashboard');
        }

         $this->render('dashboard/User/user', [
            'user' => $user
        ]);
    }


    public function create()
    {

       $this->render('dashboard/User/create');

    }

      public function store()
    {



        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {

            $this->session->set_flashdata('errors', $this->form_validation->error_array());

            redirect('dashboard/create');
            return;
        }

        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name'  => $this->input->post('last_name'),
            'email'      => $this->input->post('email'),
            'contact_no'      => $this->input->post('contact_no'),
            'password'   => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
            'role_id'    => 3,
            'status'     => 1
        ];

        $this->userModel->create($data);

        $this->session->set_flashdata('success', 'User created successfully!');
        redirect('dashboard');
    }


    public function edit($id = null)
    {


        $id = $id ?: $this->input->get('id');

        $user = $this->userModel->findUserById($id);

        if (!$user) {
            $this->session->set_flashdata('error', 'User not found.');
            redirect('dashboard');
        }

        $this->render('dashboard/User/editUser', [
            'user' => $user
        ]);
    }


    public function update()
    {


        $id = $this->input->post('id');

        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name'  => $this->input->post('last_name'),
            'email'      => $this->input->post('email'),
            'contact_no'      => $this->input->post('contact_no'),
            'status'     => $this->input->post('status')
        ];

        if ($this->input->post('password')) {

            $data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        }

        $this->userModel->update($id, $data);

        $this->session->set_flashdata('success', 'User updated successfully!');
        redirect('dashboard');
    }

   public function softDelete()
    {
        $id = $this->input->post('id');

        if (!$id) {
            $this->session->set_flashdata('error', 'User ID missing!');
            redirect('user');
            return;
        }

        $deleted = $this->userModel->softDelete($id);

        if ($deleted) {
            $this->session->set_flashdata('success', 'User deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete user.');
        }

        redirect('user');
    }
}
