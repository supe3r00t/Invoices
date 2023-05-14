<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class CreateAdminUserSeeder extends Seeder
{

    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'ksa0.net@gmail.com',
            'password' => bcrypt('admin'),
            'roles_name' => ["owner"],
            'Status' => 'مفعل',
        ]);

        $role = Role::create(['name' => 'owner']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);


    }

}

