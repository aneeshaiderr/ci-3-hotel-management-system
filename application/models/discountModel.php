<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DiscountModel extends CI_Model
{
public function getAll()
{

    $this->db->select('id, discount_type, discount_name, value, start_date, end_date, status');

    $this->db->from('discount');

    $this->db->where('deleted_at', null);

    $this->db->order_by('start_date', 'DESC');

    $query = $this->db->get();

    return $query->result_array();
}
    public function create($data)
    {
        $insertData = [

        'discount_type' => $data['discount_type'],

        'discount_name' => $data['discount_name'],

        'value'         => $data['value'],

        'start_date'    => $data['start_date'],

        'end_date'      => $data['end_date'],

        'status'        => $data['status'],

        'created_at'    => date('Y-m-d H:i:s')
    ];

    return $this->db->insert('discount', $insertData);
}
 public function find($id)
    {
        $this->db->select('id, discount_type, discount_name, value, start_date, end_date, status');

        $this->db->from('discount');

        $this->db->where('id', $id);

        $this->db->where('deleted_at', null);

        $query = $this->db->get();

        return $query->row_array();
    }


     public function update($id, $data)
       {
         $updateData = [

            'discount_type' => $data['discount_type'],

            'discount_name' => $data['discount_name'],

            'value'         => $data['value'],

            'start_date'    => $data['start_date'],

            'end_date'      => $data['end_date'],

            'status'        => $data['status'],

            'updated_at'    => date('Y-m-d H:i:s')
    ];


    $this->db->where('id', $id);

    $this->db->where('deleted_at', null);

    return $this->db->update('discount', $updateData);
}

}
