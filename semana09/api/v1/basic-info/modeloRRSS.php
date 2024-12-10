<?php

/*
CREATE TABLE rrss (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre TEXT,
    icono TEXT,
    link TEXT,
    activo BOOLEAN NOT NULL DEFAULT FALSE
);

INSERT INTO rrss (nombre, icono, link, activo) VALUES
('fb', 'fa fa-facebook', '#', true);
 */

class RRSS
{
    private $rrss;
    private $icono;
    private $link;
    private $activo;

    public function __construct() {}

    public function getRRSS()
    {
        return $this->rrss;
    }
    public function getIcono()
    {
        return $this->icono;
    }
    public function getLink()
    {
        return $this->link;
    }
    public function isActivo() //solo para booleanos
    {
        return $this->activo;
    }

    public function setRRSS($_n)
    {
        $this->rrss = $_n;
    }
    public function setIcono($_n)
    {
        $this->icono = $_n;
    }
    public function setLink($_n)
    {
        $this->link = $_n;
    }
    public function setActivo($_n)
    {
        $this->activo = $_n;
    }

    public function getAll()
    {
        $lista = [];
        $con = new Conexion();
        $query = "SELECT nombre, icono, link, activo FROM rrss;";
        $rs = mysqli_query($con->getConnection(), $query);
        if ($rs) {
            while ($registro = mysqli_fetch_assoc($rs)) {
                $registro['activo'] = $registro['activo'] == 1 ? true : false;

                $tupla = new RRSS();
                $tupla->setRRSS($registro['nombre']);
                $tupla->setIcono($registro['icono']);
                $tupla->setLink($registro['link']);
                $tupla->setActivo($registro['activo']);

                //debemos trabajar con el objeto
                array_push($lista, array(
                    "rrss" => $tupla->getRRSS(),
                    "icono" => $tupla->getIcono(),
                    "link" => $tupla->getLink(),
                    "activo" => $tupla->isActivo()
                ));
            }
            mysqli_free_result($rs);
        }
        $con->closeConnection();
        return $lista;
    }

    public function add(RRSS $_nuevo)
    {
        $con = new Conexion();
        
        //con opcion 1
        // $query = "INSERT INTO indicador (id, codigo, nombre, unidad_medida_id, valor) VALUES (" . $nuevoId . ", '" . $_nuevo->getCodigo() . "', '" . $_nuevo->getNombre() . "', " . $_nuevo->getUnidadMedidaId() . ", " . $_nuevo->getValor() . ");";
        $query = "INSERT INTO rrss (nombre, icono, link) VALUES ('" . $_nuevo->getRRSS() . "', '". $_nuevo->getIcono() ."', '".$_nuevo->getLink()."')";
        // echo $query;
        $rs = mysqli_query($con->getConnection(), $query);
        $con->closeConnection();
        if ($rs) {
            return true;
        }
        return false;
    }
}
