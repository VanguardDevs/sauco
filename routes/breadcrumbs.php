<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

/*----------  Cashbox ----------*/
Breadcrumbs::for('cashbox', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Caja', route('cashbox'));
});

/*----------  Reports ----------*/
Breadcrumbs::for('taxpayer.declarations', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Declaraciones', url('taxpayers/'.$row->id.'/declarations'));
});

/*----------  Reports ----------*/
Breadcrumbs::for('taxpayer.economic-activity-licenses', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Licencias de actividad económica', url('taxpayers/'.$row->id.'/economic-activity-licenses'));
});

/*----------  Reports ----------*/
Breadcrumbs::for('reports', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Reportes', url('reports'));
});

/*----------  Reports ----------*/
Breadcrumbs::for('report.payments', function ($trail) {
    $trail->parent('reports');
    $trail->push('Pagos procesados', url('reports/payments'));
});

Breadcrumbs::for('report.settlements', function ($trail) {
    $trail->parent('reports');
    $trail->push('Liquidaciones procesadas', url('reports/settlements'));
});

/*---------- Settlements ----------*/
Breadcrumbs::for('settlements.show', function ($trail, $row) {
    $trail->parent('dashboard');
    $trail->push('Liquidación n° '.$row->id, url('cashbox/settlements'));
});

/*---------- Settlements ----------*/
Breadcrumbs::for('settlements.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Liquidaciones pendientes', url('cashbox/settlements'));
});

/**
 * Taxpayer > taxpayer > Affidavits
 */
Breadcrumbs::for('affidavits.index', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Liquidaciones', url('taxpayers/'.$row->id.'/affidavits'));
});

/*----------  Taxpayers > taxpayer > Affidavits > show ----------*/
Breadcrumbs::for('affidavits.show', function ($trail, $row) {
    $trail->parent('affidavits.index', $row->taxpayer);
    $trail->push('Liquidación n°'.$row->id, url('affidavits/'.$row->id));
});

/**
 * Taxpayers > taxpayer > Affidavits > show > group
 */
Breadcrumbs::for('affidavits.group', function ($trail, $row) {
    $trail->parent('affidavits.show', $row);
    $trail->push('Cálculo de liquidación agrupada', url('affidavits/'.$row->id.'/group'));
});

/*----------  Cashbox > Payments ----------*/
Breadcrumbs::for('payments.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Pagos pendientes', url('cashbox/payments'));
});

Breadcrumbs::for('null.payments', function ($trail) {
    $trail->parent('reports');
    $trail->push('Pagos anulados', route('null.payments'));
});

Breadcrumbs::for('null.settlements', function ($trail) {
    $trail->parent('reports');
    $trail->push('Liquidaciones anuladas', route('null.settlements'));
});

/*----------  Cashbox > Payments > show ----------*/
Breadcrumbs::for('payments.show', function ($trail, $row) {
    $trail->parent('payments.index');
    $trail->push('Factura n°'.$row->id, url('cashbox/payments/'.$row->id));
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
Breadcrumbs::for('settings', function ($trail) {
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

Breadcrumbs::for('economic-activities.show', function ($trail, $row) {
    $trail->parent('economic-activities.index');
    $trail->push('Actividad '.$row->code, route('economic-activities.show', $row));
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

/**
 * Settings > accounts 
 */
Breadcrumbs::for('accounts.index', function ($trail) {
    $trail->parent('settings');
    $trail->push('Cuentas', url('settings/accounts'));
});

/*------------- Accounts > create -------------*/
Breadcrumbs::for('accounts.create', function ($trail) {
    $trail->parent('accounts.index');
    $trail->push('Crear cuenta', url('settings/accounts/create'));
});

/*------------- Accounts > update -------------*/
Breadcrumbs::for('accounts.edit', function ($trail, $row) {
    $trail->parent('accounts.index');
    $trail->push('Editar cuenta', url('settings/accounts/'.$row->id.'/edit'));
});

/**
 * Settings > years 
 */
Breadcrumbs::for('years.index', function ($trail) {
    $trail->parent('settings');
    $trail->push('Años fiscales', url('settings/accounts'));
});

/**
 * Settings > years 
 */
Breadcrumbs::for('years.create', function ($trail) {
    $trail->parent('years.index');
    $trail->push('Nuevo año fiscal', route('years.index'));
});

/**
 * Settings > reductions
 */
Breadcrumbs::for('reductions.index', function ($trail) {
    $trail->parent('settings');
    $trail->push('Descuentos', url('settings/reductions'));
});

/*------------- Sectores económicos > create -------------*/
Breadcrumbs::for('reductions.create', function ($trail) {
    $trail->parent('reductions.index');
    $trail->push('Crear descuento', url('settings/reductions/create'));
});

/*------------- Sectores económicos > update -------------*/
Breadcrumbs::for('reductions.edit', function ($trail, $row) {
    $trail->parent('reductions.index');
    $trail->push('Editar descuento', url('settings/economic-sectors/'.$row->id.'/edit'));
});

/*------------- Sectores económicos -------------*/
Breadcrumbs::for('economic-sectors.index', function ($trail) {
    $trail->parent('settings');
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
    $trail->push($row->rif, url('taxpayers', $row->id));
});

/**
 * Economic activities > add to taxpayer
 */
Breadcrumbs::for('edit.activities', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Editar actividades económicas', url('taxpayers'.$row->id.'economic-activities/edit'));
});

Breadcrumbs::for('add.activities', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Añadir actividades económicas', url('taxpayers'.$row->id.'economic-activities/add'));
});

/**
 * Representations > add
 */
Breadcrumbs::for('representations.add', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Añadir representante', url('taxpayers'.$row->id.'representation/add'));
});

/**
 * Representations > store person
 */
Breadcrumbs::for('representation.store', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Añadir representante', url('taxpayers'.$row->id.'representation/add'));
});

/*------------- Tax units -------------*/
Breadcrumbs::for('tax-units.index', function ($trail) {
    $trail->parent('settings');
    $trail->push('Unidades Tributarias', url('settings/tax-units'));
});

/*------------- Tax units > create -------------*/
Breadcrumbs::for('tax-units.create', function ($trail) {
    $trail->parent('tax-units.index');
    $trail->push('Crear unidad tributaria', url('settings/tax-units/create'));
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
Breadcrumbs::for('concepts.index', function ($trail) {
    $trail->parent('settings');
    $trail->push('Conceptos de recaudación', url('settings/concepts'));
});

/*------------- Concepts > create -------------*/
Breadcrumbs::for('concepts.create', function ($trail) {
    $trail->parent('concepts.index');
    $trail->push('Crear nueva concepto de recaudación', url('settings/concepts/create'));
});

/*------------- Concepts > edit -------------*/
Breadcrumbs::for('concepts.edit', function ($trail, $row) {
    $trail->parent('concepts.index');
    $trail->push('Editar concepto de recaudación', url('settings/concepts/'.$row->id.'/edit'));
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

/*------------- Payment Methods -------------*/
Breadcrumbs::for('payment-methods.index', function ($trail) {
    $trail->parent('settings');
    $trail->push('payment-methods', url('settings/payment-methods'));
});

/*------------- Ordinances > create -------------*/
Breadcrumbs::for('payment-methods.create', function ($trail) {
    $trail->parent('payment-methods.index');
    $trail->push('Crear nuevo método de pago', url('settings/payment-methods/create'));
});

/*------------- Ordinances > edit -------------*/
Breadcrumbs::for('payment-methods.edit', function ($trail, $row) {
    $trail->parent('payment-methods.index');
    $trail->push('Editar método de pago', url('settings/payment-methods/edit'.$row->id));
});

/*------------- Ordinances -------------*/
Breadcrumbs::for('ordinances.index', function ($trail) {
    $trail->parent('settings');
    $trail->push('Ordenanzas', url('settings/ordinances'));
});

/*------------- Ordinances > create -------------*/
Breadcrumbs::for('ordinances.create', function ($trail) {
    $trail->parent('ordinances.index');
    $trail->push('Crear nueva ordenanza', url('settings/ordinances/create'));
});

/*------------- Ordinances > edit -------------*/
Breadcrumbs::for('ordinances.edit', function ($trail, $row) {
    $trail->parent('ordinances.index');
    $trail->push('Editar ordenanza', url('settings/ordinances/edit'.$row->id));
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

