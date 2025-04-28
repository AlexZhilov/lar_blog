<?php

namespace App\Services\User;

use App\Http\Requests\Admin\Role\RoleCreateRequest;
use App\Http\Requests\Admin\Role\RoleUpdateRequest;
use App\Models\User\Role;
use Illuminate\Support\Facades\DB;

class RoleService
{

    public function store(RoleCreateRequest $request): Role
    {
        return DB::transaction(function () use ($request) {
            $data = collect($request->validated());

            $permissions = $data->pull('permissions');
            $users = $data->pull('users');

            $role = Role::create($data->toArray());

            $role->permissions()->attach($permissions);
            $role->users()->attach($users);

            return $role;
        });
    }

    public function update(RoleUpdateRequest $request, Role $role): void
    {
        DB::transaction(function () use ($request, $role) {
            $data = collect($request->validated());

            $role->permissions()->sync($data->pull('permissions'));
            $role->users()->sync($data->pull('users'));
            $role->update($data->toArray());
            $role->touch();
        });

    }

    public function delete(Role $role)
    {
        if ($role->users()->count() > 0) {
            throw new \DomainException('Role has users');
        }

        if ($role->permissions()->count() > 0) {
            throw new \DomainException('Role has permissions');
        }

        $role->delete();

    }
}