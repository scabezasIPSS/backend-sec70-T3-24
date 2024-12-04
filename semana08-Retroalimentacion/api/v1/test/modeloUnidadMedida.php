<?php

class UnidadMedida
{
    private $id;
    private $simbolo;
    private $codigo;
    private $nombre_singular;
    private $nombre_plural;
    private $activo;

    public function __construct() {}
    //accesadores
    public function getId()
    {
        return $this->id;
    }
    public function getSimbolo()
    {
        return $this->simbolo;
    }
    public function getCodigo()
    {
        return $this->codigo;
    }
    public function getNombreSingular()
    {
        return $this->nombre_singular;
    }
    public function getNombrePlural()
    {
        return $this->nombre_plural;
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
    public function setSimbolo($_n)
    {
        $this->simbolo = $_n;
    }
    public function setCodigo($_n)
    {
        $this->codigo = $_n;
    }
    public function setNombreSingular($_n)
    {
        $this->nombre_singular = $_n;
    }
    public function setNombrePlural($_n)
    {
        $this->nombre_plural = $_n;
    }
    public function setActivo($_n)
    {
        $this->activo = $_n;
    }
}
