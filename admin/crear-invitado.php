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
            <h1>Crear invitados</h1>
            <small>Llena el formulario para añadir un invitado</small>
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
              <h3 class="card-title">Crear un invitado</h3>
            </div>
            <div class="card-body">
              <!-- form start -->
              <form role="form" method="post" name="guardar-registro" id="guardar-registro-archivo" action="modelo-invitado.php" enctype="multipart/form-data">
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nombre_invitado">Nombre:</label>
                        <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Ingresa el nombre del invitado">
                      </div>
                      <div class="form-group">
                        <label for="apellido_invitado">Apellido:</label>
                        <input type="text" class="form-control" id="apellido_invitado" name="apellido_invitado" placeholder="Ingresa el apellido del invitado">
                      </div>
                      <div class="form-group">
                        <label for="biografia_invitado">Biografia:</label>
                        <textarea class="form-control" name="biografia_invitado" id="biografia_invitado" rows="10" placeholder="Biografia"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="imagen_invitado">Imagen:</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imagen_invitado" name="archivo_imagen">
                            <label class="custom-file-label" for="imagen_invitado">Añada aqui la imagen del invitado</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="">Subir</span>
                        </div>
                        </div>
                    </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <input type="hidden" name="registro" value="nuevo">
                      <button type="submit" class="btn btn-primary" id='crear_registro'><i class="fas fa-user-plus"></i>Añadir</button>
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
