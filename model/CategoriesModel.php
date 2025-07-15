<?php
/*Importa el archivo que contiene la clase Conexion, para poder conectarse a la base de datos. */
require_once("../library/conexion.php");

class CategoriesModel/*Esta clase contiene funciones (métodos) para trabajar con categorías. */
{
    private $conexion; /*Se declara una propiedad privada para guardar la conexión a la base de datos. */
/*Conecta a la base de datos */
    function __construct()
    {   /*Crea un nuevo objeto Conexion (que viene del archivo que cargamos al inicio). */
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->connect();
    }
/*Guarda una nueva categoría */
  /*Sirve para guardar una nueva categoría en la base de datos.
Recibe dos datos desde el formulario: */
    public function registrar($nombre, $detalle)
    {
        $consulta = "INSERT INTO categoria (nombre, detalle) VALUES ('$nombre', '$detalle')";
        $sql = $this->conexion->query($consulta); /*Ejecuta la consulta SQL en la base de datos usando la conexión guardada. */
        if ($sql) {
            return $this->conexion->insert_id;/*Si  es verdadero Devuelve el ID del nuevo registro insertado (gracias a insert_id). */
        } else {
            return 0; /*Devuelve 0, lo que indica que no se pudo insertar. */
        }
    }
/*Verifica si una categoría ya existe */
    public function existeCategoria($nombre)
    {
        $consulta = "SELECT * FROM categoria WHERE nombre = '$nombre'";
        $sql = $this->conexion->query($consulta);   /*Ejecuta la consulta SQL y guarda el resultado en $sql.*/
        return $sql->num_rows;  /*Devuelve la cantidad de filas que encontró la consulta: */
    }
}