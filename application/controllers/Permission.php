
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->library('twig');
        $this->load->model('roleModel');
        $this->load->model('permissionModel');


    }


    public function index()
    {
        $data['title'] = 'Roles & Permissions';


        $data['roles'] = $this->roleModel->RolesWithPermissions();



        $this->render('dashboard/Permission/permission', $data);
    }


    public function create()
    {
        $data['roles'] = $this->roleModel->all();
        $data['permissions'] = $this->permissionModel->all();

        $this->render('dashboard/Permission/createPermission', $data);
    }

    public function edit()
{
    $id = $this->input->get('id');
    if (!$id) {
        show_error('No role ID provided');
    }

    $role = $this->roleModel->findRoleById($id);
    $permissions = $this->roleModel->allPermissions();
    $assignedPermissions = $this->roleModel->getAssignedPermissions($id);

    $this->render('dashboard/Permission/editPermission', [
        'role' => $role,
        'permissions' => $permissions,
        'assignedPermissions' => $assignedPermissions
    ]);
}

    public function update()
{
    $roleId = $this->input->post('role_id');
    $roleName = $this->input->post('role_name');
    $permissionsInput = $this->input->post('permissions');

    if (!$roleId) {
        show_error('Role ID is required');
    }

    // Update role name
    if (!empty($roleName)) {
        $this->roleModel->updateRoleName($roleId, trim($roleName));
    }

    // Update permissions
    $permissions = array_map('trim', explode(',', $permissionsInput));
    $this->roleModel->updatePermissions($roleId, $permissions); // safely replaces old permissions

    $this->session->set_flashdata('success', 'Role & Permissions updated successfully!');
    redirect('permission');
}



 public function assignPermissionStore()
{
    $roleId = $this->input->post('role_id');
    $permissionsInput = $this->input->post('permissions');

    if (!$roleId || !$permissionsInput) {
        show_error('Role & permissions required');
    }


    $permissions = array_map('trim', explode(',', $permissionsInput));

    foreach ($permissions as $permName) {

        $perm = $this->permissionModel->getIdByName($permName);

        if (!$perm) {

            $permId = $this->permissionModel->create($permName);
        } else {
            $permId = $perm;
        }

      
        $this->roleModel->assignPermission($roleId, $permId);
    }

    $this->session->set_flashdata('success', "Permissions created & assigned successfully!");
    redirect('permission');
}


    public function deletePermission()
    {
        $permissionName = $this->input->post('name');

        if (!$permissionName) {
            show_error('Permission name is required');
        }

        $this->roleModel->softDeletePermissionByName($permissionName);

        $this->session->set_flashdata('success', "Permission removed successfully!");
        redirect('permission');
    }
}
