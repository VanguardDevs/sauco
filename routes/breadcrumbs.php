<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('change-password.show', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Cambiar contraseña', route('change-password.show'));
});

/*----------  Cashbox ----------*/
Breadcrumbs::for('receivables.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Cuentas por cobrar', route('receivables.index'));
});

/*----------  Reports ----------*/
Breadcrumbs::for('taxpayer.declarations', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Declaraciones', url('taxpayers/'.$row->id.'/declarations'));
});

Breadcrumbs::for('taxpayer.old-payments', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Pagos antiguos', url('taxpayers/'.$row->id.'/old-payments'));
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

/*----------  Reports ----------*/
Breadcrumbs::for('taxpayers.uptodate', function ($trail) {
    $trail->parent('reports');
    $trail->push('Contribuyentes al día', route('taxpayers.uptodate'));
});

/**
 * Taxpayer > taxpayer > Affidavits
 */
Breadcrumbs::for('affidavits.index', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Declaraciones', route('affidavits.index', $row));
});

/*----------  Taxpayers > taxpayer > Affidavits > show ----------*/
Breadcrumbs::for('affidavits.show', function ($trail, $row) {
    $trail->parent('affidavits.index', $row->taxpayer);
    $trail->push('Nueva declaración', route('affidavits.show', $row));
});

/**
 * Taxpayers > taxpayer > Affidavits > show > group
 */
Breadcrumbs::for('affidavits.group', function ($trail, $row) {
    $trail->parent('affidavits.show', $row);
    $trail->push('Cálculo de liquidación agrupada', url('affidavits/'.$row->id.'/group'));
});

Breadcrumbs::for('null.payments', function ($trail) {
    $trail->parent('reports');
    $trail->push('Pagos anulados', route('null.payments'));
});

/*----------  Taxpayers > taxpayer > payment ----------*/
Breadcrumbs::for('payments.show', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row->taxpayer);
    $trail->push('Pago '.$row->num, route('payments.show', $row));
});

/*----------  Receivables > receivable ----------*/
Breadcrumbs::for('receivables.show', function ($trail, $row) {
    $trail->parent('receivables.index');
    $trail->push('Pago '.$row->num, route('receivables.show', $row));
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
    $trail->parent('settings');
    $trail->push('Permisos', route('permissions.index'));
});

/*------------- Users > Create -------------*/
Breadcrumbs::for('permissions.create', function ($trail) {
    $trail->parent('permissions.index');
    $trail->push('Crear permiso', route('permissions.create'));
});

/*------------- Users > edit -------------*/
Breadcrumbs::for('permissions.edit', function ($trail, $row) {
    $trail->parent('permissions.index');
    $trail->push('Editar permiso'/*.$row->login*/, route('permissions.edit', $row));
});

/*------------- Users -------------*/
Breadcrumbs::for('users.index', function ($trail) {
    $trail->parent('settings');
    $trail->push('Usuarios', route('users.index'));
});

/*------------- Users > Create -------------*/
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users.index');
    $trail->push('Crear usuario', route('users.create'));
});

/*------------- Users > edit -------------*/
Breadcrumbs::for('users.edit', function ($trail, $row) {
    $trail->parent('users.index');
    $trail->push('Editar Usuario ', route('users.edit',  $row));
});

/*------------- Roles -------------*/
Breadcrumbs::for('roles.index', function ($trail) {
    $trail->parent('settings');
    $trail->push('Roles', route('roles.index'));
});

/*------------- Roles > Create -------------*/
Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles.index');
    $trail->push('Crear rol', route('roles.create'));
});

/*------------- Roles > edit -------------*/
Breadcrumbs::for('roles.edit', function ($trail, $row) {
    $trail->parent('roles.index');
    $trail->push('Editar rol '/*.$row->login*/, route('roles.edit', $row));
});

/*------------- Parishes -------------*/
Breadcrumbs::for('parishes.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Parroquias', url('geographic-area/parishes'));
});

/*------------- Communities -------------*/
Breadcrumbs::for('communities.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Area geográfica', route('communities.index'));
});

/*------------- Communities > create -------------*/
Breadcrumbs::for('communities.show', function ($trail, $row) {
    $trail->parent('communities.index');
    $trail->push($row->name, route('communities.show', $row->id));
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
Breadcrumbs::for('taxpayers.edit', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Editar contribuyente', route('taxpayers.edit', $row));
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
Breadcrumbs::for('taxpayer.economic-activities', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Editar actividades económicas', route('taxpayer.economic-activities', $row));
});

/*------------- Representations -------------*/
Breadcrumbs::for('representations.index', function ($trail) {
    $trail->parent('taxpayers.index');
    $trail->push('Representantes', url('representations'));
});

/*------------- Representations -------------*/
Breadcrumbs::for('economic-activity-licenses.index', function ($trail) {
    $trail->parent('taxpayers.index');
    $trail->push('Patentes de actividad económica', url('economic-activity-licenses'));
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

Breadcrumbs::for('people.edit', function ($trail, $row) {
    $trail->parent('representations.index', $row);
    $trail->push('Editar persona', route('people.edit', $row));
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
Breadcrumbs::for('withholdings.index', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Retenciones', route('withholdings.index', $row));
});

/*------------- Applications -------------*/
Breadcrumbs::for('applications.index', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Solicitudes', route('applications.index', $row));
});

/*------------- Fines -------------*/
Breadcrumbs::for('taxpayer.fines', function ($trail, $row) {
    $trail->parent('taxpayers.show', $row);
    $trail->push('Multas y sanciones', route('taxpayer.fines', $row));
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
Breadcrumbs::for('categories.index', function ($trail) {
    $trail->parent('settings');
    $trail->push('Categorías', route('categories.index'));
});

/*------------- Concepts > create -------------*/
Breadcrumbs::for('categories.create', function ($trail) {
    $trail->parent('categories.index');
    $trail->push('Nueva categoría', url('categories.create'));
});

/*------------- Concepts > edit -------------*/
Breadcrumbs::for('categories.edit', function ($trail, $row) {
    $trail->parent('concepts.index');
    $trail->push('Editar categoría', route('categories.edit',$row));
});

/*------------- Concepts -------------*/
Breadcrumbs::for('invoice-models.index', function ($trail) {
    $trail->parent('settings');
    $trail->push('Modelos de factura', route('invoice-models.index'));
});

/*------------- Concepts -------------*/
Breadcrumbs::for('concepts.index', function ($trail) {
    $trail->parent('settings');
    $trail->push('Conceptos de recaudación', url('settings/concepts'));
});

/*------------- Concepts > create -------------*/
Breadcrumbs::for('concepts.create', function ($trail) {
    $trail->parent('concepts.index');
    $trail->push('Nuevo concepto de recaudación', url('settings/concepts/create'));
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

/*------------- Ordinances -------------*/
Breadcrumbs::for('accounting-accounts.index', function ($trail) {
    $trail->parent('settings');
    $trail->push('Cuentas contables', url('settings/accounting-accounts'));
});

/*------------- Ordinances > create -------------*/
Breadcrumbs::for('accounting-accounts.create', function ($trail) {
    $trail->parent('accounting-accounts.index');
    $trail->push('Crear cuenta contable', url('settings/accounting-accounts/create'));
});

/*------------- Ordinances > edit -------------*/
Breadcrumbs::for('accounting-accounts.edit', function ($trail, $row) {
    $trail->parent('accounting-accounts.index');
    $trail->push('Editar cuenta contable', url('settings/accounting-accounts/edit'.$row->id));
});
