<?php

class Conexion
{
    private $connection;
    private $host;
    private $username;
    private $password;
    private $db;
    private $port;
    private $server;

    public function __construct()
    {
        $this->server = $_SERVER['SERVER_NAME'];
        $this->connection = null;
        $this->port = 3306; //puerto por default de mysql
        $this->db = 'clinicat1_ipss_backend_t3_s70';
        $this->username = 'clinicat1_ipss_backend_t3_s70';
        $this->password = '1pss_b4ck3nd';

        /*
        SQL: Crear la bd y la tabla

        -- Crear la base de datos
        CREATE DATABASE `clinicat1_ipss_backend_t3_s70`;

        -- Crear el usuario y asignarle una contraseña
        CREATE USER 'clinicat1_ipss_backend_t3_s70'@'localhost' IDENTIFIED BY '1pss_b4ck3nd';

        -- Asignar privilegios al usuario para la base de datos específica
        GRANT ALL PRIVILEGES ON `clinicat1_ipss_backend_t3_s70`.* TO 'clinicat1_ipss_backend_t3_s70'@'localhost';

        -- Aplicar los cambios de privilegios
        FLUSH PRIVILEGES;

        --
        -- Nos conectamos con el usuario recien creado.
        --

        -- Indicamos que se va a utilizar esta base de datos
        use clinicat1_ipss_backend_t3_s70;

        CREATE TABLE unidad_medida(
            id INT PRIMARY KEY,
            simbolo VARCHAR(5) NOT NULL,
            codigo VARCHAR(5) NOT NULL UNIQUE,
            nombre_singular VARCHAR(50) NOT NULL,
            nombre_plural VARCHAR(50) NOT NULL,
            activo BOOLEAN NOT NULL DEFAULT FALSE
        );

        INSERT INTO unidad_medida (id, simbolo, codigo, nombre_singular, nombre_plural, activo) VALUES (1, '$', 'CLP', 'Peso', 'Pesos', TRUE);

        CREATE TABLE indicador(
            id INT PRIMARY KEY,
            codigo VARCHAR(10) NOT NULL UNIQUE,
            nombre VARCHAR(50) NOT NULL UNIQUE,
            unidad_medida_id INT NOT NULL,
            valor  DECIMAL(7,2),
            activo BOOLEAN NOT NULL DEFAULT FALSE
        );

        INSERT INTO indicador (id, codigo, nombre, unidad_medida_id, valor, activo) VALUES
        (1, 'UF', 'Unidad de Fomento', 1, 37968.98, TRUE),
        (2, 'IVP', 'Indice de Valor Promedio', 1, 39443.16, TRUE),
        (3, 'dolar', 'Dolar Observado', 1, 945.87, TRUE);
         */
    }

    public function getConnection()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        mysqli_set_charset($this->connection, 'utf8');
        if (!$this->connection) {
            echo 'Error: '.mysqli_connect_errno();
            return mysqli_connect_errno();
        }
        return $this->connection;
    }

    public function closeConnection()
    {
        mysqli_close($this->connection);
    }
}
