<?php include_once 'includes/templates/header.php';?>

    <section class="seccion contenedor">
        <h2>Calendario de eventos</h2>

        <?php try {
            require_once('includes/funciones/bd_conexion.php'); //Crear coneccion
            $sql="SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
            $sql .= "FROM eventos "; //Concatenar - continuar
            $sql .= "INNER JOIN categoria_evento "; //Unir a la tabla categoria evento
            $sql .= "ON eventos.id_cat_evento = categoria_evento.id_categoria ";//igualar id_cat_evento a id_categoria de la tabla categoria evento
            $sql .= "INNER JOIN invitados "; //Unir a la tabla invitados
            $sql .= "ON eventos.id_inv = invitados.invitado_id ";//igualar id_inv a invitado_id de la tabla invitados
            $sql .= "ORDER BY evento_id"; //Ordenar por ids
            $resultado=$conn->query($sql);
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }?>

        <div class="calendario">
            <?php 
            $calendario = array(); //Formatear arrays permite agrupar segun campos de las bases de datos
            while ($eventos = $resultado->fetch_assoc()) { //fetch_assoc imprime el primer resultado, con el while se imprimen todos
                // Obtener fecha evento
                
                $fecha=$eventos['fecha_evento'];
                $categoria=$eventos['cat_evento'];
                
                $evento = array(
                    'titulo' => $eventos['nombre_evento'],
                    'fecha' => $eventos['fecha_evento'],
                    'hora' => $eventos['hora_evento'],
                    'categoria' => $eventos['cat_evento'],
                    'icono' => 'fa' . ' ' . $eventos['icono'],
                    'invitado' => $eventos['nombre_invitado'].' '.$eventos['apellido_invitado']
                );

                $calendario[$fecha][]=$evento;
            }
            
            ?>

            <?php 
            // Imprime todos los eventos

            foreach ($calendario as $dia => $lista_eventos) {
                //Unix (Cambiar a español la fecha)
                setlocale(LC_TIME, 'es_ES.UTF-8');
                //Windos (Cambiar a español la fecha)
                echo "<h3>" .'<i class="far fa-calendar-alt"></i> ' . strftime("%A, %d de %B del %Y", strtotime($dia)) . '</h3>'; //Mostrar fecha en ingles con date(Y j, Y", strtotime($dia))
                foreach ($lista_eventos as $evento) {
                    echo '<div class="dia">';

                        echo '<p class="titulo">' . $evento{'titulo'} . '</p>';
                        echo '<p class="hora"><i class="fa fa-clock o" aria-hidden="true"></i> ' . $evento['fecha'] . ' - '  . $evento['hora'] . '</p>';
                        echo '<p>' . '<i class="'. $evento['icono'] . '" aria-hidden="true"></i> ' . $evento{'categoria'} . '</p>';
                        echo '<p><i class="fas fa-user-tie" aria-hidden="true"></i> ' . $evento['invitado'] . '</p>';

                    echo '</div>';
                }//Foreach eventos
            } //Foreach dias
            ?>

            <?php $conn->close();?> <!--Cerrar coneccion -->
        </div>

    </section>
    <?php include_once 'includes/templates/footer.php';?>