<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RolePermissionSeeder {

    public function run() {
        $CI =& get_instance();

        $permissions = $CI->db->select('id')
                              ->from('permissions')
                              ->get()
                              ->result_array();


        foreach ($permissions as $p) {
            $CI->db->insert('role_permissions', [
                'role_id'       => 1,
                'permission_id' => $p['id']
            ]);
        }

        echo "RolePermissionSeeder ran successfully!";
    }
}
