$(document).ready(function() {
  let url = `${window.location.href}`;
  let newUrl = '';

  $('#types').on('change', onSelectTypes);

  function onSelectTypes() {
    let selected = $(this).children('option:selected').val();
    
    newUrl = url + `/?type=${selected}`; 
    datatable.ajax.url(newUrl).load();
  }

  const datatable = $('#tLicenses').DataTable({
      "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
      "oLanguage": {
          "sUrl": baseURL + "/assets/js/spanish.json"
      },
      "serverSide": true,
      "ajax": url,
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
});
