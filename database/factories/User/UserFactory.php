<?php

namespace Database\Factories\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'active' => random_int(0,100) < 90 ? 1 : 0,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    public static function adminUsers()
    {
        return [
            [
                'name' => env('ADMIN_USERNAME','admin'),
                'email' => env('ADMIN_EMAIL','admin@admin.ru'),
                'email_verified_at' => now(),
                'active' => 1,
                'password' => Hash::make(env('ADMIN_PASSWORD','12345678')), // password
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'manager',
                'email' => 'manager@manager.ru',
                'email_verified_at' => now(),
                'active' => 1,
                'password' => Hash::make('12345678'), // password
                'remember_token' => Str::random(10),
            ]
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
