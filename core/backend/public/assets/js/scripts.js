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
    $('#fines').on('change', onSelectFines);
    $('#ownership_status').change(onSelectBuildingOwner);
    $('#payment_methods').on('change', onSelectPaymentType);
    $('#years').on('change', onSelectYears);
});

const token = $("meta[name='csrf-token']").attr("content");
const apiURL = $("meta[name='api-base-url']").attr("content");

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

function onSelectFines() {
  let ordinance_id = $(this).val();

  let html_select = '<option value=""> SELECCIONE </option>';

  $.get('/fines/'+ordinance_id+'/concepts/', data => {

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

/*----------  Uppercase  ----------*/
function upperCase(e) {
  e.value = e.value.toUpperCase();
}

/*---------- Delete confirm chargue --------*/
const nullRecord = (id, url) => {
    Swal.fire({
      title: '¿Está seguro(a) que desea anular el registro?',
      type: 'warning',
      html: '<input id="annullmentReason" placeholder="Razón de anulación" class="form-control">',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Anular',
      showLoaderOnConfirm: true,
      preConfirm: (response) => {
        return new Promise((resolve, reject) => {
          resolve({
            answer: $('#annullmentReason').val()
          });
        });
      }
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: `${baseURL}/${url}/${id}`,
                data: {
                  '_method': 'DELETE',
                  '_token': $("meta[name='csrf-token']").attr("content"),
                  'annullment_reason': $('#annullmentReason').val()
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
                        <a class="mr-2" href=${baseURL}/settings/administration/users/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning fas fa-edit'></i>
                        </a>
                        <a class="mr-2" onClick="nullRecord(${oData.id},'settings/administration/users')" title='Anular'>
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
                        <a class="mr-2" href=${baseURL}/settings/administration/permissions/${oData.id}/edit title='Anular'>
                            <i class='btn-sm btn-warning fas fa-edit'></i>
                        </a>
                        <a class="mr-2" onClick="nullRecord(${oData.id},'settings/administration/permissions')" title='Anular'>
                            <i class='btn-sm btn-danger fas fa-trash-alt'></i>
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
                        <a class="mr-2" href=${baseURL}/settings/administration/roles/${oData.id}/edit title='Editar'>
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
        "order": [[2, "desc"]],
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

    /*----------  Datatables Economic Activities  ----------*/
    $('#tEconomicActivities').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/economic-activities",
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
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/people/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning fas fa-edit'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tUpToDateTaxpayers').DataTable({
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/reports/taxpayers/up-to-date/list",
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

    $('#tTaxpayers').DataTable({
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/taxpayers",
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

    $('#tCategories').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/categories/list",
        "columns": [
            { data: 'name'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/settings/categories/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning fas fa-edit'></i>
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
        "ajax": baseURL + "/tax-units",
        "columns": [
            { data: 'id'},
            { data: 'law'},
            { data: 'value'},
            { data: 'publication_date'}
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
            { data: 'formatted_amount', name: 'formatted_amount' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${window.location.origin}/payments/${oData.id} title='Ver factura'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
                        </a>
                        <a class="mr-2" onClick="nullRecord(${oData.id},'payments')" title='Editar'>
                            <i class='btn-sm btn-danger fas fa-trash-alt'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tCancelledPayments').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        processing: true,
        serverSide: true,
        "ajax": baseURL + "/reports/cancelled-payments",
        "columns": [
            { data: 'reason' },
            { data: 'payment.taxpayer.name', name: 'payment.taxpayer.name'},
            { data: 'user.login', name: 'user.login'},
            { data: 'created_at', name: 'created_at' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/reports/cancelled-payments/${oData.id} title='Ver factura'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tCancelledFines').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/reports/cancelled-fines",
        "columns": [
            { data: 'reason' },
            { data: 'created_at' },
            { data: 'fine.formatted_amount', name: 'formatted_amount' },
            { data: 'user.login' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/reports/cancelled-fines/${oData.id} title='Ver factura'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
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
            { data: 'formatted_amount', name: 'formatted_amount' },
            { data: 'processed_at', name: 'processed_at' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/payments/${oData.id} title='Ver factura'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
                        </a>
                        <a class="mr-2" onClick="nullRecord(${oData.id},'payments')" title='Anular'>
                            <i class='btn-sm btn-danger fas fa-trash-alt'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tFines').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": `${window.location.href}/list`,
        "columns": [
            { data: 'formatted_amount', name: 'formatted_amount' },
            { data: 'concept.name', name: 'concept.name' },
            { data: 'created_at', name: 'created_at' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/fines/${oData.id}/payment/new title='Facturar'>
                            <i class='btn-sm btn-success fas fa-money-check'></i>
                        </a>
                        <a class="mr-2" onClick="nullRecord(${oData.id},'fines')" title='Anular'>
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
            { data: 'amount', name: 'amount' },
            { data: 'concept.name' },
            { data: 'created_at' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                      <a class="mr-2" href=${baseURL}/applications/${oData.id}/payment/new title='Facturar'>
                        <i class='btn-sm btn-success fas fa-money-check'></i>
                      </a>
                      <a class="mr-2" onClick="nullRecord(${oData.id},'taxpayers/${oData.taxpayer_id}/applications')" title='Anular'>
                        <i class='btn-sm btn-danger fas fa-trash-alt'></i>
                      </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tWithholdings').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": `${window.location.href}/list`,
        "columns": [
            { data: 'affidavit.month.name' },
            { data: 'amount' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                      <a class="mr-2" onClick="nullRecord(${oData.id},'withholdings')" title='Anular'>
                        <i class='btn-sm btn-danger fas fa-trash-alt'></i>
                      </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tTaxpayerAffidavits').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": `${window.location.href}`,
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
                        <a class="mr-2" href=${baseURL}/affidavits/${oData.id}/payment/new title='Facturar'>
                            <i class='btn-sm btn-success fas fa-money-check'></i>
                        </a>
                        <a class="mr-2" href=${baseURL}/affidavits/${oData.id} title='Ver declaración jurada de ingresos'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
                        </a>
                        <a class="mr-2" onClick="nullRecord(${oData.id},'affidavits')" title='Anular'>
                            <i class='btn-sm btn-danger fas fa-trash-alt'></i>
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
        "ajax": `${window.location.href}`,
        "columns": [
            { data: 'id', name: 'id' },
            { data: 'month.year.year', name: 'month.year.year' },
            { data: 'month.name', name: 'month.name' },
            { data: 'taxpayer.name', name: 'taxpayer.name' },
            { data: 'processed_at', name: 'processed_at' },
            { data: 'user.login', name: 'user.login' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/affidavits/${oData.id}/payment/new title='Facturar'>
                            <i class='btn-sm btn-success fas fa-money-check'></i>
                        </a>
                        <a class="mr-2" href=${baseURL}/affidavits/${oData.id} title='Ver declaración jurada de ingresos'>
                            <i class='btn-sm btn-info fas fa-eye'></i>
                        </a>
                        <a class="mr-2" onClick="nullRecord(${oData.id},'affidavits')" title='Anular'>
                            <i class='btn-sm btn-danger fas fa-trash-alt'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tLicenses').DataTable({
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": `${window.location.href}`,
        "columns": [
            { data: 'num' },
            { data: 'taxpayer.rif' },
            { data: 'taxpayer.name' },
            { data: 'ordinance.description' },
            { data: 'emission_date' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/licenses/${oData.id} title='Ver licencia'>
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
        "ajax": `${window.location.href}`,
        "columns": [
            { data: 'num' },
            { data: 'emission_date' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/licenses/${oData.id}/download title='Imprimir licencia'>
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