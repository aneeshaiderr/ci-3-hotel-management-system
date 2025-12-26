<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel extends MY_Controller
{
      public function __construct()
    {
        parent::__construct();

        $this->load->model('HotelModel');

         $this->load->library('twig');
    }
       public function index()
    {


        $data['hotels'] = $this->HotelModel->getAllHotels();


       $this->render('dashboard/Hotel/hotel', $data);
    }
     public function create()
  {

    if ($this->input->method() === 'post') {

        $data = [
            'hotel_name' => $this->input->post('hotel_name', true),
            'address'    => $this->input->post('address', true),
            'contact_no' => $this->input->post('contact_no', true),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->HotelModel->create($data);

        redirect('hotel');
        return;
    }


    $this->render('dashboard/Hotel/hotelCreate');
}
       public function edithotel()
    {

        if ($this->input->post()) {

            $id = $this->input->post('id', true);
            $data = [
                'hotel_name' => $this->input->post('hotel_name', true),
                'address'    => $this->input->post('address', true),
                'contact_no' => $this->input->post('contact_no', true),
            ];
            $this->HotelModel->update($id, $data);

            return redirect('hotel');

        }

        $id = $this->input->get('id', true);
        $hotel = $this->HotelModel->find($id);

        if (!$hotel) {
            $this->session->set_flashdata('error', 'Hotel not found.');
            return redirect('hotel');
        }

         $this->render('dashboard/Hotel/edithotel', ['hotel' => $hotel]);
    }


         public function update()
    {
        if ($this->input->post()) {
            $id = $this->input->post('id', true);
            $data = [
                'hotel_name' => $this->input->post('hotel_name', true),
                'address'    => $this->input->post('address', true),
                'contact_no' => $this->input->post('contact_no', true),
            ];
            $this->HotelModel->update($id, $data);
            redirect('hotel');
        }
    }
          public function delete($id = null)
    {

        if (!$id && $this->input->post('id')) {
            $id = (int) $this->input->post('id');
        }

        if (!$id) {
            $this->session->set_flashdata('error', 'Hotel ID missing!');
            redirect('hotel');
            return;
        }

        if ($this->HotelModel->softDelete($id)) {
            $this->session->set_flashdata('success', 'Hotel deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete hotel.');
        }

        redirect('hotel');
    }

}

