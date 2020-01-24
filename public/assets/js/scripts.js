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
    $('#states').on('change', onSelectMunicipalities);
    $('#taxpayer_type').on('change', onSelectTaxpayerType);
});

function onSelectTaxpayerType() {
    let selected = $(this).children('option:selected').val();
    let commercialDenomination = $('#hide_form');

    // Show commercial denomination input
    if (selected === 1) {
        commercialDenomination.show();
        $('#rif').val('N-');
    } else {
        commercialDenomination.hide();
        $('#rif').val('J-');
    }
}

function onClickAddApplication() {
    $.get(baseURL +'/application-types/list-all', function (data) {
        let html_select;
        if (data && data.length) {
            for (let i=0; i<data.length; i++) {
                html_select += '<option value="'+data[i].id+'">'+data[i].description+'</option>'
            }
            $('#application_types').html(html_select);
        } else {
            $('#application_types').html('<option value="">===== SELECCIONE =====</option>');
        }
    });
}


/*----------  Uppercase  ----------*/
function upperCase(e) {
    e.value = e.value.toUpperCase();
}
/*---------- Delete confirm chargue --------*/
const nullRecord = id => {
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
            url: `${baseURL}/applications/${id}`,
            data: {
                '_method': 'DELETE',
                '_token': $("meta[name='csrf-token']").attr("content")
            },
            success: response => location.reload(),
            error: res => Swal.fire(res.responseJSON)
            });
        }
    });
}

const checkRecord = id => {
    Swal.fire({
        title: '¿Está seguro(a) que desea aprobar la solicitud?',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0abb87',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Aprobar'
    }).then(result => {
        if (result.value) {
            $.ajax({
            type: 'POST',
            url: `${baseURL}/applications/${id}/approve`,
            data: {
                '_method': 'POST',
                '_token': $("meta[name='csrf-token']").attr("content")
            },
            success: response => location.reload(),
            error: res => Swal.fire(res.responseJSON)
            });
        }
    });
}

$(document).ready(function() {

    $('[data-mask]').inputmask()

    /*----------  Datatables users  ----------*/
    $('#tUsers').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/administration/list-users",
        "columns": [
            {data: 'identity_card', name: 'identity_card'},
            {data: 'first_name', name: 'first_name'},
            {data: 'surname', name: 'surname'},
            {data: 'phone', name: 'phone'},
            {data: 'login', name: 'login'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='"+baseURL +"/administration/users/"+oData.id+"/edit' title='Editar' class='btn btn-sm btn-warning'><i class='flaticon-edit'></i></a>");
                }
            }
        ]
    });

    $('#tCommunities').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/communities/list",
        "columns": [
            { data: 'id' },
            {data: 'name'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='"+baseURL +"/service-stations/"+oData.id+"/edit' title='Editar registro' class='btn btn-sm btn-warning'><i class='flaticon-edit'></i></a>");
                }
            }
        ]
    });

    /*----------  Datatables Economic sectors  ----------*/
    $('#tEconomicSectors').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
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
                        <a class="mr-2" href=${baseURL}/inspection/economic-sectors/${oData.id} title='Ver información'>
                            <i class='btn-sm btn-info flaticon2-file '></i>
                        </a>
                        <a class="mr-2" href=${baseURL}/inspection/economic-sectors/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning flaticon-edit'></i>
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
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/economic-activities/list",
        "columns": [
            {data: 'id'},
            {data: 'name'},
            { data: 'aliquote'},
            { data: 'min_tax'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                        <div class="btn-group">
                            <a class="mr-2" href=${baseURL}/inspection/economic-sectors/${oData.id} title='Ver información'>
                                <i class='btn-sm btn-info flaticon2-file '></i>
                            </a>
                            <a class="mr-2" href=${baseURL}/inspection/economic-sectors/${oData.id}/edit title='Editar'>
                                <i class='btn-sm btn-warning flaticon-edit'></i>
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
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/representations/list",
        "columns": [
            { data: 'document'},
            { data: 'first_name'},
            { data: 'surname'},
            { data: 'address'},
            { data: 'phone' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/representations/${oData.id} title='Ver información'>
                            <i class='btn-sm btn-info flaticon2-file '></i>
                        </a>
                        <a class="mr-2" href=${baseURL}/representations/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning flaticon-edit'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tTaxpayers').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/taxpayers/list",
        "columns": [
            { data: 'rif'},
            { data: 'name'},
            { data: 'commercial_register.num'},
            { data: 'denomination'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/taxpayers/${oData.id} title='Ver información'>
                            <i class='btn-sm btn-info flaticon2-file '></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tApplicationTypes').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/application-types/list",
        "columns": [
            { data: 'id'},
            { data: 'description'},
            { data: 'created_at'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" href=${baseURL}/settings/application-types/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning flaticon-edit'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });

    $('#tTaxUnits').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
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

    $('#tApplications').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/applications/list",
        "columns": [
            { data: 'id'},
            { data: 'taxpayer.rif'},
            { data: 'application_type.description'},
            { data: 'application_state.description'},
            { data: 'created_at'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                    <div class="btn-group">
                        <a class="mr-2" onClick='checkRecord(${oData.id})' title='Eliminar'>
                            <i class='btn-sm btn-success flaticon2-checkmark'></i>
                        </a>
                        <a class="mr-2" onClick='nullRecord(${oData.id})' title='Eliminar'>
                            <i class='btn-sm btn-danger flaticon-delete'></i>
                        </a>
                        <a class="mr-2" href=${baseURL}/applications/${oData.id}/edit title='Editar'>
                            <i class='btn-sm btn-warning flaticon-edit'></i>
                        </a>
                    </div>`
                    );
                }
            }
        ]
    });
});
