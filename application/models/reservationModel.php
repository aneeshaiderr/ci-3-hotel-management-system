<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReservationModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Get all reservations with optional user/role filter
        public function getAllReservations($userId = null, $roleId = null)
    {
        $this->db->select('r.*, u.email, h.hotel_name, d.discount_name');
        $this->db->from('reservations r');
        $this->db->join('users u', 'r.user_id = u.id', 'left');
        $this->db->join('hotels h', 'r.hotel_id = h.id', 'left');
        $this->db->join('discount d', 'r.discount_id = d.id', 'left');
        $this->db->where('r.deleted_at IS NULL', null, false);

        if ((int)$roleId === 4 && $userId !== null) {
            $this->db->where('r.user_id', (int)$userId);
        }

        $this->db->order_by('r.id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function softDeleteByHotelCode($hotelCode)
{
    if (!$hotelCode) return false; // safeguard

    $data = [
        'deleted_at' => date('Y-m-d H:i:s')
    ];

    $this->db->where('hotel_code', $hotelCode);
    return $this->db->update('reservations', $data); // table name directly
}


    // Create new reservation
    public function create($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('reservations', $data);
    }

    // Get all rooms
    public function getAllRooms()
    {
        $query = $this->db->select('id')
          ->from('rooms')
         ->where('deleted_at IS NULL', null, false)
         ->get();
        return $query->result_array();
    }

    // Get user email by ID
    public function getUserEmailById($userId)
    {
        $query = $this->db->select('email')
         ->from('users')
         ->where('id', $userId)
         ->get();
        $row = $query->row_array();
        return $row ? $row['email'] : null;
    }

    // Get hotel name by ID
    public function getHotelNameById($hotelId)
    {
        $query = $this->db->select('hotel_name')
        ->from('hotels')
        ->where('id', $hotelId)
        ->get();
        $row = $query->row_array();
        return $row ? $row['hotel_name'] : null;
    }

    // Get reservation by ID
    public function getReservationById($id)
    {
        $this->db->select('r.*, u.email, h.hotel_name, d.discount_name');
        $this->db->from('reservations r');
        $this->db->join('users u', 'r.user_id = u.id', 'left');
        $this->db->join('hotels h', 'r.hotel_id = h.id', 'left');
        $this->db->join('discount d', 'r.discount_id = d.id', 'left');
        $this->db->where('r.id', $id);
        $this->db->where('r.deleted_at IS NULL', null, false);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Update reservation
    public function update($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update('reservations', $data);
    }

    // Get discount name by ID
    public function getDiscountNameById($discountId)
    {
        $query = $this->db->select('name')
        ->from('discount')
        ->where('id', $discountId)
         ->get();
        $row = $query->row_array();
        return $row ? $row['name'] : null;
    }

    // Get all reservations (simple)
    public function getAllReservation()
    {
        $query = $this->db->get('reservations');
        return $query->result_array();
    }
}
