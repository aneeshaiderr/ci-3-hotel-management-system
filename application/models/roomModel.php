<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoomModel extends CI_Model
{

  public function getAllRooms()
{
    $this->db->from('rooms');
    $this->db->where('deleted_at IS NULL', null, false);
    $this->db->or_where('deleted_at', '');

    $query = $this->db->get();
    return $query->result_array();
}

    public function getAll()
{
    $query = $this->db->get('rooms');
    return $query->result_array();
}



    public function find($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('rooms')
            ->row_array();
    }


    public function create($data)
    {
        $insertData = [
            'room_number' => $data['room_number'],
            'floor'       => $data['floor'],
            'beds'        => $data['beds'],
            'Max_guests'  => $data['max_guests'],
            'hotel_id'    => $data['hotel_id'],
            'status'      => $data['status'],
            'created_at'  => date('Y-m-d H:i:s'),
        ];

        return $this->db->insert('rooms', $insertData);
    }


   public function update($id, $data)
{
    $updateData = [
        'room_number' => (int) $data['room_number'],
        'floor'       => (int) $data['floor'],
        'beds'        => (int) $data['beds'],
        'max_guests'  => (int) $data['max_guests'],
        'status'      => $data['status'],
        'updated_at'  => date('Y-m-d H:i:s'),
    ];

    return $this->db
        ->where('id', $id)
        ->update('rooms', $updateData);
}
    public function softDelete($id)
    {
        return $this->db
            ->where('id', $id)
            ->update('rooms', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
    }


    public function getAllHotels()
    {
        return $this->db
            ->select('id, hotel_name')
            ->get('hotels')
            ->result_array();
    }
}
