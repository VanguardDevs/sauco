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
});
function onSelectMunicipalities() {
    var state_id = $(this).val();

    if (! state_id)
        $('#municipalities').html('<option value="">===== SELECCIONE =====</option>');

    $.get(baseURL +'/states/'+state_id+'/municipalities', function (data) {
        var html_select;
        if (data && data.length) {
            for (var i=0; i<data.length; i++)
                html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>'
            $('#municipalities').html(html_select);
        } else {
            $('#municipalities').html('<option value="">===== SELECCIONE =====</option>');
        }
    });
}


/*----------  Uppercase  ----------*/
function upperCase(e) {
    e.value = e.value.toUpperCase();
}
/*---------- Delete confirm chargue --------*/
function deleteChargue(id) {
    Swal.fire({
        title: 'Seguro(a) que desea eliminar el registro?',
        //text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Eliminar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: baseURL + '/structure/chargues/' + id,
                data: {
                    '_method': 'DELETE',
                    '_token': $("meta[name='csrf-token']").attr("content")
                },
                success: function (response) {
                    location.reload();
                }
            })
        }
    })
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
    /*----------  Datatables persons  ----------*/
    $('#tPersons').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/list-persons",
        "columns": [
            {data: 'identity_card', name: 'identity_card'},
            {data: 'first_name', name: 'first_name'},
            {data: 'surname', name: 'surname'},
            {data: 'address', name: 'address'},
            {data: 'municipality.name', name: 'municipality.name'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='"+baseURL +"/persons/"+oData.id+"/edit' title='Editar' class='btn btn-sm btn-warning'><i class='flaticon-edit'></i></a>");
                }
            },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='"+baseURL +"/persons/vehicles/"+oData.id+"' title='Vehículos asociados' class='btn btn-sm btn-info'><i class='flaticon-truck'></i></a>");
                }
            }
        ]
    });
    //*----------  Datatables services station  ----------*/
    $('#tParishes').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/parishes/list",
        "columns": [
            {data: 'id'},
            {data: 'name'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='"+baseURL +"/service-stations/"+oData.id+"/edit' title='Editar registro' class='btn btn-sm btn-warning'><i class='flaticon-edit'></i></a>");
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
                    $(nTd).html("<a href='"+baseURL +"/vehicles/type-vehicles/"+oData.id+"/edit' title='Editar' class='btn btn-sm btn-warning'><i class='flaticon-edit'></i></a>");
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
                    $(nTd).html("<a href='"+baseURL +"/vehicles/type-vehicles/"+oData.id+"/edit' title='Editar' class='btn btn-sm btn-warning'><i class='flaticon-edit'></i></a>");
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
                    $(nTd).html("<a href='"+baseURL +"/vehicles/type-vehicles/"+oData.id+"/edit' title='Editar' class='btn btn-sm btn-warning'><i class='flaticon-edit'></i></a>");
                }
            }
        ]
    });
});
