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
}
