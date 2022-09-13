<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Admin\BaseController;
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Models\User\User;
use App\Repositories\User\PermissionRepository;
use App\Repositories\User\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Services\User\UserService;
use App\Http\Requests\Admin\User\Request as UserRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    private $userRepository;
    private $roleRepository;
    private $permissionRepository;

    public function __construct(
        UserService $service,
        UserRepository $userRepository,
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository
    )
    {
        $this->service = $service;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.user.index', [
            'users' => $this->userRepository->getAllWithRoleAndPaginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(User $user)
    {
        return view('admin.user.store', [
            'user' => $user,
            'roles' => $this->roleRepository->getList(),
            'permission' => Permission::pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('admin.user.store', [
            'user' => $user,
            'roles' => $this->roleRepository->getList(),
            'permission' => Permission::pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $this->service->update(collect($request->validated()), $user);
        return redirect()->route('admin.user.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajaxAuth()
    {
        Auth::loginUsingId(request('id'));
        return request('id');
    }

    public function ajaxDeleteImage()
    {
        $this->service->removeImage($this->userRepository->getById(request('id')));
    }

}
