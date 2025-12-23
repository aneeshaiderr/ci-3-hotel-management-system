<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServiceModel extends CI_Model {

    protected $table = 'services';

    public function __construct() {
        parent::__construct();
    }

    // Get all active services
    public function getAll() {
        return $this->db
            ->select('id, service_name, price, status')
            ->where('deleted_at IS NULL', null, false)
            ->get('services')
            ->result_array();
    }

    // Soft delete service
    public function softDelete($id) {
        return $this->db
            ->where('id', $id)
            ->update('services', ['deleted_at' => date('Y-m-d H:i:s')]);
    }


    public function all() {
        return $this->getAll();
    }

    // Get all services for list with order
    public function getAllServicesList() {
        return $this->db
            ->select('id, service_name, price, status')
            ->where('deleted_at IS NULL', null, false)
            ->order_by('id', 'DESC')
            ->get('services')
            ->result_array();
    }

    // Create new service
    public function create($data) {
        $insertData = [
            'service_name' => $data['service_name'],
            'price'        => $data['price'],
            'status'       => $data['status'],
            'created_at'   => date('Y-m-d H:i:s'),
        ];
        return $this->db->insert('services', $insertData);
    }

    // Find service by ID
    public function find($id) {
        return $this->db
            ->where('id', $id)
            ->get('services')
            ->row_array();
    }

    // Update an existing service
    public function update($id, $data) {
        $updateData = [
            'service_name' => $data['service_name'],
            'price'        => $data['price'],
            'status'       => $data['status'],
            'updated_at'   => date('Y-m-d H:i:s'),
        ];
        return $this->db
            ->where('id', $id)
            ->update('services', $updateData);
    }

    // Get all services (for list or reference)
    public function getAllServices() {
        return $this->db
            ->order_by('created_at', 'ASC')
            ->get('services')
            ->result_array();
    }
}
