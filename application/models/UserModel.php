<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model
{
    protected $table = 'users';



    public function getUserById($id)
    {
        return $this->db
            ->select('id, first_name, last_name, email, contact_no, address')
            ->where('id', $id)
            ->where('deleted_at IS NULL')
            ->get($this->table)
            ->row_array();
    }

    public function findUserById($id)
    {
        return $this->db
            ->where('id', $id)
            ->get($this->table)
            ->row_array();
    }

    public function findUserDetails($id)
    {
        return $this->findUserById($id);
    }
   public function getAllUsers()
{

    return $this->db
                ->where('deleted_at IS NULL', null, false)
                ->get($this->table)
                ->result_array();
}




    public function create($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {

        $exists = $this->db
            ->where('email', $data['email'])
            ->where('id !=', $id)
            ->get($this->table)
            ->row();

        if ($exists) {
            return false;
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }

    public function updateUserDetails($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');

        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }

    public function findByEmail($email)
    {
        return $this->db
            ->select('u.*, r.name AS role_name')
            ->from('users u')
            ->join('roles r', 'r.id = u.role_id', 'left')
            ->where('u.email', $email)
            ->limit(1)
            ->get()
            ->row_array();
    }

    public function findEmail($email)
    {
        return $this->db
            ->where('email', $email)
            ->get($this->table)
            ->row_array();
    }


    public function signup($data, $group_id = 3)
{

    if ($this->emailExists($data['email'])) {
        return false;
    }


    $this->db->insert($this->table, $data);
    $user_id = $this->db->insert_id();

    if (!$user_id) {
        return false;
    }


    $this->db->insert('users_groups', [
        'user_id'  => $user_id,
        'group_id' => $group_id
    ]);

    return $user_id;
}


    /**
     * Check email exists
     */
    public function emailExists($email)
    {
        return $this->db
            ->where('email', $email)
            ->limit(1)
            ->get($this->table)
            ->num_rows() > 0;
    }


    public function usernameExists($username)
    {
        return $this->db
            ->where('username', $username)
            ->limit(1)
            ->get($this->table)
            ->num_rows() > 0;
    }

    /**
     * Password verify
     */
    public function verifyPassword($user, $password)
    {
        return password_verify($password, $user['password']);
    }



    public function getAllReservationsByUser($userId)
    {
        return $this->db
            ->select('r.*, h.hotel_name, rm.room_number')
            ->from('reservations r')
            ->join('hotels h', 'h.id = r.hotel_id')
            ->join('rooms rm', 'rm.id = r.room_id')
            ->where('r.user_id', $userId)
            ->order_by('r.check_in', 'ASC')
            ->get()
            ->result_array();
    }

    public function getCurrentReservation($userId)
    {
        return $this->db
            ->select('r.*, h.hotel_name, rm.room_number')
            ->from('reservations r')
            ->join('hotels h', 'h.id = r.hotel_id')
            ->join('rooms rm', 'rm.id = r.room_id')
            ->where('r.user_id', $userId)
            ->order_by('r.check_in', 'DESC')
            ->limit(1)
            ->get()
            ->row_array();
    }



    public function getRoleId($flag = true, $userId = null)
    {
        if ($flag === true) {
            return $this->session->userdata('role_id');
        }

        if (!$userId) {
            return null;
        }

        $row = $this->db
            ->select('role_id')
            ->where('id', $userId)
            ->get($this->table)
            ->row_array();

        return isset($row['role_id']) ? $row['role_id'] : null;
    }

    public function softDelete($id)
{
    $data = [
        'deleted_at' => date('Y-m-d H:i:s')
    ];

    $this->db->where('id', $id);
    $this->db->update('users', $data);
}



}
