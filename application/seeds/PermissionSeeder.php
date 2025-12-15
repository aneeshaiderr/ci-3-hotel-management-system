<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermissionSeeder {

    public function run() {
        $CI =& get_instance();


        $permissions = [
            "view_user",
            "create_user",
            "edit_user",
            "delete_user",
            "view_discount",
            "edit_discount",
            "delete_discount",
        ];

        foreach ($permissions as $perm) {
            $CI->db->insert('permissions', ['name' => $perm]);
        }

        echo "PermissionSeeder ran successfully!";
    }
}
