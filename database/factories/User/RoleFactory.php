<?php

namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public static function roles()
    {
        return [
            ['slug' => 'root', 'name' => 'Super-admin'],
            ['slug' => 'admin', 'name' => 'Администратор'],
            ['slug' => 'manager', 'name' => 'Менеджер'],
            ['slug' => 'user', 'name' => 'Пользователь'],
        ];
    }


}
