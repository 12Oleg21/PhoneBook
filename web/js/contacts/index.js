 $("#contactsTable").DataTable( {
                        paging      : true,
                        lengthChange: true,
                        ordering    : true,
                        info        : true,
                        autoWidth   : false,
                        searching   : true,
                        columnDefs  : [ { "targets": [5], "orderable": false } ] // disable sortable for action column
                    } );

