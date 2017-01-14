$(function () {
    //Textare auto growth
    autosize($('textarea.auto-growth'));

    //Datetimepicker plugin
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm',
        clearButton: true,
        weekStart: 1
    });

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        weekStart: 0,
        time: false
    });

    $('.timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        clearButton: true,
        date: false
    });

    $('.date-end').bootstrapMaterialDatePicker
    ({
        weekStart: 0, format: 'YYYY-MM-DD', time: false
    });
    $('.date-start').bootstrapMaterialDatePicker
    ({
        weekStart: 0, format: 'YYYY-MM-DD', time: false
    }).on('change', function(e, date)
    {
        $('.date-end').bootstrapMaterialDatePicker('setMinDate', date);
    });

    $('#date').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
});