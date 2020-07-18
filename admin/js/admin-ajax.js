$(document).ready(function() {

    // Guardar registro
    $('#guardar-registro').on('submit', function(e) {
        e.preventDefault();

        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var resultado = data;
                if (resultado.respuesta == 'exito_registrado') {
                    Swal.fire(
                        'Participante creado!',
                        'Participante creado de forma exitosa',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                    // document.querySelector('.form').reset();
                } else if (resultado.respuesta == 'exito_registrado_actualizado') {
                    Swal.fire(
                        'Registrado actualizado!',
                        'Registrado actualizado correctamente',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            window.location.href = './lista-registrados.php';
                        }
                    });
                } else if (resultado.respuesta == 'exito_categoria') {
                    Swal.fire(
                        'Evento creado!',
                        'Evento creado de forma exitosa',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                    // document.querySelector('.form').reset();
                } else if (resultado.respuesta == 'exito_categoria_actualizado') {
                    Swal.fire(
                        'Categoria actualizada!',
                        'Categoria actualizada correctamente',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            window.location.href = './lista-categorias.php';
                        }
                    });
                } else if (resultado.respuesta == 'exito_evento') {
                    Swal.fire(
                        'Evento creado!',
                        'Evento creado de forma exitosa',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                    // document.querySelector('.form').reset();
                } else if (resultado.respuesta == 'exito_evento_actualizado') {
                    Swal.fire(
                        'Evento actualizado!',
                        'Evento actualizado correctamente',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            window.location.href = './lista-evento.php';
                        }
                    });
                } else if (resultado.respuesta == 'exito') {
                    Swal.fire(
                        'Administrador Creado!',
                        'Bienvenido ya eres un administrador',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                    // document.querySelector('.form').reset();
                } else if (resultado.respuesta == 'correcto') {
                    Swal.fire(
                        'Administrador editado!',
                        'Admininistrador editado correctamente',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            window.location.href = './lista-admin.php';
                        }
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        'Ocurrio un error al intentar crear el administrador',
                        'error'
                    );
                }
            }
        })
    });

    // Se ejecuta cuando hay un archivo, especificamente en invitados
    $('#guardar-registro-archivo').on('submit', function(e) {
        e.preventDefault();

        var datos = new FormData(this);

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false,
            processData: false,
            async: true,
            cache: false,

            success: function(data) {
                console.log(data);
                var resultado = data;
                if (resultado.respuesta == 'exito_invitado') {
                    Swal.fire(
                        'Invitado añadido!',
                        'Invitado añadido de forma exitosa',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                    });
                    // document.querySelector('.form').reset();
                } else if (resultado.respuesta == 'exito_categoria_actualizado') {
                    Swal.fire(
                        'Invitado actualizado!',
                        'Invitado actualizado correctamente',
                        'success'
                    ).then((result) => {
                        if (result.value) {
                            window.location.href = './lista-invitados.php';
                        }
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        'Ocurrio un error al intentar crear el administrador',
                        'error'
                    );
                }
            }
        })
    });

    // Eliminar un registro
    $('.borrar_registro').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');

        Swal.fire({
            title: 'Estas seguro de eliminar al administrador?',
            text: "No seras capaz de revertir este cambio!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, borrarlo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "modelo-" + tipo + '.php',
                    data: {
                        'id': id,
                        'registro': 'eliminar'
                    },
                    success: function(data) {
                        console.log(data);
                        var resultado = JSON.parse(data);
                        if (resultado.respuesta == 'exito') {
                            Swal.fire(
                                'Registro eliminado!',
                                'El registro ha sido eliminado correctamente',
                                'success'
                            )
                            jQuery('[data-id="' + resultado.id_eliminado + '"]').parents('tr').remove();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo eliminar el registro'
                            })
                        }
                    }
                });
            }
        })

    });

});