<?php

require_once("../model/CategoriesModel.php");        // Incluye el modelo de categorías para usar sus funciones
$objCategoria = new CategoriesModel();               // Crea un nuevo objeto de la clase CategoriesModel para poder usar sus métodos

$tipo = $_GET['tipo'];                               // Obtiene el valor del parámetro "tipo" desde la URL

if ($tipo == "registrar") {                          // Si el tipo es "registrar", se ejecuta el bloque de código para registrar una nueva categoría.
    $nombre = $_POST['nombre'];                      // Recoge los valores que el usuario escribió en el formulario:
    $detalle = $_POST['detalle'];                    // Recoge los valores que el usuario escribió en el formulario:

    if ($nombre == "" || $detalle == "") {           // Verifica si los campos están vacíos
        $arrResponse = array('status' => false, 'msg' => 'Error: Campos vacíos');   // Devuelve mensaje de error
    } else {
        $existe = $objCategoria->existeCategoria($nombre);  // Verifica si ya existe una categoría con ese nombre
        if ($existe > 0) {                            // Si ya existe, muestra mensaje de error
            $arrResponse = array('status' => false, 'msg' => 'Error: Categoría ya existe');
        } else {
            $respuesta = $objCategoria->registrar($nombre, $detalle);  // Si no existe, llama al método registrar() para guardar la nueva categoría en la base de datos.
            if ($respuesta) {                        //  Verifica Si el registro fue exitoso...
                $arrResponse = array('status' => true, 'msg' => 'Categoría registrada correctamente');
            } else {                                  // Si falló el registro...
                $arrResponse = array('status' => false, 'msg' => 'Error al registrar la categoría');
            }
        }
    }

    echo json_encode($arrResponse);                  // Convierte la respuesta a JSON y la envía al navegador
}
