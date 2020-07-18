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
            <h1>Dashboard</h1>
            <small>Informacion sobre el evento</small>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Resumen de registros -->
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="far fa-chart-bar"></i>
            Resumen de registros
          </h3>
        </div>
        <div class="card-body">
          <div id="grafica-registros" style="height: 300px;"></div>
        </div>
        <!-- /.card-body-->
      </div>
      <!-- /.card -->


<div class='row'>
        <div class="col-lg-3 col-6">

    <?php
// Contar el numero de ids de registro que existen
$sql = 'SELECT COUNT(ID_Registrado) AS registros FROM registrados';
$resultado = $conn->query($sql);
$registrados = $resultado->fetch_assoc();
?>

          <!-- small card -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $registrados['registros']; ?></h3>

              <p>Total de registros</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="lista-registrados.php" class="small-box-footer">
              Mas informacion <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>


        <div class="col-lg-3 col-6">

  <?php
// Contar el numero de personas que ya han pagado el boleto
$sql = 'SELECT COUNT(ID_Registrado) AS registros FROM registrados WHERE pagado = 1';
$resultado = $conn->query($sql);
$registrados = $resultado->fetch_assoc();
?>

        <!-- small card -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3><?php echo $registrados['registros']; ?></h3>

            <p>Total usuarios pagados</p>
          </div>
          <div class="icon">
            <i class="fas fa-money-bill-wave-alt"></i>
          </div>
          <a href="lista-registrados.php" class="small-box-footer">
            Mas informacion <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>


      <div class="col-lg-3 col-6">

  <?php
// Contar el numero de personas que aun no han pagado el boleto
$sql = 'SELECT COUNT(ID_Registrado) AS registros FROM registrados WHERE pagado = 0';
$resultado = $conn->query($sql);
$registrados = $resultado->fetch_assoc();
?>

        <!-- small card -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?php echo $registrados['registros']; ?></h3>

            <p>Total usuarios sin pagar</p>
          </div>
          <div class="icon">
            <i class="fas fa-search-dollar"></i>
          </div>
          <a href="lista-registrados.php" class="small-box-footer">
            Mas informacion <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-3 col-6">

<?php
// Sumar el total de dinero que han pagado ya los usuarios
$sql = 'SELECT SUM(total_pagado) AS ganancias FROM registrados WHERE pagado = 1';
$resultado = $conn->query($sql);
$registrados = $resultado->fetch_assoc();
?>

      <!-- small card -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>$<?php echo $registrados['ganancias']; ?></h3>

          <p>Ganancias totales</p>
        </div>
        <div class="icon">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <a href="lista-registrados.php" class="small-box-footer">
          Mas informacion <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

</div>
<!-- Div-Row -->

<h4 class="pb-2 mt-4 mb-2 border-bottom">Regalos</h2>

  <div class="row">

    <div class="col-lg-3 col-6">
      <?php
// Sumar el total de dinero que han pagado ya los usuarios
$sql = 'SELECT COUNT(total_pagado) AS pulseras FROM registrados WHERE pagado = 1';
$resultado = $conn->query($sql);
$regalo = $resultado->fetch_assoc();
?>
      <!-- small card -->
      <div class="small-box bg-secondary">
        <div class="inner">
          <h3><?php echo $regalo['pulseras']; ?></h3>

          <p>Pulseras</p>
        </div>
        <div class="icon">
          <i class="fas fa-ring"></i>
        </div>
        <a href="lista-registrados.php" class="small-box-footer">
          Mas informacion <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>


    <div class="col-lg-3 col-6">
      <?php
// Sumar el total de dinero que han pagado ya los usuarios
$sql = 'SELECT COUNT(total_pagado) AS etiquetas FROM registrados WHERE pagado = 2';
$resultado = $conn->query($sql);
$regalo = $resultado->fetch_assoc();
?>
      <!-- small card -->
      <div class="small-box bg-secondary">
        <div class="inner">
          <h3><?php echo $regalo['etiquetas']; ?></h3>

          <p>Etiquetas</p>
        </div>
        <div class="icon">
          <i class="fas fa-sticky-note"></i>
        </div>
        <a href="lista-registrados.php" class="small-box-footer">
          Mas informacion <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <?php
// Sumar el total de dinero que han pagado ya los usuarios
$sql = 'SELECT COUNT(total_pagado) AS plumas FROM registrados WHERE pagado = 3';
$resultado = $conn->query($sql);
$regalo = $resultado->fetch_assoc();
?>
      <!-- small card -->
      <div class="small-box bg-secondary">
        <div class="inner">
          <h3><?php echo $regalo['plumas']; ?></h3>

          <p>Plumas</p>
        </div>
        <div class="icon">
          <i class="fas fa-pen"></i>
        </div>
        <a href="lista-registrados.php" class="small-box-footer">
          Mas informacion <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>


  </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php include_once 'templates/footer.php';?>


</body>
</html>
