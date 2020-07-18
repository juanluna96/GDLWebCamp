<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$cerrar_sesion = $_GET["cerrar_sesion"];
// Cerrar sesion si se pasa como parametro el cerrar sesion de la barra
if ($cerrar_sesion) {
    session_destroy();
}
include_once 'funciones/funciones.php';
include_once 'templates/header.php';

?>

<div class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../index.php"><b>GDL</b>WebCamp</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Inicia sesion aqui</p>

        <form name="login-admin-form" id="login-admin" method="post" action="login-admin.php">
          <div class="input-group mb-3">
            <input name="usuario" type="text" class="form-control" placeholder="Usuario">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <!-- /.col -->
            <div class="col-12 text-center">
              <input type="hidden" name="login-admin" value="1">
              <button type="submit" class="btn btn-primary btn-block">Iniciar sesion</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</div>

<?php include_once 'templates/footer.php';?>


</body>
</html>
