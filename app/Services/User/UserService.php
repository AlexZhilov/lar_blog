<?php

namespace App\Services\User;

use App\Models\User\User;
use App\UseCases\Files\ImageService;
use Illuminate\Support\Facades\DB;
use Storage;

class UserService
{
    private $image;

    public function __construct(ImageService $image)
    {
        $this->image = $image;
    }

    public function update($data, User $user)
    {
        DB::transaction( function () use ($data, $user){

            $user->roles()->sync( $data->pull('roles') );
            //avatar
            if( $data->has('avatar') ){
                $data->put('avatar', $this->saveImage( $data->pull('avatar'), $user->id ));
            }
            //password
            if( $pass = $data->pull('password') )
                $data->put('password', bcrypt($pass));

            $user->update( $data->toArray() );
        });
    }

    /**
     * @param Post $post
     */
    public function delete(User $user)
    {
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


}