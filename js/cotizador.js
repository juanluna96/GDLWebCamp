(function() {
    "use strict";

    document.addEventListener("DOMContentLoaded", function() {



        //Campos datos usuario
        var nombre = document.getElementById('nombre');
        var apellido = document.getElementById('apellido');
        var email = document.getElementById('email');
        // Campos pase        
        var pase_dia = document.getElementById('pase_dia');
        var pase_dosdias = document.getElementById('pase_dosdias');
        var pase_completo = document.getElementById('pase_completo');
        //Botones y divs
        var calcular = document.getElementById('calcular');
        var errorDiv = document.getElementById('error');
        var botonRegistro = document.getElementById('btnRegistro');
        var resultado = document.getElementById('lista-productos');
        var suma_total = document.getElementById('suma-total');
        var contenedor_eventos = document.getElementById('contenedor_eventos');

        //Extras
        var camisas = document.getElementById('camisa_evento');
        var etiquetas = document.getElementById('etiquetas');

        // botonRegistro.disabled = true; //No permite presionar el boton de primera manera


        if (document.getElementById('calcular')) {

            //Menu fijo (Scrolling)
            var windowHeight = $(window).height();
            var barraaltura = $('.barra').innerHeight(true);

            $(window).on('scroll', BajarBarra);

            function BajarBarra() {
                var scroll = $(window).scrollTop();
                if (scroll > windowHeight) {
                    $('.barra').addClass('fixed');
                    $('.body').css({ 'margin-top': barraaltura + 'px' });
                } else {
                    $('.barra').removeClass('fixed');
                    $('.body').css({ 'margin-top': '0px' });
                }
            }
            //Menu responsive
            $('.menu-movil').click(function(e) {
                $('.navegacion-principal').slideToggle(1000);
            });

            calcular.addEventListener('click', calcularMontos);
            pase_dia.addEventListener('blur', mostrarDias);
            pase_dosdias.addEventListener('blur', mostrarDias);
            pase_completo.addEventListener('blur', mostrarDias);
            nombre.addEventListener('blur', ValidarCampos);
            apellido.addEventListener('blur', ValidarCampos);
            email.addEventListener('blur', ValidarCorreo);

            let formulario_editar = document.getElementsByClassName("editar-registrado");

            if (formulario_editar.length > 0) {
                if (pase_dia.value || pase_dosdias.value || pase_completo.value) {
                    mostrarDias();
                }
            }

            function ValidarCampos() {
                if (this.value == '') {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = '*Este campo es obligatorio*';
                    this.style.border = '1px solid red';
                } else {
                    error.style.display = 'none';
                    this.style.border = '1px solid #cccccc';
                }
            }

            function ValidarCorreo() {
                if (this.value.indexOf("@") > -1) {
                    error.style.display = 'none';
                    this.style.border = '1px solid #cccccc';
                } else {
                    errorDiv.style.display = 'block';
                    errorDiv.innerHTML = '*Por favor, coloca un correo valido*';
                    this.style.border = '1px solid red';
                }
            }

            function calcularMontos(event) {
                event.preventDefault();
                if (regalo.value === '') {
                    alert('Debes elegir un regalo');
                    regalo.focus();
                } else {
                    var boletosDia = parseInt(pase_dia.value, 10) || 0,
                        boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
                        boletoCompleto = parseInt(pase_completo.value, 10) || 0,
                        cantCamisas = parseInt(camisas.value, 10) || 0,
                        cantEtiquetas = parseInt(etiquetas.value) || 0;

                    var totalpagar = (boletosDia * 30) + (boletos2Dias * 45) + (boletoCompleto * 50) + ((cantCamisas * 10) * 0.93) + (cantEtiquetas * 2);

                    var listadoProductos = [];
                    if (boletosDia >= 1) {
                        listadoProductos.push(boletosDia + ' Pases por dia');
                    }
                    if (boletos2Dias >= 1) {
                        listadoProductos.push(boletos2Dias + ' Pases por 2 dias');
                    }
                    if (boletoCompleto >= 1) {
                        listadoProductos.push(boletoCompleto + ' Pases completos');
                    }
                    if (cantCamisas >= 1) {
                        listadoProductos.push(cantCamisas + ' Camisa(s)');
                    }
                    if (cantEtiquetas >= 1) {
                        listadoProductos.push(cantEtiquetas + ' Paquetes de etiquetas');
                    }

                    resultado.style.display = 'block';

                    if (resultado.style.display === 'block') {
                        botonRegistro.style.display = 'block';
                    }

                    resultado.innerHTML = '';
                    for (var i = 0; i < listadoProductos.length; i++) {
                        resultado.innerHTML += listadoProductos[i] + '<br/>';
                    }
                    suma_total.innerHTML = "$" + totalpagar.toFixed(2) + " USD";

                    // botonRegistro.disabled = false; //Al dar click se habilita boton registro
                    var total_pedido = document.getElementById('total_pedido');
                    total_pedido.value = totalpagar; //Asignar el total a pagar a la variable oculta total_pedido
                }
            }

            function mostrarDias(event) {
                var boletosDia = parseInt(pase_dia.value, 10) || 0,
                    boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
                    boletoCompleto = parseInt(pase_completo.value, 10) || 0;

                var diasElegidos = [];

                if (boletosDia > 0) {
                    diasElegidos.push('miercoles');
                }
                if (boletos2Dias > 0) {
                    diasElegidos.push('miercoles', 'jueves');
                }
                if (boletoCompleto > 0) {
                    diasElegidos.push('miercoles', 'jueves', 'viernes');
                }

                contenedor_eventos.style.display = 'block';

                for (var i = 0; i < diasElegidos.length; i++) {
                    document.getElementById(diasElegidos[i]).style.display = 'block';
                }
            }
        }
    }); //DOM CONTENT LOADER

})();