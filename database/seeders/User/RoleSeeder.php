<?php

namespace Database\Seeders\User;

use App\Models\User\Role;
use App\Repositories\User\PermissionRepository;
use Database\Factories\User\RoleFactory;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles();
    }

    private function createRoles()
    {
        foreach (RoleFactory::roles() as $role){
            $createdRole = Role::factory()->create($role);

            if( $createdRole->slug == 'admin' || $createdRole->slug == 'root' ){
                $createdRole->permissions()->attach((new PermissionRepository)->getAll());
            }
        }
    }
}
