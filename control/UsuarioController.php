<?php
require_once("../model/UsuarioModel.php");

$objPersona = new UsuarioModel();


//par que el oredenador
$tipo = $_GET['tipo'];

if ($tipo == "registrar") {
    // print_r($_POST);
    $nro_identidad = $_POST['nro_identidad'];
    $razon_social = $_POST['razon_social'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $departamento = $_POST['departamento'];
    $provincia = $_POST['provincia'];
    $distrito = $_POST['distrito'];
    $cod_postal = $_POST['cod_postal'];
    $direccion = $_POST['direccion'];
    $rol = $_POST['rol'];
    // ENCRIPTANDO nro_identidad para utilizarlo como contraseña
    $password = password_hash($nro_identidad, PASSWORD_DEFAULT);

    if (
        $nro_identidad == "" || $razon_social == "" || $telefono == "" || $correo == "" || $departamento == "" || $provincia == "" ||
        $distrito == "" || $cod_postal == "" || $direccion == "" || $rol == ""
    ) {
        $arrResponse = array('status' => false, 'msg' => 'Error, campos vacios');
    } else {
        //validacion si existe persona con el mismo dni
        $existePersona = $objPersona->ExistePersona($nro_identidad);
        if ($existePersona > 0) {
            $arrResponse = array('status' => false, 'msg' => 'Error, nro de documento ya existe');
        } else {
            $respuesta = $objPersona->registrar($nro_identidad, $razon_social, $telefono, $correo, $departamento, $provincia, $distrito, $cod_postal, $direccion, $rol, $password);
            if ($respuesta) {
                $arrResponse = array('status' => true, 'msg' => 'Registro Correctamente');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error, fallo en registro');
            }
        }
    }
    echo json_encode($arrResponse);
}
