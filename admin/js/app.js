$(function() {
    $("#registros").DataTable({
        "responsive": true,
        "autoWidth": false,
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            paginate: {
                next: 'Siguiente',
                previous: "Anterior",
                last: 'Ultimo',
                first: 'Primero'
            },
            info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
            emptyTable: 'No hay registros',
            infoEmpty: '0 Registros',
            search: 'Buscar:'
        }
    });

    // Deshabilitar boton
    $('#crear_registro_admin').attr('disabled', true);

    // Verificacion de las contraseñas
    $('#repetir_password').on('keyup', function() {
        var password_nuevo = $('#password').val();
        var campo_password = $('#password');
        var campo_repetir_password = $('#repetir_password');

        campo_password.removeClass('is-valid is-invalid');
        campo_repetir_password.removeClass('is-valid is-invalid');
        $('#resultado_password').removeClass('valid-feedback invalid-feedback');

        // Passwords iguales
        if ($(this).val() == password_nuevo) {

            $('#resultado_password').text('Correcto');
            campo_password.addClass('is-valid');
            campo_repetir_password.addClass('is-valid');
            $('#resultado_password').addClass('valid-feedback');
            $('#crear_registro_admin').attr('disabled', false);

        } else { // Passwords distintos

            $('#resultado_password').text('Las contraseñas no coinciden');
            campo_password.addClass('is-invalid');
            campo_repetir_password.addClass('is-invalid');
            $('#resultado_password').addClass('invalid-feedback');

        }

    });

    // FontAwesome-IconPicker
    $('#icono').iconpicker();
    $("div.iconpicker-popover").removeClass('fade');


    // Select2
    $('.seleccionar').select2({
        theme: 'bootstrap4'
    })

    // Datepicker
    const myDatePicker = $('[data-toggle="datepicker"]');
    myDatePicker.datepicker({
        autoHide: true,
        format: 'dd/mm/yyyy',
    });

    // MDTimePicker
    $(document).ready(function() {
        $('#hora_evento').mdtimepicker();
    });

    // BS-custom-File-Input
    $(document).ready(function() {
        bsCustomFileInput.init();
    });

    $.getJSON("servicio-registrados.php", function(data) {
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'grafica-registros',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: data,
            // The name of the data record attribute that contains x-values.
            xkey: 'fecha',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['cantidad'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Value'],
            // Color de la linea de la grafica
            lineColors: ['#10375c'],
            resize: true
        });
    });

});