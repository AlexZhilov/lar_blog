<?php

namespace Database\Seeders\User;

use App\Models\User\Permission;
use Database\Factories\User\PermissionFactory;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createPermissions();
    }

    private function createPermissions()
    {
        foreach (PermissionFactory::permissions() as $permission){
            Permission::factory()->create($permission);
        }
    }
}
