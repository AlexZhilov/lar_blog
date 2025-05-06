<?php

namespace App\Services\User;

use App\Http\Requests\Admin\User\UserCreateRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest;
use App\Models\User\User;
use App\UseCases\Files\ImageService;
use Auth;
use Illuminate\Support\Facades\DB;
use Storage;

class UserService
{
    private $image;

    public function __construct(ImageService $image)
    {
        $this->image = $image;
    }

    /**
     * @throws \Throwable
     */
    public function update(UserUpdateRequest $request, User $user): User
    {
        return DB::transaction(function () use ($request, $user) {
            $data = collect($request->validated());
//            dd($data);
            $user->roles()->sync( $data->pull('roles') );
            $user->permissions()->sync( $data->pull('permissions') );

            $data->put('avatar', $this->saveImage($data->pull('avatar'), $user->id));

           // activate
            $activate = $data->pull('active');
            if ((!$user->isActive() && $activate) || ($user->isActive() && !$activate)) {
                $data->put('email_verified_at', $activate ? now() : null);
            }
            //password
            if ($pass = $data->pull('password')) {
                $data->put('password', bcrypt($pass));
            }
            $user->update($data->toArray());

            return $user;
        });
    }

    /**
     * @throws \Throwable
     */
    public function store(UserCreateRequest $request): User
    {
        return DB::transaction(function () use ($request) {
            $data = collect($request->validated());

            $roles = $data->pull('roles');
            $permissions = $data->pull('permissions');

            $data->put('email_verified_at', $data->pull('active') ? now() : null);
            $data->put('password', bcrypt($data->pull('password')));
            $data->put('avatar', $this->saveImage($data->pull('avatar')));

            $user = User::create($data->toArray());

            $user->roles()->attach($roles);
            $user->permissions()->attach($permissions);

            return $user;
        });
    }

    public function delete(User $user): void
    {
        // нельзя удалить админа
        if ($user->isAdmin()) {
            throw new \RuntimeException('Admin user can not be deleted. Please change role.');
        }
        // нельзя удалить себя
        if (Auth::id() === $user->id) {
            throw new \RuntimeException('You can not delete yourself.');
        }

        $this->removeImage($user);
        $user->delete();
    }

    public function removeImage(User $user)
    {
        Storage::delete(storage_image($user->avatar));
        $user->update(['avatar' => '']);

        return [
            'message' =>  __('Image deleted'),
            'status' => 'success',
            'data' => $user
        ];
    }

    private function saveImage($fileImage, $prefix_id = '')
    {
        if (!$fileImage) {
            return null;
        }
        return $this->image
                ->file( $fileImage )
                ->dir('user')
                ->nameLength(0)
                ->prefix($prefix_id)
                ->size(300,300)
                ->upload(false)['user'];
    }


}