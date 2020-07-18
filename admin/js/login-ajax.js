$(document).ready(function() {
    // Logear
    $('#login-admin').on('submit', function(e) {
        e.preventDefault();

        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                var resultado = data;
                if (resultado.respuesta == 'exito') {
                    Swal.fire(
                        'Login Correcto !',
                        'Bienvenido/a ' + resultado.usuario + ' !',
                        'success'
                    )
                    setTimeout(function() {
                        window.location.href = 'admin-area.php';
                    }, 2000)
                    document.querySelector('.form').reset();
                } else {
                    Swal.fire(
                        'Error!',
                        'Usuario y/o Contraseña Incorrectos',
                        'error'
                    );
                }
            }
        });
    });
});