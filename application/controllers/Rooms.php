<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rooms extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RoomModel');
        $this->load->library('twig');
    }

    public function index()
    {

        $data['rooms'] = $this->RoomModel->getAllRooms();
         $this->render('dashboard/Room/room', $data);
    }


    public function edit()
    {
        $id = $this->input->get('id', true);

        if (! $id) {
            redirect('rooms');
            return;
        }

        $room = $this->RoomModel->find($id);

        if (! $room) {
            $this->session->set_flashdata('error', 'Room details not found.');
            redirect('rooms');
            return;
        }

         $this->render('dashboard/Room/editRoom', [
            'room' => $room
        ]);
    }

    // Show create form
    public function create()
    {
        $data['hotels'] = $this->RoomModel->getAllHotels();
         $this->twig->render('dashboard/Room/createRoom', $data);
    }

    // Store room
    public function store()
    {
        if ($this->input->method() !== 'post') {
            redirect('rooms');
            return;
        }

        $data = [
            'hotel_id'   => $this->input->post('hotel_id', true),
            'room_number'=> $this->input->post('room_number', true),
            'floor'      => $this->input->post('floor', true),
            'beds'       => $this->input->post('beds', true),
            'max_guests' => $this->input->post('max_guests', true),
            'status'     => $this->input->post('status', true),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->RoomModel->create($data);
        redirect('rooms');
    }

    // Update room
     public function update()
    {
    if ($this->input->method() !== 'post') {
        redirect('rooms');
        return;
    }

    $id = $this->input->post('id', true);

    $data = [
          'room_number'=> $this->input->post('room_number', true),

          'floor'      => $this->input->post('floor', true),

          'beds'       => $this->input->post('beds', true),

          'max_guests' => $this->input->post('max_guests', true),

          'status'     => $this->input->post('status', true),
    ];

    $this->RoomModel->update($id, $data);
    redirect('rooms');
}


    // Delete (soft)
    public function delete()
    {
        if ($this->input->method() !== 'post') {

            redirect('rooms');
            return;
        }

        $id = $this->input->post('id', true);

         $this->RoomModel->softDelete($id);

        redirect('rooms');
    }
}
