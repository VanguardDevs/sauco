<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'identity_card' =>  '27572434',
            'first_name'    =>  'Jesús',
            'surname'	    =>  'Ordosgoitty',
            'login'         =>  'admin',
            'password'      =>  bcrypt('qwerty123'),
            'avatar'   	    =>  'admin.png'
        ]);

        Role::create([
            'name'     =>  'ADMIN',
            'slug'     =>  'admin',
            'special'  =>  'all-access'
        ]);
        /**
         *
         */
        $roles = Role::all();
        /***/
     	User::All()->each(function ($user) use ($roles) {
	        $user->roles()->saveMany($roles);
	   	});
    }
}
