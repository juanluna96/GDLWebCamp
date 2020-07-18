<?php
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
            <h1>Lista de invitados</h1>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Maneja los invitados de los eventos en esta seccion</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Biografia</th>
                  <th>Imagen</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                  <?php
try {
    $sql = "SELECT * FROM invitados";
    $resultado = $conn->query($sql);
} catch (Esception $e) {
    echo $error;
}
while ($invitado = $resultado->fetch_assoc()) {
    ?>

    <tr>
      <td><?php echo $invitado['nombre_invitado'] . " " . $invitado['apellido_invitado']; ?></td>
      <td><?php echo $invitado["descripcion"]; ?></td>
      <td><img src="../img/invitados/<?php echo $invitado['url_imagen']; ?>" class='w-75 h-25'></td>

      <td>
        <a href="editar-invitado.php?id=<?php echo $invitado['invitado_id']; ?>" class='btn bg-orange btn-flat m-1'>
          <i class="fa fa-pencil-alt text-light"></i>
        </a>
        <a href="#" data-id="<?php echo $invitado['invitado_id']; ?>" data-tipo='invitado' class='btn bg-maroon btn-flat borrar_registro m-1'>
          <i class="fa fa-trash"></i>
        </a>

      </td>
    </tr>

<?php }?>

                </tbody>
                <tfoot>
                <tr>
                  <th>Nombre</th>
                  <th>Biografia</th>
                  <th>Imagen</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once 'templates/footer.php';?>


</body>
</html>
