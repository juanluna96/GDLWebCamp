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
            <h1>Editar evento</h1>
            <small>Llena el formulario para editar un evento</small>
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
              <h3 class="card-title">Editar un evento</h3>
            </div>
            <div class="card-body">

            <?php
$sql = "SELECT * FROM eventos WHERE evento_id = $id";
$resultado = $conn->query($sql);
$evento = $resultado->fetch_assoc();
?>
              <!-- form start -->
              <form role="form" method="post" name="guardar-registro" id="guardar-registro" action="modelo-evento.php">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="titulo_evento">Titulo evento:</label>
                        <input type="text" class="form-control" id="titulo_evento" name="titulo_evento" placeholder="Nombre del evento" value="<?php echo $evento['nombre_evento']; ?>">
                      </div>

<!-- Select de la categoria -->
                      <div class="form-group">
                        <label for="categoria_evento">Categoria del evento:</label>
                        <select name="categoria_evento" class="form-control seleccionar" style='width: 100%;'>
                          <option value="0">- Seleccione -</option>
                                  <?php
try {
    $categoria_actual = $evento['id_cat_evento'];
    $sql = "SELECT * FROM categoria_evento";
    $resultado = $conn->query($sql);
    while ($cat_evento = $resultado->fetch_assoc()) {
        if ($cat_evento["id_categoria"] == $categoria_actual) {?>

    <option value="<?php echo $cat_evento['id_categoria']; ?>" selected>
    <?php echo $cat_evento['cat_evento']; ?>
    </option>

<?php } else {?>
    <option value="<?php echo $cat_evento['id_categoria']; ?>">
    <?php echo $cat_evento['cat_evento']; ?>
    </option>
  <?php }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
                        </select>
                      </div>

                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                      <label>Fecha evento:</label>

<?php
$fecha = $evento["fecha_evento"];
$fecha_formato = date('m/d/Y', strtotime($fecha));
?>

                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><label for="fecha_evento" style="margin: 0;"><i class="far fa-calendar-alt"></i></label></span>
                        </div>
                        <input type="text" id="fecha_evento" name="fecha_evento" class="form-control" data-toggle="datepicker" value='<?php echo $fecha_formato; ?>'>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->



                <!-- time Picker -->
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>Hora evento:</label>
<?php
$hora = $evento['hora_evento'];
$hora_formato = date('h:i a', strtotime($hora));
?>
                    <div class="input-group date">
                      <input style='background: white;' type="text" id="hora_evento" name='hora_evento' class="form-control" value='<?php echo $hora_formato; ?>'>
                      <div class="input-group-append">
                          <div class="input-group-text"><label for="hora_evento" style="margin: 0;"><i class="far fa-clock"></i></label></div>
                      </div>
                      </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>

                <!-- Invitado -->
                <div class="form-group">
                        <label for="categoria_evento">Categoria del evento:</label>
                        <select name="invitado" class="form-control seleccionar" style='width: 100%;'>
                          <option value="0">- Seleccione -</option>
                                  <?php
try {
    $invitado_actual = $evento["id_inv"];

    $sql = "SELECT invitado_id, nombre_invitado, apellido_invitado FROM invitados";
    $resultado = $conn->query($sql);
    while ($invitados = $resultado->fetch_assoc()) {
        if ($invitados["invitado_id"] == $invitado_actual) {?>

<option value="<?php echo $invitados['invitado_id']; ?>" selected>
<?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado']; ?>
</option>

<?php } else {?>

  <option value="<?php echo $invitados['invitado_id']; ?>">
<?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado']; ?>
</option>

  <?php } //Fin del if
    } //Fin del whitle
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
                        </select>
                      </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                      <button type="submit" class="btn btn-primary"><i class="fas fa-pen-square"></i>Editar</button>
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
