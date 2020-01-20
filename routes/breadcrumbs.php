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

/*------------- Economic activities -------------*/
Breadcrumbs::for('economic-activities', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Actividades económicas', url('economic-activities'));
});

/*------------- Economic activities > create -------------*/
Breadcrumbs::for('economic-activities/create', function ($trail) {
    $trail->parent('economic-activities');
    $trail->push('Crear actividad económica', url('economic-activities/create'));
});



/*------------- Sectores económicos -------------*/
Breadcrumbs::for('settings/economic-sectors', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Sectores económicos', url('settings/economic-sectors'));
});

/*------------- Sectores económicos > create -------------*/
Breadcrumbs::for('settings/economic-sectors/create', function ($trail) {
    $trail->parent('settings/economic-sectors');
    $trail->push('Crear sector económico', url('settings/economic-sectors/create'));
});

/*------------- Sectores económicos > update -------------*/
Breadcrumbs::for('settings/economic-sectors/update', function ($trail) {
    $trail->parent('settings/economic-sectors');
    $trail->push('Editar sector económico', url('settings/economic-sectors/update'));
});
