<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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

        // Admin catastro
        $cadastreAdmin = User::create([
            'identity_card' => '1234561',
            'names' => 'Administrador',
            'surnames' => 'catastro',
            'login' => 'admincadastre',
            'password' => bcrypt('qwerty123'),
        ]);

        $cadastreAdmin->syncRoles([Role::whereName('Admin')->first()]);
        $cadastreAdmin->syncPermissions([Permission::whereName('cadastre-admin')->first()]);
    }
}
