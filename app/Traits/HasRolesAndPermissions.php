<?php


namespace App\Traits;


use App\Models\Permission;
use App\Models\Role;

trait HasRolesAndPermissions
{
    /**
     * Linking the User model to the Role model, allows you to get all user roles
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    /**
     * Linking the User model with the Permission model allows you to get all the user rights
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    /**
     * Does the current user have a role?
     * @param $role
     * @return mixed
     */
    public function hasRole($role)
    {
        return $this->roles->contains('slug', $role);
    }

    /**
     * @param $permission
     * @return mixed
     */
    public function hasPermission($permission)
    {
        return $this->permissions->contains('slug', $permission);
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionsViaRoles($permission)
    {
        // We look at all user roles and look for the right right in them
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('slug', $permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermAnyWay($permission)
    {
        return $this->hasPermissionsViaRoles($permission) || $this->hasPermission($permission);
    }

    /**
     * @param mixed ...$permissions
     * @return bool
     */
    public function hasAllPermissions(...$permissions)
    {
        foreach ($permissions as $permission) {
            $condition = $this->hasPermissionsViaRoles($permission) || $this->hasPermission($permission);
            if (!$condition) {
                return false;
            }
        }
        return true;
    }

    /**
     * Does the current user have any of the permissions, either directly or through one of their roles?
     * @param mixed ...$permissions
     * @return bool
     */
    public function hasAnyPermissions(...$permissions)
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermissionsViaRoles($permission) || $this->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    public function getAllPermissions()
    {
        return $this->permissions->pluck('slug')->toArray();
    }

    public function getAllPermissionsViaRoles()
    {
        $permissions = [];
        foreach ($this->roles as $role) {
            $perms = $role->permissions;
            foreach ($perms as $perm) {
                $permissions[] = $perm->slug;
            }
        }
        return array_values(array_unique($permissions));
    }

    public function getAllPermissionsAnyWay() {
        $perms = array_merge(
            $this->getAllPermissions(),
            $this->getAllPermissionsViaRoles()
        );
        return array_values(array_unique($perms));
    }

    public function getAllRoles() {
        return $this->roles->pluck('slug')->toArray();
    }
}
