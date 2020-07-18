<?php
$id = $_GET["id"];

if (!filter_var($id, FILTER_VALIDATE_INT)) {
    // Validar que sea un int
    die("Error");
}
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
include_once 'templates/header.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar registro de usuario</h1>
            <small>Llena el formulario para editar a un usuario para el evento</small>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Edita un usuario registrado</h3>
            </div>
            <div class="card-body">
            <?php
$sql = "SELECT * FROM registrados WHERE ID_Registrado=$id";
$resultado = $conn->query($sql);
$registrado = $resultado->fetch_assoc();
?>
              <!-- form start -->
              <form class='editar-registrado' role="form" method="post" name="guardar-registro" id="guardar-registro" action="modelo-registrado.php">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nombre_registrado">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre" value="<?php echo $registrado['nombre_registrado']; ?>">
                      </div>

                      <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa el apellido" value="<?php echo $registrado['apellido_registrado']; ?>">
                      </div>

                      <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa el correo" value="<?php echo $registrado['email_registrado']; ?>">
                      </div>

<?php
$pedido = $registrado['pases_articulos'];
$boletos = json_decode($pedido, true);
?>
                      <div class="form-group">
                        <div class='paquetes' id='paquetes'>
                        <label for="">Elige el numero de boletos</label>
                          <ul class='lista-precios clearfix row'>
                              <li class="col-md-4">
                                  <div class='tabla-precio text-center'>
                                      <h3>Pase por dia (Miercoles)</h3>
                                      <p class='numero'>$30</p>
                                      <ul>
                                          <li><i class='fas fa-check mr-1 text-primary'></i>Bocadillos Gratis</li>
                                          <li><i class='fas fa-check mr-1 text-primary'></i>Todas las conferencias</li>
                                          <li><i class='fas fa-check mr-1 text-primary'></i>Todos los talleres</li>
                                      </ul>
                                      <div class='orden'>
                                          <label for='pase_dia'>Boletos deseados:</label>
                                          <input value="<?php echo $boletos['un_dia']['cantidad']; ?>" type='number' class="form-control" name='boletos[un_dia][cantidad]' id='pase_dia' size='3' placeholder='0'
                                              min='0'>
                                          <input type="hidden" value='30' name='boletos[un_dia][precio]'>
                                      </div>
                                  </div>
                              </li>
                              <li class="col-md-4">
                                  <div class='tabla-precio text-center'>
                                      <h3>Todos los dias</h3>
                                      <p class='numero'>$50</p>
                                      <ul>
                                          <li><i class='fas fa-check mr-1 text-primary'></i>Bocadillos Gratis</li>
                                          <li><i class='fas fa-check mr-1 text-primary'></i>Todas las conferencias</li>
                                          <li><i class='fas fa-check mr-1 text-primary'></i>Todos los talleres</li>
                                      </ul>
                                      <div class='orden'>
                                          <label for='pase_completo'>Boletos deseados:</label>
                                          <input value="<?php echo $boletos['pase_completo']['cantidad']; ?>"  type='number' class="form-control" name='boletos[completo][cantidad]' id='pase_completo' size='3'
                                              placeholder='0' min='0'>
                                          <input type="hidden" value='50' name='boletos[completo][precio]'>
                                      </div>
                                  </div>
                              </li>
                              <li class="col-md-4">
                                  <div class='tabla-precio text-center'>
                                      <h3 class='titulo-pase3'>Pase por 2 dias (Miercoles y jueves)</h3>
                                      <p class='numero'>$45</p>
                                      <ul>
                                          <li><i class='fas fa-check mr-1 text-primary'></i>Bocadillos Gratis</li>
                                          <li><i class='fas fa-check mr-1 text-primary'></i>Todas las conferencias</li>
                                          <li><i class='fas fa-check mr-1 text-primary'></i>Todos los talleres</li>
                                      </ul>
                                      <div class='orden'>
                                          <label for='pase_dosdias'>Boletos deseados:</label>
                                          <input value="<?php echo $boletos['pase_2dias']['cantidad']; ?>" type='number' class="form-control" name='boletos[2dias][cantidad]' id='pase_dosdias' size='3'
                                              placeholder='0' min='0'>
                                          <input type="hidden" value='45' name='boletos[2dias][precio]'>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                        </div>
                      <!--Paquetes-->
                      </div>

                      <div class="form-group">
                        <label for="">Elige los talleres</label>
                        <div id='eventos' class='eventos clearfix'>
            <div id='contenedor_eventos' class='caja'>

            <?php
$eventos = $registrado['talleres_registrados'];
$id_eventos_registrados = json_decode($eventos, true);

try {
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
                                <h4 class="nombre_dia text-center"><?php echo $dia; ?></h4>
            <div class="eventos_del_dia row">
              <?php foreach ($eventos['eventos'] as $tipo => $evento_dia): ?>
                                  <div class='col-md-4'>
                                      <p class="tipo-evento"><?php echo $tipo; ?></p>

                                      <?php foreach ($evento_dia as $evento): ?>
                                      <label>
                                          <div class="icheck-primary d-inline">
                                            <!-- Operador ternario que chequea en cada elemento si el id actual es igual al del registrado -->
                                            <input <?php echo (in_array($evento['id'], $id_eventos_registrados['eventos']) ? 'checked' : ''); ?> type="checkbox" name="registro_evento[]" id="checkboxPrimary2" value="<?php echo $evento['id'] ?>">
                                            <label for="checkboxPrimary2">
                                            </label>
                                          </div>
                                          <time><?php echo $evento['hora'] ?></time>
                                          <?php echo $evento['nombre_evento']; ?><br>
                                          <span class="autor"><?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?></span>
                                      </label>
                                      <?php endforeach; //Foreach del checkbox del evento?>
                                  </div>
              <?php endforeach;?>
            </div>
                            </div>
                            <!--.contenido-dia-->
            <?php endforeach;?>
                        </div>
                        <!--.caja-->
        </div>
        <!--#eventos-->

        <div class='resumen clearfix'>
            <label for="">Pagos y extras</label>
            <br>
            <div class='caja clearfix row'>
                <div class='extras col-md-6'>
                    <div class='orden'>
                        <label for='camisa_evento'>Camisa del evento $10 <small>( Promocion 7% DTO. )</small></label>
                        <input value='<?php echo $boletos['camisas'] ?>' type='number' class='form-control' id='camisa_evento' name='pedido_extra[camisas][cantidad]' placeholder='0'
                            size='3' min='0'>
                        <input type="hidden" value="10" name='pedido_extra[camisas][precio]'>
                    </div>
                    <!--.orden-->
                    <div class='orden'>
                        <label for='etiquetas'>Paquete de 10 etiquetas $2 <small>( HTML5, CSS3, JavaScript, Chrome
                                )</small></label>
                        <input value='<?php echo $boletos['etiquetas'] ?>' type='number' class='form-control' id='etiquetas' name='pedido_extra[etiquetas][cantidad]' placeholder='0'
                            size='3' min='0'>
                        <input type="hidden" value="2" name='pedido_extra[etiquetas][precio]'>
                    </div>
                    <!--.orden-->
                    <div class='orden'>
                        <label for='regalo'>Seleccione un regalo</label>
                        <select name='regalo' id='regalo' class="form-control seleccionar" required>
                            <option value=''>- Seleccione un regalo -</option>
                            <option value='2' <?php echo ($registrado['regalo'] == 2) ? 'selected' : ''; ?>>Etiquetas</option>
                            <option value='1' <?php echo ($registrado['regalo'] == 1) ? 'selected' : ''; ?>>Pulsera</option>
                            <option value='3' <?php echo ($registrado['regalo'] == 3) ? 'selected' : ''; ?>>Plumas</option>
                        </select>
                        <br>
                    </div>
                    <!--.orden-->

                    <input type='button' value='Calcular' class='btn btn-success' id='calcular'>
                </div>
                <!--.extras-->
                <div class='total col-md-6'>
                    <label>Resumen:</label>
                    <div class='' id='lista-productos'></div>
                    <label>Total ya pagado:</label>
                    <p>$<?php echo $registrado['total_pagado']; ?> USD</p>
                    <label>Total:</label>
                    <div class='' id='suma-total'>

                    </div>
                    <input type='hidden' name='total_pedido' id='total_pedido'>
                </div>
                <!--.total-->
            </div>
            <!--.caja-->
        </div>
        <!--.resumen-->
                      </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <input type="hidden" name="total_descuento" id="total_descuento" value="<?php echo $registrado['total_pagado']; ?>">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $registrado['ID_Registrado']; ?>">
                    <input type="hidden" name="fecha_registro" value="<?php echo $registrado['fecha_registro']; ?>">
                      <button type="submit" class="btn btn-primary" id='btnRegistro'><i class="fas fa-plus"></i>Añadir</button>
                    </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once 'templates/footer.php';?>


</body>
</html>
