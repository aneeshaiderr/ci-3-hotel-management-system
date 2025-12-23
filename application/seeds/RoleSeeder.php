<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleSeeder {

    public function run() {
        $CI =& get_instance();

        $roles = ['superadmin', 'staff', 'user'];

        foreach ($roles as $role) {

            $CI->db->where('name', $role);
            $query = $CI->db->get('roles');

            if ($query->num_rows() > 0) {

                $CI->db->where('name', $role);
                $CI->db->update('roles', ['name' => $role]);
                echo "Role  updated successfully!";
            } else {

                $CI->db->insert('roles', ['name' => $role]);
                echo "Role  inserted successfully!";
            }
        }
    }
}
