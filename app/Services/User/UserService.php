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

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = collect($request->validated());

//        dd($data);
        DB::transaction(function () use ($data, $user) {

            $user->roles()->sync( $data->pull('roles') );
            //avatar
            if ($data->has('avatar')) {
                $data->put('avatar', $this->saveImage($data->pull('avatar'), $user->id));
            }
            // activate
            if ($data->has('active')) {
                $data->put('email_verified_at', $data->get('active') ? now() : null);
            }
            //password
            if ($pass = $data->pull('password')) {
                $data->put('password', bcrypt($pass));
            }

            $user->update($data->toArray());
        });
    }

    /**
     * @param Post $post
     */
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
    }

    private function saveImage($fileImage, $prefix_id = '')
    {
        return $this->image
                ->file( $fileImage )
                ->dir('user')
                ->nameLength(0)
                ->prefix($prefix_id)
                ->size(300,300)
                ->upload(false)['user'];
    }

    public function store(UserCreateRequest $request)
    {
        return User::create($request->all());
    }

}