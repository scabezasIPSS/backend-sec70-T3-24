<?php

$_method = $_SERVER['REQUEST_METHOD'];
$_host = $_SERVER['HTTP_HOST'];
$_uri = $_SERVER['REQUEST_URI'];
$_partes = explode('/', $_uri);

//configuración de headers
header("Access-Control-Allow-Origin: *"); // restriccion de acceso desde otros servidores
header("Access-Control-ALlow-Methods: GET, POST"); // metodos permitidos: GET: para obtener y POST para agregar uno nuevo
header("Content-Type: application/json; charset=UTF-8");

//Configuración de Authorization
$_authorization = null;
try {
    if (isset(getallheaders()['Authorization'])) {
        $_authorization = getallheaders()['Authorization'];
        // echo 'tenemos una autorizacion';
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'No tiene autorizacion']);
    }
} catch (Exception $e) {
    echo 'error';
}

$_token_get = 'Bearer ipss';
$_token_post = 'Bearer ipss2024T3s70';