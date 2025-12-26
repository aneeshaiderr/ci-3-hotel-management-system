<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermissionModel extends CI_Model
{
    protected $table = 'permissions';

    public function __construct()
    {
        parent::__construct();

    }

    // Get all permissions
    public function all()
    {
        return $this->db->get($this->table)->result_array();
    }

    // Create permission
  public function create($name)
{
    $data = [
        'name'       => $name,
        'created_at' => date('Y-m-d H:i:s'),
    ];

    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
}


    // Get permission ID by name
    public function getIdByName($name)
    {
        $row = $this->db
            ->select('id')
            ->from($this->table)
            ->where('name', $name)
            ->limit(1)
            ->get()
            ->row_array();

        return $row ? $row['id'] : null;
    }
}
