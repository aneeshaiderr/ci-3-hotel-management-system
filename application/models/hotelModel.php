<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HotelModel extends CI_Model
{
    protected $table = 'hotels';
    public function getAllHotels()
    {
        return $this->db
            ->where('deleted_at', null)
            ->or_where('deleted_at', '')
            ->get('hotels')
            ->result_array();
    }

    public function find($id)
    {
        if (!$id) return null;

        return $this->db
            ->where('id', $id)
            ->where('deleted_at', null)
            ->get('hotels')
            ->row_array();
    }

    public function create($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('hotels', $data);
    }

    public function update($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db
            ->where('id', $id)
            ->update('hotels', $data);
    }

public function softDelete($id)
{
    if (!$id) return false;

    $data = [
        'deleted_at' => date('Y-m-d H:i:s')
    ];

    $this->db->where('id', $id);
    return $this->db->update('hotels', $data);
}

}
