<?php
require_once("../library/conexion.php");

class ProductsModel {
    private $conexion;
    function __construct(){
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }

    public function registrar($codigo,$nombre,$detalle,$precio,$stock,$fecha_vencimiento,$imagen){
        $consulta = "INSERT INTO producto (codigo,nombre,detalle,precio,stock,fecha_vencimiento,imagen)
                     VALUES ('$codigo','$nombre','$detalle','$precio','$stock',
                     ".($fecha_vencimiento ? "'$fecha_vencimiento'" : "NULL").",
                     ".($imagen ? "'$imagen'" : "NULL").")";
        $sql = $this->conexion->query($consulta);
        return $sql ? $this->conexion->insert_id : 0;
    }

    public function existeProducto($codigo){
        $sql = $this->conexion->query("SELECT * FROM producto WHERE codigo='$codigo'");
        return $sql->num_rows;
    }

    public function getProducts(){
        $sql = $this->conexion->query("SELECT * FROM producto");
        $data=[];
        while($row=$sql->fetch_assoc()) $data[]=$row;
        return $data;
    }

    public function getProduct($id){
        $sql = $this->conexion->query("SELECT * FROM producto WHERE id=$id LIMIT 1");
        return $sql->fetch_assoc();
    }

    public function actualizar($id,$codigo,$nombre,$detalle,$precio,$stock,$fecha_vencimiento,$imagen){
        $producto = $this->getProduct($id);
        $imagen = $imagen ?: ($producto['imagen'] ?? null);
        $consulta = "UPDATE producto SET 
                        codigo='$codigo',
                        nombre='$nombre',
                        detalle='$detalle',
                        precio='$precio',
                        stock='$stock',
                        fecha_vencimiento=".($fecha_vencimiento?"'$fecha_vencimiento'":"NULL").",
                        imagen=".($imagen?"'$imagen'":"NULL")."
                     WHERE id=$id";
        $sql = $this->conexion->query($consulta);
        return $sql ? true : false;
    }

    public function eliminar($id){
        $sql = $this->conexion->query("DELETE FROM producto WHERE id=$id");
        return $sql ? true : false;
    }
}