$('#tLiquidations').DataTable({
    "order": [[0, "asc"]],
    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
    "oLanguage": {
        "sUrl": baseURL + "/assets/js/spanish.json"
    },
    "serverSide": true,
    "ajax": `${window.location.href}`,
    "columns": [
        { data: 'num', name: 'num' },
        { data: 'pretty_amount', name: 'pretty_amount' },
        { data: 'object_payment', name: 'object_payment' },
        { data: 'id',
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                const active = `
                    <span class="kt-badge kt-badge--success kt-badge--inline">
                        Procesado
                    </span>
                    `;
                const inactive = `
                    <span class="kt-badge kt-badge--danger kt-badge--inline">
                        Pendiente
                    </span>
                    `;
                $(nTd).html(`${oData.payment.state_id == 2 ? active : inactive}`);
            }
        },
        {
            data: "id",
            "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                $(nTd).html(`
                <div class="btn-group">
                    <a class="mr-2" href=${baseURL}/liquidations/${oData.id}/show title='Ver liquidación'>
                        <i class='btn-sm btn-info fas fa-eye'></i>
                    </a>
                </div>`
                );
            }
        }
    ]
});
