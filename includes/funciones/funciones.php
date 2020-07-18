<?php
function productos_json(&$boletos, &$camisas = 0, &$etiquetas = 0)
{
    $dias = array(0 => 'un_dia', 1 => 'pase_completo', 2 => 'pase_2dias');

    unset($boletos['un_dia']['precio']);
    unset($boletos['completo']['precio']);
    unset($boletos['2dias']['precio']);

    $total_boletos = array_combine($dias, $boletos);

    $camisas = (int) $camisas;
    // Almacentar los valores de camisa otro array (JSON) para que no valga cuando los valores del pase sean 0
    if ($camisas > 0) {
        $total_boletos['camisas'] = $camisas;
    }

    $etiquetas = (int) $etiquetas;
    // Almacentar los valores de etiqueta otro array (JSON) para que no valga cuando los valores del pase sean 0
    if ($etiquetas > 0) {
        $json['etiquetas'] = $etiquetas;
    }

    return (json_encode($total_boletos)); //Json-enconde devuelve un json formateado
}

function eventos_json(&$eventos)
{
    $eventos_json = [];

    foreach ($eventos as $evento) {
        $eventos_json['eventos'][] = $evento;
    }

    return json_encode($eventos_json);
}
