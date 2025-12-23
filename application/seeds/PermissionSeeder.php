<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermissionSeeder {

    public function run() {
        $CI =& get_instance();

        $permissions = [

            "create_user",
            "edit_user",
            "delete_user",
            "view_discount",
            "edit_discount",
            "delete_discount",
        ];

        foreach ($permissions as $perm) {

            $CI->db->where('name', $perm);
            $query = $CI->db->get('permissions');

            if ($query->num_rows() > 0) {

                $CI->db->where('name', $perm);
                $CI->db->update('permissions', [
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                echo "Permission '{$perm}' updated successfully!";
            } else {

                $CI->db->insert('permissions', [
                    'name'       => $perm,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                echo "Permission  inserted successfully!";
            }
        }

    }
}
