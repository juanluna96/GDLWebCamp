<?php
error_reporting(E_ALL ^ E_NOTICE);

if ($_POST['registro'] == 'nuevo') {

    $titulo = $_POST['titulo_evento'];
    $categoria_id = $_POST['categoria_evento'];
    $invitado_id = $_POST['invitado'];
    // Obtener la fecha
    $fecha = $_POST["fecha_evento"];
    $fecha_formateada = date('Y-m-d', strtotime($fecha));
    // Hora
    $hora = $_POST['hora_evento'];
    $hora_formateada = date('H:i', strtotime($hora));
    // ID_registro
    $id_registro = $_POST["id_registro"];

    try {
        include_once 'funciones/funciones.php';
        $stmt = $conn->prepare('INSERT INTO eventos (nombre_evento, fecha_evento, hora_evento, id_cat_evento, id_inv) VALUES (?,?,?,?,?)');
        $stmt->bind_param('sssii', $titulo, $fecha_formateada, $hora_formateada, $categoria_id, $invitado_id);
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if ($stmt->affected_rows) {
            $respuesta = array('respuesta' => 'exito_evento', 'id_insertado' => $id_insertado);
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
    $titulo = $_POST['titulo_evento'];
    $categoria_id = $_POST['categoria_evento'];
    $invitado_id = $_POST['invitado'];
    // Obtener la fecha
    $fecha = $_POST["fecha_evento"];
    $fecha_formateada = date('Y-m-d', strtotime($fecha));
    // Hora
    $hora = $_POST['hora_evento'];
    $hora_formateada = date('H:i', strtotime($hora));
    // ID_registro
    $id_registro = $_POST["id_registro"];

    try {
        include_once 'funciones/funciones.php';
        $stmt = $conn->prepare('UPDATE eventos SET nombre_evento = ?,fecha_evento=?,hora_evento=?,id_cat_evento=?,id_inv=?, editado=NOW() WHERE evento_id=?');
        $stmt->bind_param('sssiii', $titulo, $fecha_formateada, $hora_formateada, $categoria_id, $invitado_id, $id_registro);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array('respuesta' => 'exito_evento_actualizado', 'id_actualizado' => $id_registro);
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
        $stmt = $conn->prepare("DELETE FROM eventos WHERE evento_id = ?");
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
