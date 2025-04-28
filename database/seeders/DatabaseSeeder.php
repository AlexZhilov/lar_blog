<?php

namespace Database\Seeders;

use Database\Seeders\Blog\BlogSeeder;
use Database\Seeders\Shop\ShopSeeder;
use Database\Seeders\User\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->command->info('Пользователи созданы');

        $this->call(BlogSeeder::class);
        $this->command->info('Посты в блоге созданы');

        $this->call(ShopSeeder::class);
        $this->command->info('Товары в магазине созданы');
    }


}
