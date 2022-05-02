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
            'identity_card' => env('ADMIN_DNI', '12345678'),
            'names' => env('ADMIN_NAME', 'user'),
            'surnames' => env('ADMIN_SURNAME', 'admin'),
            'login' => env('ADMIN_LOGIN', 'admin'),
            'password' => bcrypt(env('ADMIN_PASSWORD', 'qwerty123')),
            'avatar' => 'default/user.png'
        ]);

        $user->syncRoles([Role::whereName('Admin')->first()]);
        $user->syncPermissions([Permission::whereName('super-admin')->first()]);
    }
}
