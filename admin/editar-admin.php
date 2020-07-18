<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
$id = $_GET["id"];

if (!filter_var($id, FILTER_VALIDATE_INT)) {
    // Validar que sea un int
    die("Error");
}
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
            <h1>Editar administrador</h1>
            <small>Cambia los datos para editar un administrador</small>
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
              <h3 class="card-title">Edita un administrador</h3>
            </div>
            <div class="card-body">

              <?php
$sql = "SELECT * FROM admins WHERE `id_admin` = $id";
$resultado = $conn->query($sql);
$admin = $resultado->fetch_assoc();
?>


              <!-- form start -->
              <form role="form" method="post" name="guardar-registro" id="guardar-registro" action="modelo-admin.php">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa el usuario" value="<?php echo $admin["usuario"]; ?>" >
                      </div>
                      <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre" value="<?php echo $admin["nombre"]; ?>">
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa la contraseña">
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                      <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i>Editar</button>
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
