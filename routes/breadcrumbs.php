<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

/*----------  Dashboard  ----------*/
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Inicio', route('dashboard'));
});

/*------------- Users -------------*/
Breadcrumbs::for('administration/users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Usuarios', url('administration/users'));
});

/*------------- Users > Create -------------*/
Breadcrumbs::for('administration/users/create', function ($trail) {
    $trail->parent('administration/users');
    $trail->push('Crear Usuarios', url('administration/users/create'));
});

/*------------- Users > edit -------------*/
Breadcrumbs::for('administration/users/edit', function ($trail, $row) {
    $trail->parent('administration/users');
    $trail->push('Editar Usuario '/*.$row->login*/, url('administration/users/edit', $row->id));
});

/*------------- Roles -------------*/
Breadcrumbs::for('administration/roles', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Roles', url('administration/roles'));
});

/*------------- Roles > Create -------------*/
Breadcrumbs::for('administration/roles/create', function ($trail) {
    $trail->parent('administration/roles');
    $trail->push('Crear Rol', url('administration/roles/create'));
});

/*------------- Roles > edit -------------*/
Breadcrumbs::for('administration/roles/edit', function ($trail, $row) {
    $trail->parent('administration/roles');
    $trail->push('Editar Rol '/*.$row->login*/, url('administration/roles/edit', $row->id));
});

/*------------- Parishes -------------*/
Breadcrumbs::for('geographic-area/parishes', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Parroquias', url('geographic-area/parishes'));
});

/*------------- Communities -------------*/
Breadcrumbs::for('geographic-area/communities', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Comunidades', url('geographic-area/communities'));
});

/*------------- Communities > create -------------*/
Breadcrumbs::for('geographic-area/communities/create', function ($trail) {
    $trail->parent('geographic-area/communities');
    $trail->push('Crear comunidad', url('geographic-area/communities/create'));
});

/*------------- Communities > update -------------*/
Breadcrumbs::for('geographic-area/communities/update', function ($trail) {
    $trail->parent('geographic-area/communities');
    $trail->push('Editar comunidad', url('geographic-area/communities/update'));
});

/*------------- Service stations > Create -------------*/
Breadcrumbs::for('service-stations/create', function ($trail) {
    $trail->parent('service-stations');
    $trail->push('Crear', url('service-stations/create'));
});

/*------------- Service stations > edit -------------*/
Breadcrumbs::for('service-stations/edit', function ($trail, $row) {
    $trail->parent('service-stations');
    $trail->push('Editar Registro '/*.$row->login*/, url('service-stations/edit', $row->id));
});

/*------------- Configurations -------------*/
Breadcrumbs::for('configurations', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Configuraciones', url('configurations'));
});

/*------------- Configurations > Create -------------*/
Breadcrumbs::for('configurations/create', function ($trail) {
    $trail->parent('configurations');
    $trail->push('Crear', url('configurations/create'));
});

/*------------- Configurations > edit -------------*/
Breadcrumbs::for('configurations/edit', function ($trail, $row) {
    $trail->parent('configurations');
    $trail->push('Editar Registro '/*.$row->login*/, url('configurations/edit', $row->id));
});

/*----------  Register persons  ----------*/
Breadcrumbs::for('register-persons', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Registrar Responsable de Vehículo', url('register-persons'));
});

/*----------  Register vehicles  ----------*/
Breadcrumbs::for('register-vehicles', function ($trail) {
    $trail->parent('register-persons');
    $trail->push('Registrar Vehículo', url('register-vehicles'));
});

/*----------  Validate refuelling  ----------*/
Breadcrumbs::for('refueling', function ($trail, $id) {
    $trail->parent('dashboard');
    $trail->push('Registrar Repostaje '.$id, url('refueling', $id));
});

/*------------- Persons -------------*/
Breadcrumbs::for('persons', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Reponsables de Vehículos', url('persons'));
});

/*------------- Persons > Create -------------*/
Breadcrumbs::for('persons/create', function ($trail) {
    $trail->parent('persons');
    $trail->push('Crear', url('persons/create'));
});

/*------------- Persons > edit -------------*/
Breadcrumbs::for('persons/edit', function ($trail, $row) {
    $trail->parent('persons');
    $trail->push('Editar Registro '/*.$row->login*/, url('persons/edit', $row->id));
});

/*------------- Novelties -------------*/
Breadcrumbs::for('novelties', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Novedades', url('novelties'));
});

/*------------- Novelties > Create -------------*/
Breadcrumbs::for('novelties/create', function ($trail) {
    $trail->parent('novelties');
    $trail->push('Novedades', url('novelties/create'));
});

/*------------- Novelties > edit -------------*/
Breadcrumbs::for('novelties/edit', function ($trail, $row) {
    $trail->parent('novelties');
    $trail->push('Editar Registro '/*.$row->login*/, url('novelties/edit', $row->id));
});
