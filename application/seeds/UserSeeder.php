<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserSeeder {

    public function run() {
        $CI =& get_instance();

        $data = [
            'role_id'     => 1,
            'first_name'  => 'anees',
            'last_name'   => 'User',
            'user_email'  => 'anees@example.com',
            'password'    => password_hash('123456', PASSWORD_DEFAULT),
            'contact_no'  => '03001234567',
            'address'     => 'Test Address',
            'status'      => 1,
            'created_at'  => date('Y-m-d H:i:s')
        ];

        $CI->db->where('user_email', $data['user_email']);
        $query = $CI->db->get('users');

        if ($query->num_rows() > 0) {

            $CI->db->where('user_email', $data['user_email']);

            $update_data = $data;
            unset($update_data['created_at']);
            $CI->db->update('users', $update_data);
            echo "User updated successfully!";
        } else {

            $CI->db->insert('users', $data);
            echo "User inserted successfully!";
        }
    }
}
