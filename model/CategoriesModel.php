<?php

require_once("../library/conexion.php");

class CategoriesModel
{
    private $conexion;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function registrar($nombre, $detalle)
    {
        $consulta = "INSERT INTO categoria (nombre, detalle) VALUES ('$nombre', '$detalle')";
        $sql = $this->conexion->query($consulta);
        if ($sql) {
            return $this->conexion->insert_id;
        } else {
            return 0;
        }
    }

    public function existeCategoria($nombre)
    {
        $consulta = "SELECT * FROM categoria WHERE nombre = '$nombre'";
        $sql = $this->conexion->query($consulta);
        return $sql->num_rows;
    }
}