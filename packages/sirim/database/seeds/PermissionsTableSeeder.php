<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        Permission::create([
        	'name'				=>	'LISTAR PERMISOS',
        	'slug'				=>	'administration.permissions.index',
        	'description'	=>	'LISTA Y NAVEGA POR LOS PERMISOS DE USUARIOS'
        ]);
        Permission::create([
        	'name'				=>	'CREAR PERMISOS',
        	'slug'				=>	'administration.permissions.create',
        	'description'	=>	'CREAR NUEVOS PERMISOS DE USUARIOS'
        ]);
        Permission::create([
        	'name'				=>	'EDITAR PERMISOS',
        	'slug'				=>	'administration.permissions.edit',
        	'description'	=>	'EDITAR PERMISOS DE USUARIOS'
        ]);

        //Roles
        Permission::create([
            'name'				=>	'LISTAR ROLES',
            'slug'				=>	'administration.roles.index',
            'description'	=>	'LISTA Y NAVEGA POR LOS ROLES DE USUARIOS'
        ]);
        Permission::create([
            'name'				=>	'CREAR ROLES',
            'slug'				=>	'administration.roles.create',
            'description'	=>	'CREAR NUEVOS ROLES DE USUARIOS'
        ]);
        Permission::create([
            'name'				=>	'EDITAR ROLES',
            'slug'				=>	'administration.roles.edit',
            'description'	=>	'EDITAR ROLES DE USUARIOS'
        ]);

        //Users
        Permission::create([
            'name'				=>	'LISTAR USUARIOS',
            'slug'				=>	'administration.users.index',
            'description'	=>	'LISTA Y NAVEGA POR LOS REGISTROS DE USUARIOS'
        ]);
        Permission::create([
            'name'				=>	'CREAR USUARIO',
            'slug'				=>	'administration.users.create',
            'description'	=>	'CREAR NUEVOS USUARIOS DEL SISTEMA'
        ]);
        Permission::create([
            'name'				=>	'EDITAR PERMISOS',
            'slug'				=>	'administration.users.edit',
            'description'	=>	'EDITAR REGISTRO DE USUARIO'
        ]);

    }
}
