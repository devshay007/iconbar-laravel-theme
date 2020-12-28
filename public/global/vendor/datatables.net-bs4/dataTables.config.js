$(function(){
  let copyButtonTrans = 'Copy'
  let csvButtonTrans = 'CSV'
  let excelButtonTrans = 'Excel'
  let pdfButtonTrans = 'PDF'
  let printButtonTrans = 'Print'
  let selectAllButtonTrans = 'Select all'
  let selectNoneButtonTrans = 'Deselect all'

  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
  $.extend(true, $.fn.dataTable.defaults, {
    responsive: true,
    language: {
      sSearchPlaceholder: 'Search..',
      lengthMenu: '_MENU_',
      search: '_INPUT_',
      "processing":'<div class="datatable_processing" ><div class="loader vertical-align-middle loader-circle"></div><br><span>Loading. Please wait...</span></div>'
    },
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
    order: [],
    scrollX: true,
    pageLength: 100,
    dom: 'lBfrtip<"actions">',
    buttons: [
      {
        extend: 'selectAll',
        className: 'btn-primary',
        text: selectAllButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'selectNone',
        className: 'btn-primary',
        text: selectNoneButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'csv',
        className: 'btn-default',
        text: csvButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'excel',
        className: 'btn-default',
        text: excelButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdf',
        className: 'btn-default',
        text: pdfButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'print',
        className: 'btn-default',
        text: printButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
    ]
  });
  $.fn.dataTable.ext.classes.sPageButton = '';
});