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

            $CI->db->where('role_id', 3);
            $CI->db->where('permission_id', $p['id']);
            $query = $CI->db->get('role_permissions');

            if ($query->num_rows() > 0) {

                $CI->db->where('role_id', 3);
                $CI->db->where('permission_id', $p['id']);
                $CI->db->update('role_permissions', [
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                echo "Role-Permission ID  updated";
            } else {

                $CI->db->insert('role_permissions', [
                    'role_id'       => 3,
                    'permission_id' => $p['id'],
                    'created_at'    => date('Y-m-d H:i:s')
                ]);
                echo "Role-Permission ID  inserted.";
            }
        }


    }
}
