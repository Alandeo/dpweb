<?php
require_once("../model/UsuarioModel.php");

$objPersona = new UsuarioModel(); /*“Creo un objeto a partir de la clase UsuarioModel y lo guardo en la variable $objPersona.” */


//par que el oredenador
$tipo = $_GET['tipo'];

if ($tipo == "registrar") {
    // print_r($_POST);
    $nro_identidad = $_POST['nro_identidad'];  /*"Recojo el dato del formulario y lo guardo en una variable en PHP usando $_POST." */
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

if ($tipo == "iniciar_sesion") {
    $nro_identidad = $_POST['usuario'];                    // Captura el número de identidad (usuario) desde el formulario
    $password = $_POST['password'];                        // Captura la contraseña desde el formulario

    if ($nro_identidad == "" || $password == "") {
        $respuesta = array('status' => false, 'msg' => 'Error, campos vacios');
    } else {    
        $existePersona = $objPersona->existePersona($nro_identidad); /* Verifica si el DNI ya está registrado en la base de datos. */
        
        if (!$existePersona) {
            $respuesta = array('status' => false, 'msg' => 'error, usuario no registrado'); /* Si no existe, manda un mensaje de error: "usuario no registrado". */
        } else {
            $persona = $objPersona->buscarPersonaPorNroIdentidad($nro_identidad);  /* Busca todos los datos de la persona según su DNI. */

            if (password_verify($password, $persona->password)) {  /* Verifica la contraseña: */
                session_start();
                $_SESSION['ventas_id'] = $persona->id;  /* Guardamos su ID en una variable de sesión */
                $_SESSION['ventas_usuario'] = $persona->razon_social; /* Guardamos su nombre (razón social) */
                $respuesta = array('status' => true, 'msg' => 'ok'); /* Le decimos que inició sesión correctamente */
            } else {
                $respuesta = array('status' => false, 'msg' => 'error, contraseña incorrecta'); // Si la clave no es igual, mostramos error
            }
        }
    }

    echo json_encode($respuesta);
}
