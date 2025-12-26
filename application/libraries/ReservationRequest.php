<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReservationRequest
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('form_validation');
    }

    public function validate()
    {
        $this->CI->form_validation->set_rules('hotel_code', 'Hotel Code', 'required');
        $this->CI->form_validation->set_rules('user_id', 'User', 'required');
        $this->CI->form_validation->set_rules('hotel_id', 'Hotel', 'required');
        $this->CI->form_validation->set_rules('room_id', 'Room', 'required');
        $this->CI->form_validation->set_rules('check_in', 'Check In', 'required');
        $this->CI->form_validation->set_rules('check_out', 'Check Out', 'required');
        $this->CI->form_validation->set_rules('status', 'Status', 'required');

        return $this->CI->form_validation->run();
    }

    public function errors()
    {
        return $this->CI->form_validation->error_array();
    }

    public function all()
    {
        return $this->CI->input->post();
    }
}
