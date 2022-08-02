<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user_value = [
            "email_verified_at" => now(),
            "password" => bcrypt('admin123'),
            "address" => "Kab. Kediri, Kec. Plemahan",
            "remember_token" => Str::random(10),
        ];
        DB::beginTransaction();
        try {
            $admin = User::create(array_merge([
                'email' => 'admin@nu.com',
                'name' => 'admin',
            ], $default_user_value));

            $bendahara = User::create(array_merge([
                'email' => 'bendahara@nu.com',
                'name' => 'bendahara',
            ], $default_user_value));

            $kolektor = User::create(array_merge([
                'email' => 'kolektor@nu.com',
                'name' => 'kolektor',
            ], $default_user_value));

            $role_admin = Role::create(['name' => 'admin']);
            $role_bendahara = Role::create(['name' => 'bendahara']);
            $role_kolektor = Role::create(['name' => 'kolektor']);

            $permission_create_role = Permission::create(['name' => 'create role']);
            $permission_read_role = Permission::create(['name' => 'read role']);
            $permission_update_role = Permission::create(['name' => 'update role']);
            $permission_delete_role = Permission::create(['name' => 'delete role']);

            $admin->assignRole('admin');
            $bendahara->assignRole('bendahara');
            $kolektor->assignRole('kolektor');

            $role_admin->givePermissionTo(['create role', 'read role', 'update role', 'delete role']);

            $permission_create_user = Permission::create(['name' => 'create user']);
            $permission_read_user = Permission::create(['name' => 'read user']);
            $permission_update_user = Permission::create(['name' => 'update user']);
            $permission_delete_user = Permission::create(['name' => 'delete user']);

            $role_admin->givePermissionTo(['create user', 'read user', 'update user', 'delete user']);

            $permission_create_coin = Permission::create(['name' => 'create coin']);
            $permission_read_coin = Permission::create(['name' => 'read coin']);
            $permission_update_coin = Permission::create(['name' => 'update coin']);
            $permission_delete_coin = Permission::create(['name' => 'delete coin']);

            $permission_print_report = Permission::create(['name' => 'print report']);

            $role_admin->givePermissionTo(['create coin', 'read coin', 'update coin', 'delete coin', 'print report']);
            $role_bendahara->givePermissionTo(['create coin', 'read coin', 'update coin', 'delete coin', 'print report']);
            $role_kolektor->givePermissionTo(['create coin', 'read coin', 'update coin', 'delete coin']);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
