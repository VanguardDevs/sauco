<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

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
        ]);

        $user->syncRoles([Role::whereName('Admin')->first()]);
        $user->syncPermissions([Permission::whereName('super-admin')->first()]);
    }
}
