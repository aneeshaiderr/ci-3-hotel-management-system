<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleSeeder {

    public function run() {
        $CI =& get_instance();


        $roles = ['superadmin', 'staff', 'user'];

        foreach ($roles as $role) {
            $CI->db->insert('roles', ['name' => $role]);
        }

        echo "RoleSeeder ran successfully!";
    }
}
