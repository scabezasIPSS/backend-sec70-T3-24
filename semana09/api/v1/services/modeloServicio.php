<?php

/*
SELECT id, titulo, titulo_esp, titulo_eng, descripcion, descripcion_esp, descripcion_eng, activo FROM services
CREATE TABLE services (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo TEXT,
    titulo_esp TEXT,
    titulo_eng TEXT,
    descripcion TEXT,
    descripcion_esp TEXT,
    descripcion_eng TEXT,
    activo BOOLEAN NOT NULL DEFAULT FALSE
);
INSERT INTO services (titulo, titulo_esp, titulo_eng, descripcion, descripcion_esp, descripcion_eng, activo) VALUES
(
'["Consultoría digital", "Digital consulting"]', 'Consultoría digital', 'Digital consulting',
'["Identificamos las fallas y conectamos los puntos entre tu negocio y tu estrategia digital. Nuestro equipo experto cuenta con años de experiencia en la definición de estrategias y hojas de ruta en función de tus objetivos específicos.", "We identify failures and connect the dots between your business and your digital strategy. Our expert team has years of experience defining strategies and roadmaps based on your specific objectives."]',
'Identificamos las fallas y conectamos los puntos entre tu negocio y tu estrategia digital. Nuestro equipo experto cuenta con años de experiencia en la definición de estrategias y hojas de ruta en función de tus objetivos específicos.',
'We identify failures and connect the dots between your business and your digital strategy. Our expert team has years of experience defining strategies and roadmaps based on your specific objectives.',
true
);
 */

class Servicio
{
    private $id;
    private $titulo;
    private $titulo_esp;
    private $titulo_eng;
    private $descripcion;
    private $descripcion_esp;
    private $descripcion_eng;
    private $activo;

    public function __construct() {}

    public function getId()
    {
        return intval($this->id);
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getTituloEsp()
    {
        return $this->titulo_esp;
    }
    public function getTituloEng()
    {
        return $this->titulo_eng;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getDescripcionEsp()
    {
        return $this->descripcion_esp;
    }
    public function getDescripcionEng()
    {
        return $this->descripcion_eng;
    }
    public function isActivo() //solo para booleanos
    {
        return $this->activo;
    }
    //mutadores
    public function setId($_n)
    {
        $this->id = $_n;
    }
    public function setTitulo($_n)
    {
        $this->titulo = $_n;
    }
    public function setTituloEsp($_n)
    {
        $this->titulo_esp = $_n;
    }
    public function setTituloEng($_n)
    {
        $this->titulo_eng = $_n;
    }
    public function setDescripcion($_n)
    {
        $this->descripcion = $_n;
    }
    public function setDescripcionEsp($_n)
    {
        $this->descripcion_esp = $_n;
    }
    public function setDescripcionEng($_n)
    {
        $this->descripcion_eng = $_n;
    }
    public function setActivo($_n)
    {
        $this->activo = $_n;
    }

    public function getAll()
    {
        $lista = [];
        $con = new Conexion();
        $query = "SELECT id, titulo, titulo_esp, titulo_eng, descripcion, descripcion_esp, descripcion_eng, activo FROM services;";
        $rs = mysqli_query($con->getConnection(), $query);
        if ($rs) {
            while ($registro = mysqli_fetch_assoc($rs)) {
                $registro['activo'] = $registro['activo'] == 1 ? true : false;

                $tupla = new Servicio();
                $tupla->setId($registro['id']);
                $tupla->setTituloEsp($registro['titulo_esp']);
                $tupla->setTituloEng($registro['titulo_eng']);
                $tupla->setDescripcion($registro['descripcion']);
                $tupla->setDescripcionEsp($registro['descripcion_esp']);
                $tupla->setDescripcionEng($registro['descripcion_eng']);
                $tupla->setActivo($registro['activo']);

                //debemos trabajar con el objeto
                array_push($lista, array(
                    'id' => $tupla->getId(),
                    'titulo' => array(
                        'esp' => $tupla->getTituloEsp(),
                        'eng' => $tupla->getTituloEng(),
                    ),
                    'descripcion' => array(
                        'esp' => $tupla->getDescripcionEsp(),
                        'eng' => $tupla->getDescripcionEng(),
                    ),
                    'activo' => $tupla->isActivo()
                ));
            }
            mysqli_free_result($rs);
        }
        $con->closeConnection();
        return $lista;
    }

    public function add(Servicio $_nuevo)
    {
        $con = new Conexion();
        
        //con opcion 1
        // $query = "INSERT INTO indicador (id, codigo, nombre, unidad_medida_id, valor) VALUES (" . $nuevoId . ", '" . $_nuevo->getCodigo() . "', '" . $_nuevo->getNombre() . "', " . $_nuevo->getUnidadMedidaId() . ", " . $_nuevo->getValor() . ");";
        $query = "INSERT INTO services (titulo_esp, titulo_eng, descripcion_esp, descripcion_eng) VALUES ('" . $_nuevo->getTituloEsp() . "', '". $_nuevo->getTituloEng() ."', '".$_nuevo->getDescripcionEsp()."', '".$_nuevo->getDescripcionEng()."')";
        //con opcion 2
        // $query = "INSERT INTO indicador (id, codigo, nombre, unidad_medida_id, valor) VALUES (" . $_nuevo->getId() . ", '" . $_nuevo->getCodigo() . "', '" . $_nuevo->getNombre() . "', " . $_nuevo->getUnidadMedidaId() . ", " . $_nuevo->getValor() . ");";
        // echo $query;
        $rs = mysqli_query($con->getConnection(), $query);
        $con->closeConnection();
        if ($rs) {
            return true;
        }
        return false;
    }
}
