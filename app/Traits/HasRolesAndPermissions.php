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
        return $this->belongsToMany(Role::class, 'users_roles')->withTimestamps();
    }

    /**
     * Linking the User model with the Permission model allows you to get all the user rights
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions')->withTimestamps();
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

    /**
     * @return mixed
     */
    public function getAllPermissions()
    {
        return $this->permissions->pluck('slug')->toArray();
    }

    /**
     * @return array
     */
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

    /**
     * @return array
     */
    public function getAllPermissionsAnyWay() {
        $perms = array_merge(
            $this->getAllPermissions(),
            $this->getAllPermissionsViaRoles()
        );
        return array_values(array_unique($perms));
    }

    /**
     * @return mixed
     */
    public function getAllRoles() {
        return $this->roles->pluck('slug')->toArray();
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function assignPermissions(...$permissions) {
        $permissions = Permission::whereIn('slug', $permissions)->get();

        if ($permissions->count() === 0) {
            return $this;
        }

        $this->permissions()->syncWithoutDetaching($permissions);

        return $this;
    }

    /**
     * Take away the permission of the current user
     * @param mixed ...$permissions
     * @return $this
     */
    public function unassignPermissions(...$permissions) {
        $permissions = Permission::whereIn('slug', $permissions)->get();

        if ($permissions->count() === 0) {
            return $this;
        }

        $this->permissions()->detach($permissions);

        return $this;
    }

    /**
     * @param mixed ...$permissions
     * @return $this
     */
    public function refreshPermissions(...$permissions) {
        $permissions = Permission::whereIn('slug', $permissions)->get();

        if ($permissions->count() === 0) {
            return $this;
        }

        $this->permissions()->sync($permissions);

        return $this;
    }

    /**
     * Add the current user to the role $roles
     * @param mixed ...$roles
     * @return $this
     */
    public function assignRoles(...$roles) {
        $roles = Role::whereIn('slug', $roles)->get();

        if ($roles->count() === 0) {
            return $this;
        }

        $this->roles()->syncWithoutDetaching($roles);

        return $this;
    }

    /**
     * take away the current user with the role $roles
     * @param mixed ...$roles
     * @return $this
     */
    public function unassignRoles(...$roles) {
        $roles = Role::whereIn('slug', $roles)->get();
        if ($roles->count() === 0) {
            return $this;
        }
        $this->roles()->detach($roles);
        return $this;
    }

    /**
     * Assign the current user to the role $roles
     * @param mixed ...$roles
     * @return $this
     */
    public function refreshRoles(...$roles) {
        $roles = Role::whereIn('slug', $roles)->get();

        if ($roles->count() === 0) {
            return $this;
        }

        $this->roles()->sync($roles);

        return $this;
    }
}
