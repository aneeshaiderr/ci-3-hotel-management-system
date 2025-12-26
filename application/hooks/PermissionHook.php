<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermissionHook {

    public function checkPermission()
    {
        $CI =& get_instance();
        $CI->load->library('session');


        $roleId = $CI->session->userdata('role_id');

        if (!$roleId) return;


        if ($roleId == 1) {
            $permissions = ['ALL'];
        } else {

            $CI->load->model('RoleModel');
            $perms = $CI->RoleModel->getPermission($roleId);
            $permissions = array_column($perms, 'name');
        }

        $CI->session->set_userdata('permissions', $permissions);
    }
}
