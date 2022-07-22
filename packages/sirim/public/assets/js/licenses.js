/*Fuction disable button before sumit*/
$("#form").closest('form').on('submit', function(e) {
    e.preventDefault();
    $('#send').attr('disabled', true);
    $('#cancel').attr('disabled', true);
    this.submit();
});

const licensesToken = $("meta[name='csrf-token']").attr("content");

/*----------  Uppercase  ----------*/
function upperCase(e) {
  e.value = e.value.toUpperCase();
}

const renovateLicense = (id) => {
    Swal.fire({
        title: '¿Está seguro(a) que desea renovar la licencia?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Renovar'
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: `${window.location.href}/${id}/renovate`,
                data: {
                    '_method': 'POST',
                    '_token': $("meta[name='csrf-token']").attr("content"),
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

const dismissLicense = (id) => {
    Swal.fire({
        title: '¿Está seguro(a) que desea cesar la licencia?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Cesar'
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: `${window.location.href}/${id}/dismiss`,
                data: {
                    '_method': 'POST',
                    '_token': $("meta[name='csrf-token']").attr("content"),
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

const renovateLicenseButton = id => (
    `<a class="mr-2" onClick="renovateLicense(${id})" title='Editar'>
        <i class='btn-sm btn-success fas fa-trash-alt'></i>
    </a>`
);

$(document).ready(function() {
    /*---------- Renovate license --------*/

    $('[data-mask]').inputmask()

    /*----------  Datatables licenses  ----------*/
    $('#tLicenses').DataTable({
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl":  `${window.location.href}/assets/js/spanish.json`
        },
        "serverSide": true,
        "ajax": `${window.location.href}`,
        "columns": [
            { data: 'num' },
            { data: 'taxpayer.rif' },
            { data: 'taxpayer.name' },
            { data: 'ordinance.description' },
            { data: 'id',
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    const active = `
                        <span class="kt-badge kt-badge--success kt-badge--inline">
                            Activo
                        </span>
                        `;
                    const inactive = `
                        <span class="kt-badge kt-badge--danger kt-badge--inline">
                            Inactivo
                        </span>
                        `;
                    $(nTd).html(`${oData.active ? active : inactive}`);
                }
            },
            { data: 'emission_date' },
            { data: 'expiration_date' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    const renovateLicenseButton = id => (`
                        <a class="mr-2" onClick="renovateLicense(${id})" title='Renovar'>
                            <i class='btn-sm btn-success fas fa-sync'></i>
                        </a>
                    `);

                    $(nTd).html(`
                        <div class="btn-group">
                            <a class="mr-2" href=${window.location.href}/${oData.id} title='Ver licencia'>
                                <i class='btn-sm btn-info fas fa-eye'></i>
                            </a>
                            <a class="mr-2" onClick="dismissLicense(${oData.id})" title='Cesar licencia'>
                                <i class='btn-sm btn-warning fas fa-exclamation'></i>
                            </a>
                            ${!oData.active ? renovateLicenseButton(oData.id) : ''}
                        </div>`
                    );
                }
            }
        ]
    });


        $('#tVehicleLicenses').DataTable({
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl":  `${window.location.href}/assets/js/spanish.json`
        },
        "serverSide": true,
        "ajax": `${window.location.href}`,
        "columns": [
            { data: 'num' },
            { data: 'taxpayer.rif' },
            { data: 'taxpayer.name' },
            { data: 'ordinance.description' },
            { data: 'id',
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    const active = `
                        <span class="kt-badge kt-badge--success kt-badge--inline">
                            Activo
                        </span>
                        `;
                    const inactive = `
                        <span class="kt-badge kt-badge--danger kt-badge--inline">
                            Inactivo
                        </span>
                        `;
                    $(nTd).html(`${oData.active ? active : inactive}`);
                }
            },
            { data: 'emission_date' },
            { data: 'expiration_date' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    const renovateLicenseButton = id => (`
                        <a class="mr-2" onClick="renovateLicense(${id})" title='Renovar'>
                            <i class='btn-sm btn-success fas fa-sync'></i>
                        </a>
                    `);

                    $(nTd).html(`
                        <div class="btn-group">
                            <a class="mr-2" href=${window.location.href}/${oData.id} title='Ver licencia'>
                                <i class='btn-sm btn-info fas fa-eye'></i>
                            </a>
                            <a class="mr-2" onClick="dismissLicense(${oData.id})" title='Cesar licencia'>
                                <i class='btn-sm btn-warning fas fa-exclamation'></i>
                            </a>
                            ${!oData.active ? renovateLicenseButton(oData.id) : ''}
                        </div>`
                    );
                }
            }
        ]
    });
});
