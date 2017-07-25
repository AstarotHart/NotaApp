$(function () {
    //Tabla Responsive Notas de 12 columnas
    $('.js-basic-example').DataTable({
    responsive: true,
        columnDefs: [
            { responsivePriority: 2, targets: 0 },
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 3, targets: 2 },
            { responsivePriority: 3, targets: 3 },
            { responsivePriority: 3, targets: 4 },
            { responsivePriority: 3, targets: 5 },
            { responsivePriority: 3, targets: 6 },
            { responsivePriority: 3, targets: 7 },
            { responsivePriority: 3, targets: 8 },
            { responsivePriority: 3, targets: 9 },
            { responsivePriority: 3, targets: 10 },
            { responsivePriority: 1, targets: 11 }
        ]
	} );

    //Tabla Responsive Notas de 16 columnas
    $('.js-basic-example-6row').DataTable({
    responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 2, targets: 2 },
            { responsivePriority: 2, targets: 3 },
            { responsivePriority: 2, targets: 4 },
            { responsivePriority: 1, targets: 5 }
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