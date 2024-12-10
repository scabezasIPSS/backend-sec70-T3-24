<?php

class Indicador
{
    private $id;
    private $codigo;
    private $nombre;
    private $unidad_medida_id;
    private $valor;
    private $activo;

    public function __construct() {}
    //accesadores
    public function getId()
    {
        return $this->id;
    }
    public function getCodigo()
    {
        return $this->codigo;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getUnidadMedidaId()
    {
        return $this->unidad_medida_id;
    }
    public function getValor()
    {
        return $this->valor;
    }
    public function getActivo()
    {
        return $this->activo;
    }
    //mutadores
    public function setId($_n)
    {
        $this->id = $_n;
    }
    public function setCodigo($_n)
    {
        $this->codigo = $_n;
    }
    public function setNombre($_n)
    {
        $this->nombre = $_n;
    }
    public function setUnidadMedidaId($_n)
    {
        $this->unidad_medida_id = $_n;
    }
    public function setValor($_n)
    {
        $this->valor = $_n;
    }
    public function setActivo($_n)
    {
        $this->activo = $_n;
    }

    public function getAll()
    {
        $lista = [];
        $con = new Conexion();
        $query = "SELECT id, codigo, nombre, unidad_medida_id, valor, activo FROM indicador;";
        $rs = mysqli_query($con->getConnection(), $query);
        if ($rs) {
            while ($registro = mysqli_fetch_assoc($rs)) {
                $registro['activo'] = $registro['activo'] == 1 ? true : false;
                //debemos trabajar con el objeto
                array_push($lista, $registro);
            }
            mysqli_free_result($rs);
        }
        $con->closeConnection();
        return $lista;
    }

    public function add(Indicador $_nuevo)
    {
        $con = new Conexion();
        // SELECT COUNT(*)+1 FROM indicador;
        //Necesito saber la cantidad de elementos que tiene la tabla. Los elementos los puedo obtener usando la funcion getAll llamando al "length en php se llama count para arreglos + 1".
        $nuevoId = count($this->getAll()) + 1; //opcion 1
        // $_nuevo->setId(count($this->getAll()) + 1);//opcion 2

        //con opcion 1
        $query = "INSERT INTO indicador (id, codigo, nombre, unidad_medida_id, valor) VALUES (" . $nuevoId . ", '" . $_nuevo->getCodigo() . "', '" . $_nuevo->getNombre() . "', " . $_nuevo->getUnidadMedidaId() . ", " . $_nuevo->getValor() . ");";
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

    public function enable(Indicador $_registro)
    {
        $con = new Conexion();
        // Query para habilitar
        $query = "UPDATE indicador SET activo = true WHERE id = " . $_registro->getId();
        // echo $query;
        $rs = mysqli_query($con->getConnection(), $query);
        $con->closeConnection();
        if ($rs) {
            return true;
        }
        return false;
    }

    public function disable(Indicador $_registro)
    {
        $con = new Conexion();
        // Query para habilitar
        $query = "UPDATE indicador SET activo = false WHERE id = " . $_registro->getId();
        // echo $query;
        $rs = mysqli_query($con->getConnection(), $query);
        $con->closeConnection();
        if ($rs) {
            return true;
        }
        return false;
    }

    public function update(Indicador $_registro)
    {
        $con = new Conexion();
        // Query para habilitar
        $query = "UPDATE indicador SET codigo = '" . $_registro->getCodigo() . "', nombre = '". $_registro->getNombre()."', valor = ".$_registro->getValor()." WHERE id = " . $_registro->getId();
        // echo $query;
        $rs = mysqli_query($con->getConnection(), $query);
        $con->closeConnection();
        if ($rs) {
            return true;
        }
        return false;
    }
}
