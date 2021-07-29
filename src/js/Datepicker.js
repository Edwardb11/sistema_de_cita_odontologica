$(function () {
    $("#datepicker").datepicker();
});

$(function () {
    $('#fecha_cita').datepicker({
        beforeShowDay: $.datepicker.noWeekends,
        minDate: 0
    });

});



