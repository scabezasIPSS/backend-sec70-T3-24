<?php
include_once '../version1.php';

switch ($_method) {
    case 'GET':
        if ($_authorization === $_token_get) {
            $lista = [];
            //llamamos al archivo que contiene la clase conexion
            include_once '../conexion.php';
            include_once 'modeloIndicador.php';
            include_once 'modeloUnidadMedida.php';
            //se realiza la instancia al modelo Indicador
            $modelo = new Indicador();
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
            include_once 'modeloIndicador.php';
            include_once 'modeloUnidadMedida.php';
            //se realiza la instancia al modelo Indicador
            $modelo = new Indicador();
            //se recuperan los datos RAW del body en formato JSON
            $body = json_decode(file_get_contents("php://input", true)); // json_decode -> transforma un JSON a un Objeto standar para trabajar
            // print_r($body->codigo);
            // print_r($body->nombre);
            $modelo->setCodigo($body->codigo);
            $modelo->setNombre($body->nombre);
            $modelo->setUnidadMedidaId($body->unidad_medida_id);
            $modelo->setValor($body->valor);
            // print_r($modelo);
            //agrega el nuevo valor
            $respuesta = $modelo->add($modelo);
            if ($respuesta) {
                http_response_code(201);
                echo json_encode(['Creado' => 'Sin errores']);
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
