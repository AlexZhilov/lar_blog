<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\PermissionCreateRequest;
use App\Http\Requests\Admin\Permission\PermissionUpdateRequest;

use App\Models\User\Permission;
use App\Repositories\User\PermissionRepository;
use App\Repositories\User\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Services\User\PermissionService;

class PermissionController extends Controller
{

    private PermissionRepository $permissions;
    private PermissionService $service;
    private RoleRepository $roles;
    private UserRepository $users;

    public function __construct(
        PermissionService    $service,
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
        return view('admin.permission.index', [
            'permissions' => $this->permissions->getAllWithPaginate(),
        ]);
    }

    public function create(Permission $permission)
    {
        return view('admin.permission.store', [
            'permission' => $permission,
            'roles' => $this->roles->getList(),
            'users' => $this->users->getAllForDropList(),
        ]);
    }

    public function store(PermissionCreateRequest $request)
    {
        $permission = $this->service->store($request);
        return redirect()->route('admin.permissions.edit', $permission);
    }

    public function edit(Permission $permission)
    {
        return view('admin.permission.store', [
            'permission' => $permission,
            'roles' => $this->roles->getList(),
            'users' => $this->users->getAllForDropList(),
        ]);
    }

    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        $this->service->update($request, $permission);
        return redirect()->route('admin.permissions.edit', $permission);
    }

    public function destroy(Permission $permission)
    {
        try {
            $this->service->delete($permission);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.permissions.index');
    }
}
