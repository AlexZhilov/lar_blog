<?php

namespace App\Services\User;

use App\Http\Requests\Admin\Permission\PermissionCreateRequest;
use App\Http\Requests\Admin\Permission\PermissionUpdateRequest;
use App\Models\User\Permission;
use Illuminate\Support\Facades\DB;

class PermissionService
{

    public function store(PermissionCreateRequest $request): Permission
    {
        return DB::transaction(function () use ($request) {
            $data = collect($request->validated());

            $users = $data->pull('users', []);
            $roles = $data->pull('roles', []);

            $permission = Permission::create($data->toArray());

            $permission->users()->attach($users); // Привязываем пользователей
            $permission->roles()->attach($roles); // Привязываем роли

            return $permission;
        });
    }

    public function update(PermissionUpdateRequest $request, Permission $permission): void
    {
        DB::transaction(function () use ($request, $permission) {
            $data = collect($request->validated());

            $permission->users()->sync($data->pull('users'));// Синхронизация пользователей
            $permission->roles()->sync($data->pull('roles'));// Синхронизация ролей

            $permission->update($data->toArray());
            $permission->touch();
        });
    }

    public function delete(Permission $permission)
    {
        if ($permission->users()->exists()) {
            throw new \DomainException('Невозможно удалить разрешение, так как оно назначено пользователям: ' . $permission->users()->pluck('name')->implode(', '));
        }

        $permission->roles()->detach();
        $permission->delete();
    }
}