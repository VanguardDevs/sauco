<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'dni' => env('ADMIN_DNI', '12345678'),
            'first_name' => env('ADMIN_NAME', 'user'),
            'surname' => env('ADMIN_SURNAME', 'admin'),
            'login' => env('ADMIN_LOGIN', 'admin'),
            'password' => bcrypt(env('ADMIN_PASSWORD', 'qwerty123')),
            'active' => true 
        ]);

        $role = Role::create(['name' => 'Admin']);
        
        $user->syncRoles([$role]);
    }
}
