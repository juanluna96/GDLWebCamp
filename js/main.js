$(function() {

    //Lettering

    $('.nombre-sitio').lettering();

    //Agregar clase a menu (No sirve aun, me toca verificar el codigo del curso en la parte de css, body.conferencia)

    // // $('body.conferencia .navegacion-principal a:constains("Conferencia")').addClass('activo');
    // // $('body.calendario .navegacion-principal a:constains("Calendario")').addClass('activo');
    // // $('body.invitados .navegacion-principal a:constains("Invitados")').addClass('activo');

    //Menu fijo (Scrolling)
    var windowHeight = $(window).height();
    var barraaltura = $('.barra').innerHeight(true);

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll > windowHeight) {
            $('.barra').addClass('fixed');
            $('.body').css({ 'margin-top': barraaltura + 'px' });
        } else {
            $('.barra').removeClass('fixed');
            $('.body').css({ 'margin-top': '0px' });
        }
    });

    //Menu responsive
    $('.menu-movil').click(function(e) {
        $('.navegacion-principal').slideToggle(1000);

    });
    // Programa de eventos cambiar de pantallas

    $('div.ocultar').hide();
    $('div.info-curso:first').show();
    $('.menu-programa a:first').addClass('activo');

    $('.menu-programa a').click(function() {
        $('.menu-programa a').removeClass('activo');
        $(this).addClass('activo');
        $('div.ocultar').hide();
        var enlaces = $(this).attr('href');
        $(enlaces).fadeIn(1000);

        return false;
    });

    //Animaciones para los numeros

    $('.resumen-evento li:nth-child(1) p').animateNumber({ number: 6 }, 1200);
    $('.resumen-evento li:nth-child(2) p').animateNumber({ number: 15 }, 1200);
    $('.resumen-evento li:nth-child(3) p').animateNumber({ number: 3 }, 1500);
    $('.resumen-evento li:nth-child(4) p').animateNumber({ number: 9 }, 1500);

    //Cuenta regresiva

    $('.cuenta-regresiva').countdown('2020/12/09 09:00:00', function(event) {
        $('#dias').html(event.strftime('%D'));
        $('#horas').html(event.strftime('%H'));
        $('#minutos').html(event.strftime('%M'));
        $('#segundos').html(event.strftime('%S'));
    });

    // Colorbox

    $('.invitado-info').colorbox({ inline: true, width: "50%" });
    $('.boton_newsletter').colorbox({ inline: true, width: "50%" });
});