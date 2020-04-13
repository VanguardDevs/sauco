const baseURL = window.location.origin;

/*Fuction disable button before sumit*/
$("#form").closest('form').on('submit', function(e) {
    e.preventDefault();
    $('#send').attr('disabled', true);
    $('#cancel').attr('disabled', true);
    this.submit();
});

/*--------- Select Dinamicos ---------*/
$(function () {
    $('#applications').on('change', onSelectApplications);
    $('#taxpayer_type').on('change', onSelectTaxpayerType);
    $('#ownership_status').change(onSelectBuildingOwner);
    $('#payment_methods').on('change', onSelectPaymentType);
    $('#years').on('change', onSelectYears);
});

const token = $("meta[name='csrf-token']").attr("content");

const handleRequest = url => {
    fetch(`${baseURL}/${url}`, {
        method: 'POST',
        headers: {
            "X-CSRF-TOKEN": token
        }
    }).then(response => response.json())
    .then(data => {
        if (!data.ok) {
            Swal.fire({
                title: data.message,
                type: 'error'
            })
        } else {
            Swal.fire({
                title: data.message,
                type: 'success'
            })
        }
    });
}

function onSelectTaxpayerType() {
    let selected = $(this).children('option:selected').val();
    let commercialDenomination = $('#commercial_denomination');

    // Show commercial denomination input
    if (selected !== "1") {
        commercialDenomination.show();
    } else {
        commercialDenomination.hide();
    }
}

function onSelectPaymentType() {
    let selected = $(this).children('option:selected').html();
    let reference = $('#reference');

    // Show commercial denomination input
    if (selected !== "EFECTIVO") {
        reference.show();
    } else {
        reference.hide();
    }
}

/**
 * Get all communities for a given parish
 */
function onSelectApplications() {
    let ordinance_id = $(this).val();

    let html_select = '<option value=""> SELECCIONE </option>';

    $.get('/applications/'+ordinance_id+'/concepts/', data => {

      for (let i = 0; i < data.length; i++) {
        html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>'
      }

      $('#concepts').html(html_select);
    });
}

/**
 * Get all communities for a given parish
 */
function onSelectYears() {
    let year_id = $(this).val();

    let html_select = '<option value=""> SELECCIONE </option>';

    $.get('/years/'+year_id+'/months/', data => {

      for (let i = 0; i < data.length; i++) {
        html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>'
      }

      $('#months').html(html_select);
    });
}

function onSelectBuildingOwner() {
    let selected = $(this).children('option:selected').html();
    let contract = $('#contract');
    let document = $('#document');

    // Show contract input
    if (selected == "ALQUILADO") {
        contract.show();
        document.hide();
    } else if (selected == "PROPIO") {
        contract.hide();
        document.show();
    } else {
        contract.hide();
        document.hide();
    }
}

/*----------  Uppercase  ----------*/
function upperCase(e) {
    e.value = e.value.toUpperCase();
}

/*---------- Delete confirm chargue --------*/
const nullRecord = (id, url) => {
    Swal.fire({
        title: '¿Está seguro(a) que desea anular el registro?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Anular'
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: `${baseURL}/${url}/${id}`,
                data: {
                    '_method': 'DELETE',
                    '_token': $("meta[name='csrf-token']").attr("content")
                },
                success: response => location.reload(),
                error: res => Swal.fire({
                    title: 'Esta acción no puede ser procesada.',
                    type: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                })
            });
        }
    });
}

$(document).ready(function() {

    $('[data-mask]').inputmask()

    /*----------  Datatables users  ----------*/
    $('#tUsers').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/users/list",
        "columns": [
            {data: 'identity_card', name: 'identity_card'},
            {data: 'first_name', name: 'first_name'},
            {data: 'surname', name: 'surname'},
            {data: 'phone', name: 'phone'},
            {data: 'login', name: 'login'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                    `<div class="btn-group">
                        <a class="mr-2" href=${baseURL}/administration/users/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning fas fa-edit'></i>
                        </a>
                        <a class="mr-2" onClick="nullRecord(${oData.id},'administration/users')" title='Editar'>
                            <i class='btn-sm btn-danger fas fa-trash-alt'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tPermissions').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/permissions/list",
        "columns": [
            {data: 'name'},
            {data: 'slug' },
            {data: 'description'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(
                    `<div class="btn-group">
                        <a class="mr-2" href=${baseURL}/administration/permissions/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning fas fa-edit'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tRoles').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/roles/list",
        "columns": [
            { data: 'name'},
            { data: 'slug'},
            { data: 'description'},
            { data: 'special'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/administration/roles/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning fas fa-edit'></i>
                        </a>
                    </div>`);
                }
            }
        ]
    });

    $('#tPaymentMethods').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/payment-methods/list",
        "columns": [
            { data: 'id' },
            {data: 'name'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/settings/payment-methods/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning fas fa-edit'></i>
                        </a>
                    </div>`);
                }
            }
        ]
    });

    $('#tCommunities').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/communities/list",
        "columns": [
            { data: 'parish_names', name: 'parish_names' },
            { data: 'name' },
            { data: 'num_taxpayers', name: 'num_taxpayers' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/geographic-area/communities/${oData.id} title='Ver información'>
                            <i class='btn-sm btn-info fas fa-eye '></i>
                        </a>
                        <a class="mr-2" href=${baseURL}/geographic-area/communities/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning fas fa-edit'></i>
                        </a>
                    </div>`);
                }
            }
        ]
    });

    $('#tParishes').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/parishes/list",
        "columns": [
            { data: 'id' },
            {data: 'name'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/geographic-area/parishes/${oData.id} title='Ver información'>
                            <i class='btn-sm btn-info fas fa-eye '></i>
                        </a>
                    </div>`);
                }
            }
        ]
    });

    /*----------  Datatables Economic sectors  ----------*/
    $('#tEconomicSectors').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/economic-sectors/list",
        "columns": [
            {data: 'id'},
            {data: 'description'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/settings/economic-sectors/${oData.id} title='Ver información'>
                            <i class='btn-sm btn-info fas fa-eye '></i>
                        </a>
                        <a class="mr-2" href=${baseURL}/settings/economic-sectors/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning fas fa-edit'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    /*----------  Datatables Economic Activities  ----------*/
    $('#tEconomicActivities').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/economic-activities/list",
        "columns": [
            { data: 'code'},
            { data: 'name'},
            { data: 'aliquote'},
            { data: 'min_tax'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                        <div class="btn-group">
                            <a class="mr-2" href=${baseURL}/economic-activities/${oData.id} title='Ver información'>
                                <i class='btn-sm btn-info fas fa-eye'></i>
                            </a>
                            <a class="mr-2" href=${baseURL}/economic-activities/${oData.id}/edit title='Editar'>
                                <i class='btn-sm btn-warning fas fa-edit'></i>
                            </a>
                            <a class="mr-2" onClick="nullRecord(${oData.id},'economic-activities')" title='Eliminar'>
                                <i class='btn-sm btn-danger fas fa-trash-alt'></i>
                            </a>
                        </div>`
                    );
                }
            }
        ]
    });

    /*----------  Datatables Representations  ----------*/
    $('#tRepresentations').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/representations/list",
        "columns": [
            { data: 'document'},
            { data: 'name'},
            { data: 'address'},
            { data: 'phone' },
        ]
    });

    $('#tTaxpayers').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/taxpayers/list",
        "columns": [
            { data: 'rif'},
            { data: 'name'},
            { data: 'fiscal_address'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/taxpayers/${oData.id} title='Ver información'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tOrdinances').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/ordinances/list",
        "columns": [
            { data: 'id'},
            { data: 'description'},
            { data: 'created_at'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/settings/ordinances/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning fas fa-edit'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });
    
    $('#tTaxpayersByEconomicActivity').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": `${window.location.href}/taxpayers/list`,
        "columns": [
            { data: 'rif'},
            { data: 'name'},
            { data: 'community.name'},
            { data: 'fiscal_address'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/taxpayers/${oData.id} title='Ver información'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tTaxpayersByCommunity').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": `${window.location.href}/taxpayers/list`,
        "columns": [
            { data: 'rif'},
            { data: 'name'},
            { data: 'fiscal_address'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/taxpayers/${oData.id} title='Ver información'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tConcepts').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/concepts/list",
        "columns": [
            { data: 'name'},
            { data: 'ordinance.description'},
            { data: 'charging_method.name'},
            { data: 'amount'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/settings/concepts/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning fas fa-edit'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tTaxUnits').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/tax-units/list",
        "columns": [
            { data: 'id'},
            { data: 'law'},
            { data: 'value'},
            { data: 'publication_date'}
        ]
    });

    $('#tReceivables').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/receivables/list",
        "columns": [
            { data: 'id' },
            { data: 'taxpayer.rif' },
            { data: 'taxpayer.name' },
            { data: 'amount' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/cashbox/payments/${oData.id} title='Ver factura'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
                        </a>
                        <a class="mr-2" onClick="nullRecord(${oData.id},'cashbox/payments')" title='Editar'>
                            <i class='btn-sm btn-danger fas fa-trash-alt'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tTaxpayerPayments').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": `${window.location.href}/payments`,
        "columns": [
            { data: 'num' },
            { data: 'state.name' },
            { data: 'user.full_name' },
            { data: 'created_at' },
            { data: 'total_amount' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${window.location.origin}/payments/${oData.id} title='Ver factura'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
                        </a>
                        <a class="mr-2" onClick="nullRecord(${oData.id},'cashbox/payments')" title='Editar'>
                            <i class='btn-sm btn-danger fas fa-trash-alt'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tProcessedPayments').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/payments/processed/list",
        "columns": [
            { data: 'num', name: 'num' },
            { data: 'taxpayer.rif', name: 'taxpayer.rif' },
            { data: 'taxpayer.name', name: 'taxpayer.name' },
            { data: 'amount', name: 'amount' },
            { data: 'processed_at', name: 'processed_at' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/cashbox/payments/${oData.id} title='Ver factura'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
                        </a>
                        <a class="mr-2" onClick="nullRecord(${oData.id},'cashbox/payments')" title='Editar'>
                            <i class='btn-sm btn-danger fas fa-trash-alt'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tNullPayments').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/payments/list-null",
        "columns": [
            { data: 'id'},
            { data: 'taxpayer.rif' },
            { data: 'taxpayer.name' },
            { data: 'amount' },
            { data: 'state.name' },
            { data: 'deleted_at' }
        ]
    });
    
    $('#tNullSettlements').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/settlements/list-null",
        "columns": [
            { data: 'id'},
            { data: 'taxpayer.rif' },
            { data: 'concept.name'},
            { data: 'amount' },
            { data: 'deleted_at'}
        ]
    });

    $('#tSettlements').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/settlements/list",
        "columns": [
            { data: 'id'},
            { data: 'taxpayer.rif' },
            { data: 'object_payment'},
            { data: 'amount' },
            { data: 'created_at'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" onClick="nullRecord(${oData.id},'cashbox/settlements')" title='Anular'>
                            <i class='btn-sm btn-danger fas fa-trash-alt'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tProcessedSettlements').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/settlements/processed/list",
        "columns": [
            { data: 'num'},
            { data: 'taxpayer.rif' },
            { data: 'object_payment'},
            { data: 'user.login' },
            { data: 'total_amount', name: 'total_amount' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" onClick="nullRecord(${oData.id},'cashbox/settlements')" title='Anular'>
                            <i class='btn-sm btn-danger fas fa-trash-alt'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });
    
    $('#tApplications').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": `${window.location.href}/list`,
        "columns": [
            { data: 'concept.name' },
            { data: 'created_at' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${window.location.href}/${oData.id}/download title='Descargar declaración jurada de ingresos'>
                            <i class='btn-sm btn-dark bg-dark fas fa-file-download'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tAffidavits').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": `${window.location.href}/list`,
        "columns": [
            { data: 'month.year.year' },
            { data: 'month.name' },
            { data: 'brute_amount_affidavit', name: 'brute_amount_affidavit' },
            { data: 'total_amount', name: 'total_amount' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${window.location.href}/${oData.id}/download title='Descargar declaración jurada de ingresos'>
                            <i class='btn-sm btn-dark bg-dark fas fa-file-download'></i>
                        </a>
                        <a class="mr-2" href=${baseURL}/affidavits/${oData.id} title='Ver declaración jurada de ingresos'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
                        </a>
                        <a class="mr-2" href=${window.location.href}/cashbox/settlements/${oData.id} title='Facturar liquidación'>
                            <i class='btn-sm btn-success fas fa-money-check'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tEconomicActivityLicenses').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": `${window.location.href}/list`,
        "columns": [
            { data: 'num' },
            { data: 'taxpayer.rif' },
            { data: 'taxpayer.name' },
            { data: 'emission_date' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/economic-activity-licenses/${oData.id}/download title='Imprimir licencia'>
                            <i class='btn-sm btn-success fas fa-print'></i>
                        </a>
                        <a class="mr-2" href=${baseURL}/taxpayers/${oData.taxpayer.id} title='Ver contribuyente'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tEconomicActivityLicensesTaxpayer').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": `${window.location.href}/list`,
        "columns": [
            { data: 'emission_date' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/economic-activity-licenses/${oData.id}/download title='Imprimir licencia'>
                            <i class='btn-sm btn-success fas fa-print'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tAccounts').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/accounts/list",
        "columns": [
            { data: 'account_num' },
            { data: 'account_type.denomination'},
            { data: 'name'},
            { data: 'description'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/settings/accounts/${oData.id}/edit title='Ver liquidación'>
                            <i class='btn-sm btn-warning flaticon2-pencil'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });
});
