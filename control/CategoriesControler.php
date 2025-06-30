<?php

require_once("../model/CategoriesModel.php");
$objCategoria = new CategoriesModel();

$tipo = $_GET['tipo'];

if ($tipo == "registrar") {
    $nombre = $_POST['nombre'];
    $detalle = $_POST['detalle'];

    if ($nombre == "" || $detalle == "") {
        $arrResponse = array('status' => false, 'msg' => 'Error: Campos vacíos');
    } else {
        $existe = $objCategoria->existeCategoria($nombre);
        if ($existe > 0) {
            $arrResponse = array('status' => false, 'msg' => 'Error: Categoría ya existe');
        } else {
            $respuesta = $objCategoria->registrar($nombre, $detalle);
            if ($respuesta) {
                $arrResponse = array('status' => true, 'msg' => 'Categoría registrada correctamente');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al registrar la categoría');
            }
        }
    }

    echo json_encode($arrResponse);
}