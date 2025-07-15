<?php

require_once("../model/CategoriesModel.php");        // Incluye el modelo de categorías para usar sus funciones
$objCategoria = new CategoriesModel();               // Crea un objeto de la clase CategoriesModel

$tipo = $_GET['tipo'];                               // Obtiene el valor del parámetro "tipo" desde la URL

if ($tipo == "registrar") {                          // Si el valor de tipo es "registrar", ejecuta este bloque
    $nombre = $_POST['nombre'];                      // Recibe el campo "nombre" del formulario
    $detalle = $_POST['detalle'];                    // Recibe el campo "detalle" del formulario

    if ($nombre == "" || $detalle == "") {           // Verifica si los campos están vacíos
        $arrResponse = array('status' => false, 'msg' => 'Error: Campos vacíos');   // Devuelve mensaje de error
    } else {
        $existe = $objCategoria->existeCategoria($nombre);  // Verifica si ya existe una categoría con ese nombre
        if ($existe > 0) {                            // Si ya existe, muestra mensaje de error
            $arrResponse = array('status' => false, 'msg' => 'Error: Categoría ya existe');
        } else {
            $respuesta = $objCategoria->registrar($nombre, $detalle);  // Si no existe, registra la categoría
            if ($respuesta) {                        // Si el registro fue exitoso...
                $arrResponse = array('status' => true, 'msg' => 'Categoría registrada correctamente');
            } else {                                  // Si falló el registro...
                $arrResponse = array('status' => false, 'msg' => 'Error al registrar la categoría');
            }
        }
    }

    echo json_encode($arrResponse);                  // Convierte la respuesta a JSON y la envía al navegador
}
