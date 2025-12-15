<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserSeeder {

    public function run() {
        $CI =& get_instance();

        $data = [
            'role_id'     => 1,
            'first_name'  => 'Test',
            'last_name'   => 'User',
            'user_email'  => 'test@example.com',
            'password'    => password_hash('123456', PASSWORD_DEFAULT),
            'contact_no'  => '03001234567',
            'address'     => 'Test Address',
            'status'      => 1,
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $CI->db->insert('users', $data);

        echo "UserSeeder ran successfully!";
    }
}


