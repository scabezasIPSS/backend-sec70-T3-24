<?php

include_once '../version1.php';

switch ($_method) {
    case 'GET':
        // echo 'es un get';
        if ($_authorization === 'Bearer ciisa') {
            $lista = [];
            //llamamos al archivo que contiene la clase conexion
            include_once '../conexion.php';
            include_once 'modeloRRSS.php';
            //se realiza la instancia al modelo
            $modeloRRSS = new RRSS();
            $listaRRSS = $modeloRRSS->getAll();
            http_response_code(200);
            echo json_encode(['data' => array(
                "tipo" => "rrss",
                "items" => $listaRRSS
            )]);
        } else {
            http_response_code(403);
            echo json_encode(['error' => 'Prohibido']);
        }
        break;
    case 'POST':
        // echo 'es un post';
        if ($_authorization === $_token_post) {
            include_once '../conexion.php';
            //se recuperan los datos RAW del body en formato JSON
            $body = json_decode(file_get_contents("php://input", true)); // json_decode -> transforma un JSON a un Objeto standar para trabajar
            //revisamos que podemos obtener el contenido del body
            // print_r($body);

            //si es rrss, entonces trabaja con lo siguiente
            if ($body->tipo == 'rrss') {
                //se realiza la instancia al modelo Indicador
                include_once 'modeloRRSS.php';
                $modeloRRSS = new RRSS();
                // print_r($body->datos->rrss);
                // print_r($body->datos->icono);
                // asignar usando el modelo del objeto
                $modeloRRSS->setRRSS($body->datos->rrss);
                $modeloRRSS->setIcono($body->datos->icono);
                $modeloRRSS->setLink($body->datos->link);
                //revisamos que tenemos los datos bien seteados en el modelo
                // print_r($modeloRRSS);
                //agrega el nuevo valor
                $respuestaRRSS = $modeloRRSS->add($modeloRRSS);
                if ($respuestaRRSS) {
                    http_response_code(201);
                    echo json_encode(['Creado' => 'Sin errores']);
                } else {
                    http_response_code(403);
                    echo json_encode(['error' => 'No se logro insertar']);
                }
            }
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
