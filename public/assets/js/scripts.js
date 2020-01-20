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

    /*----------  Datatables type vehicles  ----------*/
    $('#tTypeVehicles').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/vehicles/list",
        "columns": [
            {data: 'type', name: 'type'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='"+baseURL +"/vehicles/type-vehicles/"+oData.id+"/edit' title='Editar' class='btn btn-sm btn-warning'><i class='flaticon-edit'></i></a>");
                }
            }
        ]
    });

    /*----------  Datatables vehicles  ----------*/
    $('#tVehicles').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/list-vehicles",
        "columns": [
            {data: 'person.identity_card', name: 'person.identity_card'},
            {data: 'person.first_name', name: 'person.first_name'},
            {data: 'person.surname', name: 'person.surname'},
            {data: 'license_plate', name: 'license_plate'},
            {data: 'fuel_type.description', name: 'fuel_type.description'},
            {data: 'fuel_capacity', name: 'fuel_capacity'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='"+baseURL +"/vehicles/vehicles/"+oData.id+"/edit' title='Editar' class='btn btn-sm btn-warning'><i class='flaticon-edit'></i></a>");
                }
            }
        ]
    });

    /*----------  Datatables configurations  ----------*/
    $('#tConfigurations').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/list-configurations",
        "columns": [
            {data: 'sector.description', name: 'sector.description'},
            {data: 'type_vehicle.type', name: 'type_vehicle.type'},
            {data: 'amount_fuel', name: 'amount_fuel'},
            {data: 'refueling_time', name: 'refueling_time'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='"+baseURL +"/configurations/"+oData.id+"/edit' title='Editar' class='btn btn-sm btn-warning'><i class='flaticon-edit'></i></a>");
                }
            }
        ]
    });

    /*----------  Datatables novelties  ----------*/
    $('#tNovelties').DataTable({
        "order": [[0, "asc"]],
        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl": baseURL + "/assets/js/spanish.json"
        },
        "serverSide": true,
        "ajax": baseURL + "/list-novelties",
        "columns": [
            {data: 'status', name: 'status'},
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='"+baseURL +"/novelties/"+oData.id+"/edit' title='Ver' class='btn btn-sm btn-info'><i class='flaticon-visible'></i></a>");
                }
            }
        ]
    });
});
