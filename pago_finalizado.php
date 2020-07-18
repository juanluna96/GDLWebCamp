
<?php include_once 'includes/templates/header.php';

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Rest\ApiContext;

require 'includes/paypal.php';
?>

<section class="seccion contenedor">
    <h2>Resumen del registro</h2>

<?php

$id_pago = $_GET["id_pago"];
$paymentID = $_GET["paymentId"];
// Peticion a REST API
$pago = Payment::get($paymentID, $apiContext);
$execution = new PaymentExecution();
$execution->setPayerId($_GET["PayerID"]);

// Resultado tiene la informacion de la transaccion
$resultado = $pago->execute($execution, $apiContext);

$respuesta = $resultado->transactions[0]->related_resources[0]->sale->state;

// var_dump($respuesta);

if ($respuesta == 'completed') {

    echo "<div class='resultado correcto'>";
    echo "El pago se realizo correctamente <br/>";
    echo "El ID de la transaccion es: {$paymentID}";
    echo "</div>";
    require_once 'includes/funciones/bd_conexion.php';

    $stmt = $conn->prepare('UPDATE registrados SET pagado = ? WHERE ID_registrado = ?');
    $pagado = 1;
    $stmt->bind_param('ii', $pagado, $id_pago);

    $stmt->execute();
    $stmt->close();
    //Cierra el statemen
    $conn->close();
    //Cierra la coneccion
} else {
    echo "<div class='resultado error'>";
    echo "El pago no se realizo";
    echo "</div>";
}?>



</section>

<?php include_once 'includes/templates/footer.php';?>