
    <footer class="site-footer">
        <div class="contenedor clearfix">
            <div class="footer-informacion">
                <h3>Sobre <span>GdlWebCamp</span></h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolore at ducimus numquam unde incidunt vitae repudiandae necessitatibus aliquam pariatur quo excepturi, autem doloribus minus, dignissimos similique eligendi minima commodi atque.</p>
            </div>
            <div class="ultimos-tweets">
                <h3>Ultimos <span>Tweets</span></h3>
                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime ut quasi accusamus! Quo quibusdam id aliquam deleniti ipsam repellat.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime ut quasi accusamus! Quo quibusdam id aliquam deleniti ipsam repellat.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime ut quasi accusamus! Quo quibusdam id aliquam deleniti ipsam repellat.</li>
                </ul>
            </div>
            <div class="menu">
                <h3>Redes <span>Sociales</span></h3>
                <nav class="redes-sociales">
                    <a href="#"><i class="fab fa-facebook-square"></i></i></a>
                    <a href="#"><i class="fab fa-twitter-square"></i></a>
                    <a href="#"><i class="fab fa-pinterest-square"></i></a>
                    <a href="#"><i class="fab fa-youtube-square"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </nav>
            </div>
        </div>
    </footer>

    <p class="copyright">
        Todos los derechos reservados GDLWEBCAMP 2020.
    </p>

    <!-- Inicio formulario de mailchimp-->
    <link href="css/mailchimp.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
        /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
        We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
    </style>
    <div style='display:none;' id="colorbox_mailchimp">
        <div id="mc_embed_signup">
        <form action="https://netlify.us19.list-manage.com/subscribe/post?u=29209e5dde9102c08d7c1f759&amp;id=300498bf14" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
            <h2>Subscribete a nuestro newsletter y no te pierdas ningun evento</h2>
        <div class="indicates-required"><span class="asterisk">*</span> Es obligatorio</div>
        <div class="mc-field-group">
            <label for="mce-EMAIL">Direccion de correo  <span class="asterisk">*</span>
        </label>
            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
        </div>
            <div id="mce-responses" class="clear">
                <div class="response" id="mce-error-response" style="display:none"></div>
                <div class="response" id="mce-success-response" style="display:none"></div>
            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_29209e5dde9102c08d7c1f759_300498bf14" tabindex="-1" value=""></div>
            <div class="clear"><input type="submit" value="Subscribirse" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>
        </form>
        </div>
    </div>

    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
    <!--End mc_embed_signup-->


    <script src="js/vendor/modernizr-3.8.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')
    </script>
    <script src="js/plugins.js"></script>
    <script src="js\jquery.countdown.min.js"></script>
    <!-- plugin para hacer una cuenta regresiva -->
    <script src="js\jquery.animateNumber.min.js"></script>
    <!-- plugin para animar los numeros -->
    <script src="js\jquery.lettering.js"></script>
    <!-- plugin para darle mejor estilo y animar letras -->

    <?php
$archivo = basename($_SERVER['PHP_SELF']);
$pagina = str_replace('.php', '', $archivo);

if ($pagina == 'invitados' or $pagina == 'index') {
    echo '<script src="js\jquery.colorbox-min.js"></script>'; // plugin para mostrar galeria de imagenes colorbox en invitados
} elseif ($pagina == 'conferencia') {
    echo '<script src="js\lightbox.js"></script>'; //plugin para hacer la galeria de imagenes lightbox en conferencia
}
?>

    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="js/main.js"></script>
    <script src="js/map.js"></script>
    <script src="js/cotizador.js"></script>

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('set', 'transport', 'beacon');
        ga('send', 'pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async></script>

    <!-- POPUP para solicitar subscribirse a los usuarios al newsletter mailchimp -->
    <script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">window.dojoRequire(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us19.list-manage.com","uuid":"29209e5dde9102c08d7c1f759","lid":"300498bf14","uniqueMethods":true}) })</script>
</body>

</html>