<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id'        => 1,
                'first_name'        => 'Mr.',
                'last_name'         => 'Admin',
                'address'           => 'Dhaka, Bangladesh',
                'phone'             => '0123456789',
                'email'             => 'admin@localhost.local',
                'date_of_birth'     =>  '2024-04-16',
                'id_verification'   =>  null,
                'password'          =>  Hash::make('admin'),
            ]
        ]);
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'guard_name' => 'web'
            ]
        ]);
        $user = User::find(1);
        $user->assignRole('Admin');

        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => 'role-list',
                'guard_name' => 'web'
            ],[
                'id' => 2,
                'name' => 'role-create',
                'guard_name' => 'web'
            ],[
                'id' => 3,
                'name' => 'role-edit',
                'guard_name' => 'web'
            ],[
                'id' => 4,
                'name' => 'role-delete',
                'guard_name' => 'web'
            ],[
                'id' => 5,
                'name' => 'role-sidebar',
                'guard_name' => 'web'
            ],
            [
                'id' => 6,
                'name' => 'user-sidebar',
                'guard_name' => 'web'
            ],
            [
                'id' => 7,
                'name' => 'user-list',
                'guard_name' => 'web'
            ],
            [
                'id' => 8,
                'name' => 'dashboard-sidebar',
                'guard_name' => 'web'
            ]
        ]);
        DB::table('model_has_roles')->insert([
            [
                'role_id' => 1,
                'model_type' => 'App\Model\User',
                'model_id' => 1
            ]
        ]);

        DB::table('role_has_permissions')->insert([
            [
                'permission_id' => 1,
                'role_id' => 1
            ],[
                'permission_id' => 2,
                'role_id' => 1
            ],[
                'permission_id' => 3,
                'role_id' => 1
            ],[
                'permission_id' => 4,
                'role_id' => 1
            ],[
                'permission_id' => 5,
                'role_id' => 1
            ],[
                'permission_id' => 6,
                'role_id' => 1
            ],[
                'permission_id' => 7,
                'role_id' => 1
            ],[
                'permission_id' => 8,
                'role_id' => 1
            ]
        ]);
    }
}
