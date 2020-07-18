<!-- Los valores que asignamos de post es por el name del imput -->
<?php if (isset($_POST['submit'])):
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$email=$_POST["email"];
$regalo=$_POST["regalo"];
$total=$_POST['total_pedido'];
$fecha= date('Y-m-d H:i:s');
// Como eventos y pedidos son variables que almacenan la informacion dentro de un array, que esta dentro de otro toca trabajar con jsons
// Pedidos
$boletos=$_POST["boletos"];
$camisas=$_POST["pedido_camisa"];
$etiquetas=$_POST["pedido_etiquetas"];
include_once 'includes/funciones/funciones.php';
$pedido = productos_json($boletos, $camisas, $etiquetas);
//Eventos
$eventos = $_POST["registro"];
$registro=eventos_json($eventos);

try {
    require_once('includes/funciones/bd_conexion.php'); //Crear coneccion
    $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES (?,?,?,?,?,?,?,?)"); //Llamando Campos para insertar valores en base de datos
    $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total);//Insertar variables en la base de datos
    $stmt->execute(); //Ejecuta el statemen
    $stmt->close(); //Cierra el statemen
    $conn->close(); //Cierra la coneccion
    header('Location: validar_registro.php?exitoso=1'); //Evita que se envien de nuevo los datos al recargar la pagina, toca colocar todo el codigo arriba del header
} catch (\Throwable $th) {
    echo $th->getMessage();
}
?>
<?php endif;?>
<?php include_once 'includes/templates/header.php';?>

    <section class="seccion contenedor">
        <h2>Resumen de registro</h2>

        <?php if (isset($_GET["exitoso"])) {
            if ($_GET["exitoso"] == 1) {
                echo "Registro exitoso";
            }
        }?>        
            
        

    </section>

<?php include_once 'includes/templates/footer.php';?>