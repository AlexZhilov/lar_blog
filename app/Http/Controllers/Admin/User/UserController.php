<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\User\UserCreateRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Models\User\User;
use App\Repositories\User\PermissionRepository;
use App\Repositories\User\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    private $users;
    private $roles;
    private $permissions;

    public function __construct(
        UserService          $service,
        UserRepository       $users,
        RoleRepository       $roles,
        PermissionRepository $permissions
    )
    {
        $this->service = $service;
        $this->users = $users;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    public function index(Request $request)
    {
        return view('admin.user.index', [
            'users' => $this->users->getAllWithPaginate($request),
            'roles' => $this->roles->getList(),
        ]);
    }

    public function create(User $user)
    {
        return view('admin.user.store', [
            'user' => $user,
            'roles' => $this->roles->getList(),
            'permissions' => $this->permissions->getList(),
        ]);
    }

    public function store(UserCreateRequest $request)
    {
        $user = $this->service->store($request);
        return redirect()->route('admin.user.edit', $user->id);
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        return view('admin.user.update', [
            'user' => $user,
            'roles' => $this->roles->getList(),
            'permissions' => $this->permissions->getList(),
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->service->update($request, $user);
        return redirect()->route('admin.user.edit', $user->id);
    }

    public function destroy(User $user)
    {
        try {
            $this->service->delete($user);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('admin.user.index');
    }

    public function ajaxAuth()
    {
        Auth::loginUsingId(request('id'));
        return request('id');
    }

    public function ajaxDeleteImage()
    {
        $this->service->removeImage($this->users->getById(request('id')));
    }

}
