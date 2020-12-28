<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
        Role::create([
            'name'     =>  'ADMIN',
            'slug'     =>  'admin',
            'special'  =>  'all-access'
        ]);

        $roles = Role::all();
        
     	User::All()->each(function ($user) use ($roles) {
            $user->roles()->saveMany($roles);
        });
        **/
    }
}
