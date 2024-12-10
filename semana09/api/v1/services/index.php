<?php

include_once '../version1.php';

switch ($_method) {
    case 'GET':
        if ($_authorization === 'Bearer ciisa') {
            $lista = [];
            //llamamos al archivo que contiene la clase conexion
            include_once '../conexion.php';
            include_once 'modeloServicio.php';
            //se realiza la instancia al modelo
            $modelo = new Servicio();
            $lista = $modelo->getAll();
            http_response_code(200);
            echo json_encode(['data' => $lista]);
        } else {
            http_response_code(403);
            echo json_encode(['error' => 'Prohibido']);
        }
        break;
    case 'POST':
        if ($_authorization === $_token_post) {
            include_once '../conexion.php';
            include_once 'modeloServicio.php';
            //se realiza la instancia al modelo Indicador
            $modelo = new Servicio();
            //se recuperan los datos RAW del body en formato JSON
            $body = json_decode(file_get_contents("php://input", true)); // json_decode -> transforma un JSON a un Objeto standar para trabajar
            //revisamos que podemos obtener el contenido del body
            // print_r($body);
            // print_r($body->titulo->esp);
            // print_r($body->descripcion->esp);

            //asignar usando el modelo del objeto
            $modelo->setTituloEsp($body->titulo->esp);
            $modelo->setTituloEng($body->titulo->eng);
            $modelo->setDescripcionEsp($body->descripcion->esp);
            $modelo->setDescripcionEng($body->descripcion->eng);
            //revisamos que tenemos los datos bien seteados en el modelo
            // print_r($modelo);
            //agrega el nuevo valor
            $respuesta = $modelo->add($modelo);
            if ($respuesta) {
                http_response_code(201);
                echo json_encode(['Creado' => 'Sin errores']);
            } else {
                http_response_code(403);
                echo json_encode(['error' => 'No se logro insertar']);
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
