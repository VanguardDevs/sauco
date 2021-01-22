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
            { data: 'address'},
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
});
