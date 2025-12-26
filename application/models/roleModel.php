<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleModel extends CI_Model
{
    protected $rolesTable = 'roles';
    protected $permissionsTable = 'permissions';
    protected $pivotTable = 'role_permissions';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function findRoleById($id)
    {
        return $this->db
            ->get_where($this->rolesTable, ['id' => $id])
            ->row_array();
    }


    public function getPermission($roleId)
    {
        return $this->db
            ->select('p.id, p.name')
            ->from($this->permissionsTable . ' p')
            ->join($this->pivotTable . ' rp', 'rp.permission_id = p.id')
            ->where('rp.role_id', $roleId)
            ->where('p.deleted_at IS NULL', null, false)
            ->get()
            ->result_array();
    }


    public function getAllRolesWithPermissions()
    {
        $rows = $this->db
            ->select('r.id AS role_id, r.name AS role_name, p.name AS permission_name')
            ->from($this->rolesTable . ' r')
            ->join($this->pivotTable . ' rp', 'rp.role_id = r.id', 'left')
            ->join(
                $this->permissionsTable . ' p',
                'p.id = rp.permission_id AND p.deleted_at IS NULL',
                'left'
            )
            ->order_by('r.id', 'ASC')
            ->get()
            ->result_array();

        $roles = [];

        foreach ($rows as $row) {
            $roleId = $row['role_id'];

            if (!isset($roles[$roleId])) {
                $roles[$roleId] = [
                    'id' => $roleId,
                    'name' => $row['role_name'],
                    'permissions' => []
                ];
            }

            if (!empty($row['permission_name'])) {
                $roles[$roleId]['permissions'][] = $row['permission_name'];
            }
        }

        return array_values($roles);
    }

    public function softDeletePermissionByName($permissionName)
    {
        return $this->db
            ->where('name', $permissionName)
            ->where('deleted_at IS NULL', null, false)
            ->update($this->permissionsTable, [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
    }

    public function all()
    {
        return $this->db
            ->order_by('id', 'ASC')
            ->get($this->rolesTable)
            ->result_array();
    }


    public function assignPermission($roleId, $permissionId)
    {
        $exists = $this->db
            ->where([
                'role_id' => $roleId,
                'permission_id' => $permissionId
            ])
            ->get($this->pivotTable)
            ->row_array();

        if (!$exists) {
            $this->db->insert($this->pivotTable, [
                'role_id' => $roleId,
                'permission_id' => $permissionId
            ]);
        }
    }


    public function allPermissions()
    {
        return $this->db
            ->order_by('name', 'ASC')
            ->get($this->permissionsTable)
            ->result_array();
    }


    public function findPermissionByName($name)
    {
        return $this->db
            ->get_where($this->permissionsTable, ['name' => $name])
            ->row_array();
    }


    public function createPermission($name)
    {
        $this->db->insert($this->permissionsTable, ['name' => $name]);
        return $this->db->insert_id();
    }


    public function getAssignedPermissions($roleId)
    {
        $rows = $this->db
            ->select('p.name')
            ->from($this->permissionsTable . ' p')
            ->join($this->pivotTable . ' rp', 'rp.permission_id = p.id')
            ->where('rp.role_id', $roleId)
            ->where('p.deleted_at IS NULL', null, false)
            ->get()
            ->result_array();

        return array_column($rows, 'name');
    }

    public function RolesWithPermissions()
    {
        $roles = $this->all();

        foreach ($roles as &$role) {
            $role['permissions'] = $this->getAssignedPermissions($role['id']);
        }

        return $roles;
    }


    public function updatePermissions($roleId, $permissions)
{
    // Get existing permission IDs for the role
    $existing = $this->getPermission($roleId);
    $existingIds = array_column($existing, 'id');

    $newPermissionIds = [];

    foreach ($permissions as $perm) {

        if (!is_numeric($perm)) {
            $record = $this->findPermissionByName($perm);

            // Create permission if not exists
            $permId = $record
                ? $record['id']
                : $this->createPermission($perm);
        } else {
            $permId = $perm;
        }

        $newPermissionIds[] = $permId;
    }

    // Insert new permissions
    foreach ($newPermissionIds as $permId) {
        if (!in_array($permId, $existingIds)) {
            $this->db->insert($this->pivotTable, [
                'role_id'       => $roleId,
                'permission_id' => $permId
            ]);
        }
    }

    // Delete removed permissions
    foreach ($existingIds as $permId) {
        if (!in_array($permId, $newPermissionIds)) {
            $this->db
                ->where('role_id', $roleId)
                ->where('permission_id', $permId)
                ->delete($this->pivotTable);
        }
    }

    // Update role's updated_at timestamp
     $this->db
        ->where('id', $roleId)
        ->update($this->rolesTable, ['updated_at' => date('Y-m-d H:i:s')]);

    return true;
}


    public function updateRoleName($roleId, $newName)
    {
        return $this->db
            ->where('id', $roleId)
            ->update($this->rolesTable, ['name' => $newName]);
    }
}
