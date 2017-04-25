$(function () {
    $('.js-basic-example').DataTable({
    responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 1 },
            { responsivePriority: 1, targets: 2 },
            { responsivePriority: 1, targets: 3 },
            { responsivePriority: 1, targets: 4 },
            { responsivePriority: 1, targets: 5 },
            { responsivePriority: 1, targets: 6 },
            { responsivePriority: 1, targets: 7 },
            { responsivePriority: 1, targets: 8 },
            { responsivePriority: 1, targets: 9 },
            { responsivePriority: 1, targets: 10 },
            { responsivePriority: 1, targets: 11 }
        ]
	} );

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});