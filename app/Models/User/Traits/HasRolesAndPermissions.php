<?php

namespace App\Models\User\Traits;

use App\Models\User\Role;
use App\Models\User\Permission;

/**
 * Trait HasRolesAndPermissions
 * @package App\Models\User\Traits
 */
trait HasRolesAndPermissions
{
    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    /**
     * @return mixed
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    /**
     * @param mixed ...$roles
     * @return bool
     */
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }

    public function attachRole(...$roles): void
    {
        foreach ($roles as $role) {
            $this->roles()->attach(Role::where('slug', $role)->first());
        }
    }


    public function isRoot(): bool
    {
        return $this->hasRole('root');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('root', 'admin');
    }

    /**
     * Имеет текущий пользователь право $permission либо напрямую,
     * либо через одну из своих ролей?
     *
     * @param $permission
     * @return bool
     */
    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    public function getMainRole()
    {
        return $this->roles->first();
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return $this->permissions->contains('slug', $permission);
    }


    /**
     * Имеет текущий пользователь право $permission через одну
     * из своих ролей?
     * @param $permission
     * @return bool
     */
    public function hasPermissionThroughRole($permission)
    {
        // смотрим все роли пользователя и ищем в них нужное право
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('slug', $permission)) {
                return true;
            }
        }
        return false;

    }

    /**
     * Имеет текущий пользователь любое право из $permissions либо
     * напрямую, либо через одну из своих ролей?
     *
     * @param array $permissions
     * @return bool
     */
    public function hasAnyPermission(...$permissions) {
        foreach ($permissions as $permission) {
            if ($this->hasPermissionThroughRole($permission) || $this->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * получает все Права на основе переданного массива
     * @param array $permissions
     * @return mixed
     */
    public function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('slug', $permissions)->get();
    }

    /**
     * сохранить разрешения для текущего пользователя
     * @param mixed ...$permissions
     * @return $this
     */
    public function givePermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }


    /**
     * удаляем все прикрепленные Права
     * @param mixed ...$permissions
     * @return $this
     */
    public function deletePermissions(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    /**
     * удаляет все Права Пользователя
     * @param mixed ...$permissions
     * @return HasRolesAndPermissions
     */
    public function refreshPermissions(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

}
