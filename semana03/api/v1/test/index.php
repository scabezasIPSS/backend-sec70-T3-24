<?php

include_once '../version1.php';

switch ($_method) {
    case 'GET':
        if ($_authorization === 'Bearer ipss') {
            $data = array(
                array(
                    'id' => 1,
                    //atributos
                    'codigo' => 'uf',
                    'nombre' => 'Unidad de Fomento (UF)',
                    'unidad_medida' => 'Pesos',
                    'valor' => 37968.98,
                    'activo' => true
                ),
                array(
                    'id' => 2,
                    //atributos
                    'codigo' => 'ivp',
                    'nombre' => 'Indice de Valor Promedio (IVP)',
                    'unidad_medida' => 'Pesos',
                    'valor' => 39443.16,
                    'activo' => true
                ),
                array(
                    'id' => 3,
                    //atributos
                    'codigo' => 'dolar',
                    'nombre' => 'Dolar Observado',
                    'unidad_medida' => 'Pesos',
                    'valor' => 945.88,
                    'activo' => true
                ),
            );
            http_response_code(200);
            echo json_encode(['data' => $data]);
        } else {
            http_response_code(403);
            echo json_encode(['error' => 'Prohibido']);
        }
        break;
    default:
        http_response_code(501);
        echo json_encode(['error' => 'No implementado']);
        break;
}
