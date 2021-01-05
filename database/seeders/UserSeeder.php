<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::get();

        foreach($roles as $role) {
            $user = User::factory()->create();
            $user->syncRoles($role);
        }

        $admin = User::create([
            'dni' => '1234567',
            'first_name' => 'Admin',
            'surname' => 'User',
            'password' => bcrypt('qwerty123'),
            'login' => 'admin',
            'remember_token' => Str::random(10),
        ]);
        $admin->syncRoles($role->find(3));
    }
}
