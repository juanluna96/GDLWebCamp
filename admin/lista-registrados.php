<?php
error_reporting(E_ALL ^ E_NOTICE);
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
            <h1>Lista de personas registradas</h1>
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
              <h3 class="card-title">Maneja los asistentes registrados</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Fecha de registro</th>
                  <th>Articulos</th>
                  <th>Talleres</th>
                  <th>Regalo</th>
                  <th>Compra</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>

                  <?php
try {
    $sql = "SELECT registrados.*,regalos.nombre_regalo FROM registrados ";
    $sql .= "JOIN regalos ";
    $sql .= "ON registrados.regalo = regalos.ID_regalo";
    $resultado = $conn->query($sql);

} catch (Esception $e) {
    echo $error;
}
while ($registrados = $resultado->fetch_assoc()) {
    ?>

    <tr>
      <td>
        <?php echo $registrados['nombre_registrado'] . " " . $registrados['apellido_registrado']; ?>

<?php
$pagado = $registrados['pagado'];
    if ($pagado) {
        echo "<span class='badge bg-success'>Pagado</span>";
    } else {
        echo "<span class='badge bg-red'>No pagado</span>";
    }
    ?>

      </td>
      <td><?php echo $registrados['email_registrado']; ?></td>
      <td><?php echo $registrados['fecha_registro']; ?></td>

      <td>
<?php
$articulos = json_decode($registrados['pases_articulos'], true);
    $arreglo_articulos = array(
        'un_dia' => "Pase de un dia",
        'pase_2dias' => "Pase(s) de 2 dias",
        'pase_completo' => 'Pase completo',
        'camisas' => "Camisas",
        'etiquetas' => "Etiquetas");

    foreach ($articulos as $key => $articulo) {
        if (is_array($articulo) && array_key_exists('cantidad', $articulo)) {
            echo $articulo['cantidad'] . " " . $arreglo_articulos[$key] . "<br>";
        } else {
            echo $articulo . " " . $arreglo_articulos[$key] . "<br>";
        }

    }
    ?>
      </td>

      <td>
<?php
// Imprimir registros de un sql de una tabla externa cuando es un json
    $eventos_resultado = $registrados['talleres_registrados'];
    $talleres = json_decode($eventos_resultado, true);
    $talleres = implode("', '", $talleres["eventos"]);
    $sql_talleres = "SELECT nombre_evento, fecha_evento, hora_evento FROM eventos WHERE clave IN ('$talleres') OR evento_id IN ('$talleres')";

    $resultado_talleres = $conn->query($sql_talleres);

    while ($eventos = $resultado_talleres->fetch_assoc()) {
        echo $eventos["nombre_evento"] . " " . $eventos["fecha_evento"] . " " . $eventos["hora_evento"] . '<br>';
    }
    ?>
      </td>

      <td><?php echo $registrados['nombre_regalo']; ?></td>
      <td>$<?php echo $registrados['total_pagado']; ?> USD</td>
      <td>
        <a href="editar-registrado.php?id=<?php echo $registrados['ID_Registrado']; ?>" class='btn bg-orange btn-flat m-1'>
          <i class="fa fa-pencil-alt text-light"></i>
        </a>
        <a href="#" data-id="<?php echo $registrados['ID_Registrado']; ?>" data-tipo='registrado' class='btn bg-maroon btn-flat borrar_registro m-1'>
          <i class="fa fa-trash"></i>
        </a>

      </td>
    </tr>

<?php }?>

                </tbody>
                <tfoot>
                <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Fecha de registro</th>
                  <th>Articulos</th>
                  <th>Talleres</th>
                  <th>Regalo</th>
                  <th>Compra</th>
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
