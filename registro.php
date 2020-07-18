<?php include_once 'includes/templates/header.php';
?>

<section class='seccion contenedor'>
    <h2>Registro de usuarios</h2>
    <form action='pagar.php' class='registro' id='registro' method='post'>
        <div id='datos_usuario' class='registro caja clearfix'>
            <div class='campo'>
                <label for='nombre'>Nombre:</label>
                <input type='text' name='nombre' class='nombre' id='nombre' placeholder='Tu nombre'>
            </div>
            <div class='campo'>
                <label for='nombre'>Apellido:</label>
                <input type='text' name='apellido' class='apellido' id='apellido' placeholder='Tu apellido'>
            </div>
            <div class='campo'>
                <label for='nombre'>Email:</label>
                <input type='text' name='email' class='email' id='email' placeholder='Tu correo'>
            </div>
            <div id='error'></div>
        </div>
        <!--#datos_usuario-->

        <div class='paquetes' id='paquetes'>
            <h3>Elige el numero de boletos</h3>
            <ul class='lista-precios clearfix'>
                <li>
                    <div class='tabla-precio'>
                        <h3>Pase por dia ( Miercoles )</h3>
                        <p class='numero'>$30</p>
                        <ul>
                            <li><i class='fas fa-check'></i>Bocadillos Gratis</li>
                            <li><i class='fas fa-check'></i>Todas las conferencias</li>
                            <li><i class='fas fa-check'></i>Todos los talleres</li>
                        </ul>
                        <div class='orden'>
                            <label for='pase_dia'>Boletos deseados:</label>
                            <input type='number' name='boletos[un_dia][cantidad]' id='pase_dia' size='3' placeholder='0'
                                min='0'>
                            <input type="hidden" value='30' name='boletos[un_dia][precio]'>
                        </div>
                    </div>
                </li>
                <li>
                    <div class='tabla-precio'>
                        <h3>Todos los dias</h3>
                        <p class='numero'>$50</p>
                        <ul>
                            <li><i class='fas fa-check'></i>Bocadillos Gratis</li>
                            <li><i class='fas fa-check'></i>Todas las conferencias</li>
                            <li><i class='fas fa-check'></i>Todos los talleres</li>
                        </ul>
                        <div class='orden'>
                            <label for='pase_completo'>Boletos deseados:</label>
                            <input type='number' name='boletos[completo][cantidad]' id='pase_completo' size='3'
                                placeholder='0' min='0'>
                            <input type="hidden" value='50' name='boletos[completo][precio]'>
                        </div>
                    </div>
                </li>
                <li>
                    <div class='tabla-precio'>
                        <h3 class='titulo-pase3'>Pase por 2 dias ( Miercoles y jueves )</h3>
                        <p class='numero'>$45</p>
                        <ul>
                            <li><i class='fas fa-check'></i>Bocadillos Gratis</li>
                            <li><i class='fas fa-check'></i>Todas las conferencias</li>
                            <li><i class='fas fa-check'></i>Todos los talleres</li>
                        </ul>
                        <div class='orden'>
                            <label for='pase_dosdias'>Boletos deseados:</label>
                            <input type='number' name='boletos[2dias][cantidad]' id='pase_dosdias' size='3'
                                placeholder='0' min='0'>
                            <input type="hidden" value='45' name='boletos[2dias][precio]'>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!--Paquetes-->

        <div id='eventos' class='eventos clearfix'>
            <h3>Elige tus talleres</h3>
            <div id='contenedor_eventos' class='caja'>

            <?php
try {
    require_once 'includes/funciones/bd_conexion.php'; //Crear coneccion
    $sql = "SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado ";
    $sql .= "FROM eventos ";
    $sql .= "JOIN categoria_evento ";
    $sql .= "ON eventos.id_cat_evento = categoria_evento.id_categoria ";
    $sql .= "JOIN invitados ";
    $sql .= "ON eventos.id_inv = invitados.invitado_id ";
    $sql .= "ORDER BY eventos.fecha_evento";

    $resultado = $conn->query($sql);
} catch (Exception $e) {
    echo $e->getMessage();
}
$eventos_dias = array();
while ($eventos = $resultado->fetch_assoc()) {
    // Convertir fecha a dia de la semana y pasarlo a español
    $fecha = $eventos['fecha_evento'];
    setlocale(LC_ALL, 'esm.UTF-8');
    $dia_semana = strftime("%A", strtotime($fecha));

    $categoria = $eventos['cat_evento'];
    // array donde iran todos los datos del evento
    $dia = array(
        'dia' => $dia_semana,
        'nombre_evento' => $eventos['nombre_evento'],
        'hora' => $eventos['hora_evento'],
        'id' => $eventos['evento_id'],
        'nombre_invitado' => $eventos['nombre_invitado'],
        'apellido_invitado' => $eventos['apellido_invitado'],
    );

    // Ordenar el array segun el dia de la semana
    $eventos_dias[$dia_semana]['eventos'][$categoria][] = $dia;
}
?>

            <?php foreach ($eventos_dias as $dia => $eventos): ?>
                            <div id='<?php echo str_replace('é', 'e', $dia); ?>' class='contenido-dia clearfix'>
                                <h4><?php echo $dia; ?></h4>
            <?php foreach ($eventos['eventos'] as $tipo => $evento_dia): ?>
                                <div>
                                    <p><?php echo $tipo; ?></p>

                                    <?php foreach ($evento_dia as $evento): ?>
                                    <label>
                                        <input type="checkbox" name="registro[]" value="<?php echo $evento['id'] ?>">
                                        <time><?php echo $evento['hora'] ?></time>
                                        <?php echo $evento['nombre_evento']; ?><br>
                                        <span class="autor"><?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?></span>
                                    </label>
                                    <?php endforeach; //Foreach del checkbox del evento?>
                                </div>
            <?php endforeach;?>
                            </div>
                            <!--.contenido-dia-->
            <?php endforeach;?>
                        </div>
                        <!--.caja-->
        </div>
        <!--#eventos-->

        <div class='resumen clearfix'>
            <h3>Pago y extras</h3>
            <div class='caja clearfix'>
                <div class='extras'>
                    <div class='orden'>
                        <label for='camisa_evento'>Camisa del evento $10 <small>( Promocion 7% DTO. )</small></label>
                        <input type='number' id='camisa_evento' name='pedido_extra[camisas][cantidad]' placeholder='0'
                            size='3' min='0'>
                        <input type="hidden" value="10" name='pedido_extra[camisas][precio]'>
                    </div>
                    <!--.orden-->
                    <div class='orden'>
                        <label for='etiquetas'>Paquete de 10 etiquetas $2 <small>( HTML5, CSS3, JavaScript, Chrome
                                )</small></label>
                        <input type='number' id='etiquetas' name='pedido_extra[etiquetas][cantidad]' placeholder='0'
                            size='3' min='0'>
                        <input type="hidden" value="2" name='pedido_extra[etiquetas][precio]'>
                    </div>
                    <!--.orden-->
                    <div class='orden'>
                        <label for='regalo'>Seleccione un regalo</label>
                        <select name='regalo' id='regalo' required>
                            <option value=''>- Seleccione un regalo -</option>
                            <option value='2'>Etiquetas</option>
                            <option value='1'>Pulsera</option>
                            <option value='3'>Plumas</option>
                        </select>
                    </div>
                    <!--.orden-->

                    <input type='button' value='Calcular' class='button' id='calcular'>
                </div>
                <!--.extras-->
                <div class='total'>
                    <p>Resumen:</p>
                    <div class='' id='lista-productos'>

                    </div>
                    <p>Total:</p>
                    <div class='' id='suma-total'>

                    </div>
                    <input type='hidden' name='total_pedido' id='total_pedido'>
                    <input type='submit' name='submit' id='btnRegistro' value='pagar' class='button'>
                </div>
                <!--.total-->
            </div>
            <!--.caja-->
        </div>
        <!--.resumen-->

    </form>
</section>

<?php include_once 'includes/templates/footer.php';
?>