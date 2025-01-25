<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $createdDate = clone ($date);

        $permissions = [
            [
                'group_name' => 'Role',
                'name' => 'role-list',
                'guard_name' => 'web',
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
            ],
            [
                'group_name' => 'Role',
                'name' => 'role-create',
                'guard_name' => 'web',
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
            ],
            [
                'group_name' => 'Role',
                'name' => 'role-edit',
                'guard_name' => 'web',
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
            ],
            [
                'group_name' => 'Role',
                'name' => 'role-delete',
                'guard_name' => 'web',
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
            ],
            [
                'group_name' => 'Post',
                'name' => 'post-list',
                'guard_name' => 'web',
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
            ],
            [
                'group_name' => 'Post',
                'name' => 'post-create',
                'guard_name' => 'web',
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
            ],
            [
                'group_name' => 'Post',
                'name' => 'post-edit',
                'guard_name' => 'web',
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
            ],
            [
                'group_name' => 'Post',
                'name' => 'post-delete',
                'guard_name' => 'web',
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
            ],
            [
                'group_name' => 'User',
                'name' => 'user-list',
                'guard_name' => 'web',
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
            ],
            [
                'group_name' => 'User',
                'name' => 'user-create',
                'guard_name' => 'web',
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
            ],
            [
                'group_name' => 'User',
                'name' => 'user-edit',
                'guard_name' => 'web',
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
            ],
            [
                'group_name' => 'User',
                'name' => 'user-delete',
                'guard_name' => 'web',
                'created_at' => $createdDate,
                'updated_at' => $createdDate,
            ],
        ];
     
        foreach ($permissions as $key => $role) {
            $check = Permission::where('name', $role['name'])->first();
            if (empty($check)) {
                $check = new Permission();
            }
            $check->group_name = $role['group_name'];
            $check->name = $role['name'];
            $check->guard_name = $role['guard_name'];
            $check->save();
        }

        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $adminRole->givePermissionTo(Permission::all()); // Give admin all permissions

        // Assign specific permissions to the user role
        $userRole->givePermissionTo([
            'post-list',
            'post-create',
            'post-delete'
        ]);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password') // Use a secure password
        ]);
        $admin->assignRole('admin'); // Assign admin role

        // Create Regular User
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password') // Use a secure password
        ]);
        $user->assignRole('user');

    }
}
