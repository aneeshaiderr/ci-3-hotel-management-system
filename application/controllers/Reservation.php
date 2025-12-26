<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reservationModel');
        $this->load->model('userModel');
        $this->load->model('hotelModel');
        $this->load->model('roomModel');
        $this->load->model('discountModel');
        $this->load->library('session');
        $this->load->library('twig');
        $this->load->library('ReservationRequest');
        $this->load->library('UpdateReservationRequest');
    }

    // Show all reservations
    public function index()
    {
        $userId = $this->session->userdata('user_id');

        $roleId = $this->session->userdata('role_id');

        $reservations = $this->reservationModel->getAllReservations($userId, $roleId);

      $this->render('dashboard/Reservation/reservation', [
            'reservations' => $reservations
        ]);
    }

    // Show create reservation form
    public function create()
    {


        $users = $this->userModel->getAllUsers();

        $hotels = $this->hotelModel->getAllHotels();

        $rooms = $this->roomModel->getAllRooms();

        $discounts = $this->discountModel->getAll();

         $this->render('dashboard/Reservation/createReservation', [
            'users' => $users,
            'hotels' => $hotels,
            'rooms' => $rooms,
            'discounts' => $discounts
        ]);
    }

    // Store reservation
   public function store()
{
    if ($this->input->method() !== 'post') {
        redirect('reservation/create');
        return;
    }

    if (!$this->reservationrequest->validate()) {

        $this->session->set_flashdata(
            'errors',
            $this->reservationrequest->errors()
        );

        $this->session->set_flashdata(
            'old',
            $this->reservationrequest->all()
        );

        redirect('reservation/create');
        return;
    }
    $data = $this->reservationrequest->all();
    $this->reservationModel->create($data);

    $this->session->set_flashdata('success', 'Reservation created successfully!');
    redirect('reservation');
}



    public function delete()
{
    $hotelCode = $this->input->post('hotel_code');

    if ($hotelCode) {
        $this->reservationModel->softDeleteByHotelCode($hotelCode);
    }

    redirect('reservation');
}


    // Show reservation detail
    public function show()
    {
        $id = (int)$this->input->get('id');

        $reservation = $this->reservationModel->getReservationById($id);

         $this->render('dashboard/Reservation/reservationDetail', [
            'reservation' => $reservation
        ]);
    }

    // Show edit form
    public function editReservation()
    {
        $id = (int)$this->input->get('id');

        $reservation = $this->reservationModel->getReservationById($id);

        if (!$reservation) {
            $this->session->set_flashdata('error', 'Reservation not found!');
            redirect('reservation');
        }

        $hotels = $this->hotelModel->getAllHotels();
        $discounts = $this->discountModel->getAll();

         $this->render('dashboard/Reservation/editReservation', [
            'reservation' => $reservation,
            'hotels' => $hotels,
            'discounts' => $discounts
        ]);
    }

    // Update reservation
   public function update()
{
    if ($this->input->server('REQUEST_METHOD') === 'POST') {

        //  VALIDATION FAIL
        if (!$this->updatereservationrequest->validate()) {

            $this->session->set_flashdata(
                'errors',
                $this->updatereservationrequest->errors()
            );

            $this->session->set_flashdata(
                'old',
                $this->updatereservationrequest->all()
            );

            redirect('reservation/editReservation?id=' . $this->input->post('id'));
            return;
        }

        //VALIDATION
        $id = $this->input->post('id');
        if (!$id) redirect('reservation');

        $data = $this->input->post();
        unset($data['id']);

        $this->reservationModel->update($id, $data);

        $this->session->set_flashdata('success', 'Reservation updated successfully!');
        redirect('reservation');
    }
}

}
