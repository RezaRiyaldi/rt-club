var defineButtons = function (buttonsNeeded, customButtons = null) {
    var buttons = [];

    if (buttonsNeeded.includes('reload')) {
        var reloadButton = {
            text: '<i class="fas fa-sync-alt"></i> Reload',
            action: function (e, dt, node, config) {
                dt.ajax.reload();
            },
            className: 'btn btn-sm btn-info'
        };

        buttons.push(reloadButton);
    }

    if (buttonsNeeded.includes('csv')) {
        var csvButton = {
            text: '<i class="fas fa-file-csv"></i> CSV',
            extend: 'csv',
            className: 'btn btn-sm btn-success'
        };
        buttons.push(csvButton);
    }

    if (buttonsNeeded.includes('excel')) {
        var excelButton = {
            text: '<i class="fas fa-file-excel"></i> excel',
            extend: 'excel',
            className: 'btn btn-sm btn-success'
        };
        buttons.push(excelButton);
    }

    if (buttonsNeeded.includes('pdf')) {
        var pdfButton = {
            text: '<i class="fas fa-file-pdf"></i> pdf',
            extend: 'pdf',
            className: 'btn btn-sm btn-danger'
        };
        buttons.push(pdfButton);
    }

    if (buttonsNeeded.includes('print')) {
        var printButton = {
            text: '<i class="fas fa-print"></i> Print',
            extend: 'print',
            className: 'btn btn-sm btn-secondary'
        };
        buttons.push(printButton);
    }

    if (customButtons != null) {
        $.each(customButtons, (key, val) => {
            var newButtons = {
                text: val.text,
                action: val.action,
                className: val.class
            }

            buttons.push(newButtons)
        })
    }

    return buttons;
}

var datatable = function (data) {
    new DataTable(data.id, {
        ajax: data.url,
        processing: true,
        serverSide: true,
        serverMethod: data.method,
        columns: data.columns,
        columnDefs: [data.defs],
        layout: {
            topCenter: {
                buttons: defineButtons(data.buttons, data.customButtons),
            }
        },
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
    })
    $(document).ready(function() {
        // Atur lebar dropdown menu
        $('select[name="' + data.id + '_length"]').css('width', '50px');
    });
}