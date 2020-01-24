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

/*------------- Economic activities -------------*/
Breadcrumbs::for('representations', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Representantes', url('representations'));
});

/*------------- Economic activities > create -------------*/
Breadcrumbs::for('representations/create', function ($trail) {
    $trail->parent('representations');
    $trail->push('Crear representante', url('representations/create'));
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

/*------------- Taxpayers -------------*/
Breadcrumbs::for('taxpayers', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Contribuyente', url('taxpayers'));
});

/*------------- Taxpayers > create -------------*/
Breadcrumbs::for('taxpayers/create', function ($trail) {
    $trail->parent('taxpayers');
    $trail->push('Crear contribuyente', url('taxpayers/create'));
});

/*------------- Taxpayers > update -------------*/
Breadcrumbs::for('taxpayers/update', function ($trail) {
    $trail->parent('taxpayers');
    $trail->push('Editar contribuyente', url('taxpayers/update'));
});

/*------------- Tax units -------------*/
Breadcrumbs::for('settings/tax-units', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Unidades Tributarias', url('settings/tax-units'));
});

/*------------- Tax units > create -------------*/
Breadcrumbs::for('settings/tax-units/create', function ($trail) {
    $trail->parent('settings/tax-units');
    $trail->push('Crear unidad tributaria', url('settings/tax-units/create'));
});

/*------------- Tax units > update -------------*/
Breadcrumbs::for('settings/tax-units/update', function ($trail) {
    $trail->parent('settings/tax-units');
    $trail->push('Editar unidad tributaria', url('settings/tax-units/update'));
});

/*------------- Application types -------------*/
Breadcrumbs::for('settings/application-types', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tipos de solicitudes', url('settings/application-types'));
});

/*------------- Application types > create -------------*/
Breadcrumbs::for('settings/application-types/create', function ($trail) {
    $trail->parent('settings/application-types');
    $trail->push('Crear nuevo tipo de solicitud', url('settings/application-types/create'));
});

/*------------- Application types > update -------------*/
Breadcrumbs::for('settings/application-types/update', function ($trail) {
    $trail->parent('settings/application-types');
    $trail->push('Editar tipo de solicitud', url('settings/application-types/update'));
});

/*------------- Applications -------------*/
Breadcrumbs::for('applications', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Solicitudes', url('applications'));
});
