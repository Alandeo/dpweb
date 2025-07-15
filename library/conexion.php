<?php
/*Importa el archivo donde están definidas las constantes necesarias para conectarse a la base de datos:*/ 
require_once "../config/config.php";
/* Declara una clase llamada Conexion. Dentro de ella se definirá una función para conectarse a la base de datos.*/
class Conexion
{
    public static function  connect() 
    {   /* Crea una nueva conexión a la base de datos MySQL, usando los datos definidos en el archivo de configuración (config.php).*/
        $mysql = new mysqli(BD_HOST,BD_USER,BD_PASSWORD,BD_NAME);
        $mysql->set_charset(BD_CHARSET); /*Establece el tipo de codificación (charset) para la conexión. En este caso, probablemente utf8. */
        date_default_timezone_set("America/Lima"); /*Define la zona horaria predeterminada para evitar errores con fechas. */
        /*Verifica si ocurrió un error al intentar conectarse. */
        if (mysqli_connect_errno()) { 
            echo "Error de Conexion". mysqli_connect_errno();
        }
        return $mysql;
    }
}

  