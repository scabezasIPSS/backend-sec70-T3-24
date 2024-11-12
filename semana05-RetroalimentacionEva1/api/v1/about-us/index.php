<?php

include_once '../version1.php';

switch ($_method) {
    case 'GET':
        if ($_authorization === 'Bearer ciisa') {
            $data = array(
                array(
                    //atributos
                    'titulo' => array(
                        'esp' => 'Misión',
                        'eng' => 'Mission'
                    ),
                    'descripcion' => array(
                        'esp' => 'Nuestra misión es ofrecer soluciones digitales innovadoras y de alta calidad que impulsen el éxito de nuestros clientes, ayudándolos a alcanzar sus objetivos empresariales a través de la tecnología y la creatividad.',
                        'eng' => "Our mission is to deliver high-quality, innovative digital solutions that drive our clients' success, helping them achieve their business goals through technology and creativity."
                    )
                ),
                array(
                    //atributos
                    'titulo' => array(
                        'esp' => 'Visión',
                        'eng' => 'Vision'
                    ),
                    'descripcion' => array(
                        'esp' => 'Nos visualizamos como líderes en el campo de la consultoría y desarrollo de software, reconocidos por nuestra excelencia en el servicio al cliente, nuestra capacidad para adaptarnos a las necesidades cambiantes del mercado y nuestra contribución al crecimiento y la transformación digital de las empresas.',
                        'eng' => "We see ourselves as leaders in the field of software consulting and development, recognized for our excellence in customer service, our ability to adapt to changing market needs and our contribution to the growth and digital transformation of companies."
                    )
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
