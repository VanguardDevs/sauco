<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

/*----------  Cashbox ----------*/
Breadcrumbs::for('cashbox', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Caja', route('cashbox'));
});

/*----------  Cashbox > Settlements ----------*/
Breadcrumbs::for('settlements.index', function ($trail) {
    $trail->parent('cashbox');
    $trail->push('Listado de liquidaciones', url('cashbox/settlements'));
});

/*----------  Cashbox > Payments ----------*/
Breadcrumbs::for('payments.index', function ($trail) {
    $trail->parent('cashbox');
    $trail->push('Listado de pagos', url('cashbox/payments'));
});

/*----------  Cashbox > Null payments ----------*/
Breadcrumbs::for('payments.null', function ($trail) {
    $trail->parent('cashbox');
    $trail->push('Listado de pagos anulados', url('cashbox/null-payments'));
});

/*----------  Cashbox > Null Settlements ----------*/
Breadcrumbs::for('settlements.null', function ($trail) {
    $trail->parent('cashbox');
    $trail->push('Listado de liquidaciones anuladas', url('cashbox/null-settlements'));
});

/*----------  Dashboard  ----------*/
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Inicio', route('dashboard'));
});

/*----------  About  ----------*/
Breadcrumbs::for('about', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Acerca de', url('about'));
});

/*----------  Settings  ----------*/
Breadcrumbs::for('settings.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Configuraciones', url('settings'));
});

/*------------- Users -------------*/
Breadcrumbs::for('permissions.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Permisos', url('administration/permissions'));
});

/*------------- Users > Create -------------*/
Breadcrumbs::for('permissions.create', function ($trail) {
    $trail->parent('permissions.index');
    $trail->push('Crear permiso', url('permissions.create'));
});

/*------------- Users > edit -------------*/
Breadcrumbs::for('permissions.edit', function ($trail, $row) {
    $trail->parent('permissions.index');
    $trail->push('Editar permiso'/*.$row->login*/, url('permissions.edit', $row->id));
});

/*------------- Users -------------*/
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Usuarios', url('administration/users'));
});

/*------------- Users > Create -------------*/
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Crear usuario', url('administration/users/create'));
});

/*------------- Users > edit -------------*/
Breadcrumbs::for('users.edit', function ($trail, $row) {
    $trail->parent('users.index');
    $trail->push('Editar Usuario '/*.$row->login*/, url('administration/users/edit', $row->id));
});

/*------------- Roles -------------*/
Breadcrumbs::for('roles.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Roles', url('administration/roles'));
});

/*------------- Roles > Create -------------*/
Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles.index');
    $trail->push('Crear rol', url('administration/roles/create'));
});

/*------------- Roles > edit -------------*/
Breadcrumbs::for('roles.edit', function ($trail, $row) {
    $trail->parent('roles.index');
    $trail->push('Editar rol '/*.$row->login*/, url('administration/roles/edit', $row->id));
});

/*------------- Parishes -------------*/
Breadcrumbs::for('parishes.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Parroquias', url('geographic-area/parishes'));
});

/*------------- Communities -------------*/
Breadcrumbs::for('communities.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Comunidades', url('geographic-area/communities'));
});

/*------------- Communities > create -------------*/
Breadcrumbs::for('communities.create', function ($trail) {
    $trail->parent('communities.index');
    $trail->push('Crear comunidad', url('geographic-area/communities/create'));
});

/*------------- Communities > edit -------------*/
Breadcrumbs::for('communities.edit', function ($trail) {
    $trail->parent('communities.index');
    $trail->push('Editar comunidad', url('geographic-area/communities/edit'));
});

/*------------- Economic activities -------------*/
Breadcrumbs::for('economic-activities.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Actividades económicas', url('economic-activities'));
});

/*------------- Economic activities > create -------------*/
Breadcrumbs::for('economic-activities.create', function ($trail) {
    $trail->parent('economic-activities.index');
    $trail->push('Crear actividad económica', url('economic-activities/create'));
});

/*------------- Economic activities > edit -------------*/
Breadcrumbs::for('economic-activities.edit', function ($trail) {
    $trail->parent('economic-activities.index');
    $trail->push('Editar actividad económica', url('economic-activities/edit'));
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

Breadcrumbs::for('representations/add', function ($trail) {
    $trail->parent('representations');
    $trail->push('Añadir representante', url('representations/add'));
});

/*------------- Economic activities > edit -------------*/
Breadcrumbs::for('representations/edit', function ($trail) {
    $trail->parent('representations');
    $trail->push('Editar representante', url('representations/edit'));
});

/*------------- Sectores económicos -------------*/
Breadcrumbs::for('economic-sectors.index', function ($trail) {
    $trail->parent('settings.index');
    $trail->push('Sectores económicos', url('settings/economic-sectors'));
});

/*------------- Sectores económicos > create -------------*/
Breadcrumbs::for('economic-sectors.create', function ($trail) {
    $trail->parent('economic-sectors.index');
    $trail->push('Crear sector económico', url('settings/economic-sectors/create'));
});

/*------------- Sectores económicos > update -------------*/
Breadcrumbs::for('economic-sectors.edit', function ($trail) {
    $trail->parent('economic-sectors.index');
    $trail->push('Editar sector económico', url('settings/economic-sectors/edit'));
});

/*------------- Taxpayers -------------*/
Breadcrumbs::for('taxpayers.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Contribuyentes', url('taxpayers'));
});

/*------------- Taxpayers > create -------------*/
Breadcrumbs::for('taxpayers.create', function ($trail) {
    $trail->parent('taxpayers.index');
    $trail->push('Crear contribuyente', url('taxpayers/create'));
});

/*------------- Taxpayers > update -------------*/
Breadcrumbs::for('taxpayers.update', function ($trail) {
    $trail->parent('taxpayers.index');
    $trail->push('Editar contribuyente', url('taxpayers/update'));
});

/**
 * Taxpayers > show
 */
Breadcrumbs::for('taxpayers.show', function ($trail, $row) {
    $trail->parent('taxpayers.index');
    $trail->push('Contribuyente '.$row->id, url('taxpayers', $row->id));
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

/*------------- Charging Methods -------------*/
Breadcrumbs::for('settings/charging-methods', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Métodos de cobro', url('settings/charging-methods'));
});

/*------------- Charging Methods > create -------------*/
Breadcrumbs::for('settings/charging-methods/create', function ($trail) {
    $trail->parent('settings/charging-methods');
    $trail->push('Crear nuevo método de cobro', url('settings/charging-methods/create'));
});

/*------------- Concepts -------------*/
Breadcrumbs::for('settings/concepts', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Conceptos de recaudación', url('settings/concepts'));
});

/*------------- Concepts > create -------------*/
Breadcrumbs::for('settings/concepts/create', function ($trail) {
    $trail->parent('settings/concepts');
    $trail->push('Crear nueva concepto de recaudación', url('settings/concepts/create'));
});

/*------------- Concepts > edit -------------*/
Breadcrumbs::for('settings/concepts/edit', function ($trail) {
    $trail->parent('settings/concepts');
    $trail->push('Editar concepto de recaudación', url('settings/concepts/edit'));
});

/*------------- Fines -------------*/
Breadcrumbs::for('fines', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Multas', url('fines'));
});

/*------------- Bank Accounts -------------*/
Breadcrumbs::for('settings/bank-accounts', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Cuentas bancarias', url('settings/bank-accounts'));
});

/*------------- Bank Accounts > create -------------*/
Breadcrumbs::for('settings/bank-accounts/create', function ($trail) {
    $trail->parent('settings/bank-accounts');
    $trail->push('Crear nuevo cuenta bancaria', url('settings/bank-accounts/create'));
});

/*------------- Property Types -------------*/
Breadcrumbs::for('settings/property-types', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Tipos de inmuebles', url('settings/property-types'));
});

/*------------- Property Types > create -------------*/
Breadcrumbs::for('settings/property-types/create', function ($trail) {
    $trail->parent('settings/property-types');
    $trail->push('Crear nuevo tipo de inmueble', url('settings/property-types/create'));
});

/*------------- Property types > edit -------------*/
Breadcrumbs::for('settings/property-types/edit', function ($trail) {
    $trail->parent('settings/property-types');
    $trail->push('Editar tipo de inmueble', url('settings/property-types/edit'));
});

/*------------- Properties -------------*/
Breadcrumbs::for('properties', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Inmuebles', url('properties'));
});

/*------------- Properties > create -------------*/
Breadcrumbs::for('properties/create', function ($trail) {
    $trail->parent('taxpayers');
    $trail->push('Crear inmueble', url('taxpayer/{id}/property/create'));
});

/*------------- Commercial registers -------------*/
Breadcrumbs::for('commercial-registers', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Registros comerciales', url('commercial-registers'));
});

/*------------- Commercial registers > create -------------*/
Breadcrumbs::for('commercial-registers/create', function ($trail) {
    $trail->parent('taxpayers');
    $trail->push('Crear inmueble', url('taxpayer/{id}/commercial-registers/create'));
});

/*------------- Ordinances -------------*/
Breadcrumbs::for('settings/ordinances', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Ordenanzas', url('settings/ordinances'));
});

/*------------- Ordinances > create -------------*/
Breadcrumbs::for('settings/ordinances/create', function ($trail) {
    $trail->parent('settings/ordinances');
    $trail->push('Crear nueva ordenanza', url('settings/ordinances/create'));
});

/*------------- Ordinances > edit -------------*/
Breadcrumbs::for('settings/ordinances/edit', function ($trail) {
    $trail->parent('settings/ordinances');
    $trail->push('Editar ordenanza', url('settings/ordinances/edit'));
});

/*------------- Cashbox -------------*/
Breadcrumbs::for('payments', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Caja', url('payments'));
});

/*------------- Payments > edit -------------*/
Breadcrumbs::for('payments/edit', function ($trail) {
    $trail->parent('payments');
    $trail->push('Procesar liquidación', url('payments/edit'));
});

