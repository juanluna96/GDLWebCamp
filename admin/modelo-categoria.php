<?php
error_reporting(E_ALL ^ E_NOTICE);

if ($_POST['registro'] == 'nuevo') {
    $nombre_categoria = $_POST["nombre_categoria"];
    $icono = $_POST["icono"];

    try {
        include_once 'funciones/funciones.php';
        $stmt = $conn->prepare('INSERT INTO categoria_evento(cat_evento,icono) VALUES (?,?)');
        $stmt->bind_param('ss', $nombre_categoria, $icono);
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if ($stmt->affected_rows) {
            $respuesta = array('respuesta' => 'exito_categoria', 'id_insertado' => $id_insertado);
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

    $nombre_categoria = $_POST["nombre_categoria"];
    $icono = $_POST["icono"];
    // ID_registro
    $id_registro = $_POST["id_registro"];

    try {
        include_once 'funciones/funciones.php';
        $stmt = $conn->prepare('UPDATE categoria_evento SET cat_evento = ?,icono=?, editado=NOW() WHERE id_categoria=?');
        $stmt->bind_param('ssi', $nombre_categoria, $icono, $id_registro);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array('respuesta' => 'exito_categoria_actualizado', 'id_actualizado' => $id_registro);
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
        $stmt = $conn->prepare("DELETE FROM categoria_evento WHERE id_categoria=?");
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
