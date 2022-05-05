$(document).ready(function() {
    /*---------- Renovate license --------*/

    $('[data-mask]').inputmask()

    /*----------  Datatables licenses  ----------*/
    $('#tDismissals').DataTable({
        "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        "oLanguage": {
            "sUrl":  `${window.location.href}/assets/js/spanish.json`
        },
        "serverSide": true,
        "ajax": `${window.location.href}`,
        "columns": [
            { data: 'id' },
            { data: 'taxpayer.rif' },
            { data: 'taxpayer.name' },
            { data: 'dismissed_at' },
            {
                data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(`
                        <div class="btn-group">
                            <a class="btn btn-info" href=${window.location.href}/${oData.id}/download title='Descargar cese'>
                                <i class='flaticon2-download'></i>
                            </a>
                        </div>`
                    );
                }
            }
        ]
    });
});
