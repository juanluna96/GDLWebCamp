<?php

error_reporting(E_ALL ^ E_NOTICE);

if ($_POST['registro'] == 'nuevo') {
    include_once 'funciones/funciones.php';
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];

    // BOLETOS
    $boletos_adquiridos = $_POST["boletos"];
    // Camisas y etiquetas
    $camisas = $_POST["pedido_extra"]['camisas']['cantidad'];
    $etiquetas = $_POST["pedido_extra"]['etiquetas']['cantidad'];

    $total = $_POST["total_pedido"];
    $regalo = $_POST["regalo"];
    $eventos = $_POST["registro_evento"];

    // Pasar de array compuesto a json
    $registro_eventos = eventos_json($eventos);

    // Pasar de array compuesto a json
    $pedido = productos_json($boletos_adquiridos, $camisas, $etiquetas);
    $respuesta = array('boletos' => $pedido);

    $nombre_categoria = $_POST["nombre_categoria"];
    $icono = $_POST["icono"];

    try {
        $stmt = $conn->prepare('INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados,regalo,total_pagado,pagado) VALUES (?,?,?,NOW(),?,?,?,?,1)');
        $stmt->bind_param('sssssis', $nombre, $apellido, $email, $pedido, $registro_eventos, $regalo, $total);
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if ($stmt->affected_rows) {
            $respuesta = array('respuesta' => 'exito_registrado', 'id_insertado' => $id_insertado);
        } else {
            $respuesta = array('respuesta' => 'error');
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array('respuesta' => $e->getMessage());
    }

    die(json_encode($respuesta));
}

if ($_POST['registro'] == 'actualizar') {
    include_once 'funciones/funciones.php';
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    // BOLETOS
    $boletos_adquiridos = $_POST['boletos'];
    // camisas y etiquetas
    $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
    $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
    $pedido = productos_json($boletos_adquiridos, $camisas, $etiquetas);
    $total = $_POST['total_pedido'];
    $regalo = $_POST['regalo'];
    $eventos = $_POST['registro_evento'];
    $registro_eventos = eventos_json($eventos);
    $fecha_registro = $_POST['fecha_registro'];
    $id_registro = $_POST['id_registro'];
    try {
        $stmt = $conn->prepare('INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado, pagado ) VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, 1 ) ');
        $stmt->bind_param("sssssis", $nombre, $apellido, $email, $pedido, $registro_eventos, $regalo, $total);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array('respuesta' => 'exito_registrado_actualizado', 'id_actualizado' => $id_registro);
        } else {
            $respuesta = array('respuesta' => 'error');
        }
        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        $respuesta = array('respuesta' => $e->getMessage());
    }

    die(json_encode($respuesta));
}

if ($_POST["registro"] == 'eliminar') {
    $id_borrar = $_POST["id"];

    try {
        include_once 'funciones/funciones.php';
        $stmt = $conn->prepare("DELETE FROM registrados WHERE  ID_Registrado=?");
        $stmt->bind_param('i', $id_borrar);
        $stmt->execute();

        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar,
            );

        } else {
            $respuesta = array(
                'respuesta' => 'error',
            );
        }
        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    die(json_encode($respuesta));

}
