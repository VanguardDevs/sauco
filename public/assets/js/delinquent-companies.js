$('#tDelinquentCompanies').DataTable({
    "order": [[0, "asc"]],
    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
    "oLanguage": {
        "sUrl": baseURL + "/assets/js/spanish.json"
    },
    "serverSide": true,
    "ajax": `${window.location.href}`,
    "columns": [
        { data: 'rif', name: 'rif' },
        { data: 'name', name: 'name' },
        { data: 'fiscal_address', name: 'fiscal_address' },
        {
            data: "id",
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                $(nTd).html(`
                <div class="btn-group">
                    <a class="mr-2" href=${baseURL}/taxpayers/${oData.id} title='Ver declaración jurada de ingresos'>
                        <i class='btn-sm btn-info fas fa-eye'></i>
                    </a>
                </div>`
                );
            }
        }
    ]
});
