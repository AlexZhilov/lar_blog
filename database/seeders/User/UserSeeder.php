<?php

namespace Database\Seeders\User;

use App\Models\User\User;
use App\Repositories\User\PermissionRepository;
use App\Repositories\User\RoleRepository;
use Database\Factories\User\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);

        $this->createAdminUsers();

        User::factory(20)->create();
    }

    private function createAdminUsers()
    {
        foreach (UserFactory::adminUsers() as $adminUser){
            $user = User::factory()->create($adminUser);

            // create admin permissions
            if($user->name == env('ADMIN_USERNAME', 'admin') ){
                $user->roles()->attach((new RoleRepository)->getBySlug('admin'));
                $user->permissions()->attach((new PermissionRepository)->getAll());
            }
            // create manager permissions
            if($user->name == 'manager' ){
                $user->roles()->attach((new RoleRepository)->getBySlug('manager'));
                $user->permissions()->attach((new PermissionRepository)->getBySlugIn(['admin-access','blog-post-create']));

            }
        }
    }




}
