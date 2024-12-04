<?php

include_once '../version1.php';

switch ($_method) {
    case 'GET':
        if ($_authorization === 'Bearer ipss') {
            $lista = [];
            //llamamos al archivo que contiene la clase conexion
            include_once '../conexion.php';
            include_once 'modeloIndicador.php';
            include_once 'modeloUnidadMedida.php';
            //se realiza la instancia
            $modelo = new Indicador();
            $lista = $modelo->getAll();

            http_response_code(200);
            echo json_encode(['data' => $lista]);

            // $data = array(
            //     array(
            //         'id' => 1,
            //         //atributos
            //         'codigo' => 'uf',
            //         'nombre' => 'Unidad de Fomento (UF)',
            //         'unidad_medida' => 'Pesos',
            //         'valor' => 37968.98,
            //         'activo' => true
            //     ),
            //     array(
            //         'id' => 2,
            //         //atributos
            //         'codigo' => 'ivp',
            //         'nombre' => 'Indice de Valor Promedio (IVP)',
            //         'unidad_medida' => 'Pesos',
            //         'valor' => 39443.16,
            //         'activo' => true
            //     ),
            //     array(
            //         'id' => 3,
            //         //atributos
            //         'codigo' => 'dolar',
            //         'nombre' => 'Dolar Observado',
            //         'unidad_medida' => 'Pesos',
            //         'valor' => 945.88,
            //         'activo' => true
            //     ),
            // );
            // echo json_encode(['data' => $data]);
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
