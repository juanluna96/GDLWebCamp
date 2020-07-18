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
            <h1>Editar categoria de eventos</h1>
            <small>Cambia los datos para editar una categoria</small>
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
              <h3 class="card-title">Editar una categoria</h3>
            </div>
            <div class="card-body">

<?php
$sql = "SELECT * FROM categoria_evento WHERE `id_categoria` = $id";
$resultado = $conn->query($sql);
$categoria = $resultado->fetch_assoc();
?>


              <!-- form start -->
              <form role="form" method="post" name="guardar-registro" id="guardar-registro" action="modelo-categoria.php">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nombre_categoria">Categoria:</label>
                        <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Ingresa el nombre de la categoria" value="<?php echo $categoria["cat_evento"]; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Icono:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <div class="input-group-addon">
                                        <i class="fas fa-book-medical"></i>
                                    </div>
                                </div>
                            </div>
                            <input type="text" id="icono" name="icono" class="form-control pull-right" placeholder="fa-icon" value="<?php echo $categoria["icono"]; ?>">
                        </div>
                    </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                      <button type="submit" class="btn btn-primary" id='crear_registro'><i class="fas fa-plus"></i>Editar</button>
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
