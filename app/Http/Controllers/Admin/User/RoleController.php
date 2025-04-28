<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleCreateRequest;
use App\Http\Requests\Admin\Role\RoleUpdateRequest;

use App\Models\User\Role;
use App\Repositories\User\PermissionRepository;
use App\Repositories\User\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Services\User\RoleService;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    private PermissionRepository $permissions;
    private RoleService $service;
    private RoleRepository $roles;
    private UserRepository $users;

    public function __construct(
        RoleService          $service,
        PermissionRepository $permissions,
        RoleRepository       $roles,
        UserRepository       $users
    )
    {
        $this->service = $service;
        $this->permissions = $permissions;
        $this->roles = $roles;
        $this->users = $users;

    }

    public function index()
    {
        return view('admin.role.index', [
            'roles' => $this->roles->getAllWithPaginate(),
        ]);
    }

    public function create(Role $role)
    {
        return view('admin.role.store', [
            'role' => $role,
            'permissions' => $this->permissions->getList(),
            'users' => $this->users->getAllForDropList(),
        ]);
    }

    public function store(RoleCreateRequest $request): RedirectResponse
    {
        $role = $this->service->store($request);
        return redirect()->route('admin.roles.edit', $role);
    }

    public function edit(Role $role)
    {
        return view('admin.role.store', [
            'role' => $role,
            'permissions' => $this->permissions->getList(),
            'users' => $this->users->getAllForDropList(),
        ]);
    }

    public function update(RoleUpdateRequest $request, Role $role): RedirectResponse
    {
        $this->service->update($request, $role);
        return redirect()->route('admin.roles.edit', $role);
    }

    public function destroy(Role $role): RedirectResponse
    {
        try {
            $this->service->delete($role);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.roles.index');
    }
}
