function validar_form() {
    /*Esta función verifica que todos los campos estén llenos antes de registrar. */
    let nro_ducumento = document.getElementById("nro_identidad").value;
    let razon_social = document.getElementById("razon_social").value;
    let telefono = document.getElementById("telefono").value;
    let correo = document.getElementById("correo").value;
    let departamento = document.getElementById("departamento").value;
    let provincia = document.getElementById("provincia").value;
    let distrito = document.getElementById("distrito").value;
    let cod_postal = document.getElementById("cod_postal").value;
    let direccion = document.getElementById("direccion").value;
    let rol = document.getElementById("rol").value;

    /*Si algún campo está vacío, muestra un mensaje de error con SweetAlert y detiene el registro (return;). */
    if (nro_ducumento == "" || razon_social == "" || telefono == "" || correo == "" || departamento
        == "" || provincia == "" || distrito == "" || cod_postal == "" || direccion == "" || rol == "") {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "campos vacíos ",
        });
        return;
    }



    registrarUsuario();
/*Bloque para evitar que el formulario se envíe solo: */
}
if (document.querySelector('#frm_user')) {
    //evita que se envie el formulario
    let frm_user = document.querySelector('#frm_user');
    frm_user.onsubmit = function (e) {
        e.preventDefault();
        validar_form();
    }
}

async function registrarUsuario() {
    try {
        // capturar campos de formulario(HTML)
        const datos = new FormData(frm_user);
        // enviar datos a controlador
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        let json = await respuesta.json();
        //validadamos que json.status sea = true
        if (json.status) { //true
            alert(json.msg);
            document.getElementById('frm_user').reset();
        } else {
            alert(json.msg);
        }


    } catch (error) {
        console.log("Error al registrar Usuario:" + error);
    }
}


/*Esta función se encarga de verificar que el usuario exista y que la contraseña sea correcta. */
async function iniciar_sesion() {
    let usuario = document.getElementById("usuario").value;
    let password = document.getElementById("password").value;
    if (usuario == "" || password == "") {  /* Si hay campos vacíos, detiene el proceso y muestra error. */
        alert("Error, campos vacios!");
        return;

    }
    try {
        const datos = new FormData(frm_login);  /*Captura el formulario de login. */
        /*Envía los datos al PHP para que verifique si el usuario existe y si la contraseña es correcta. */
         let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=iniciar_sesion', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json =  await respuesta.json();  /*Espera la respuesta en formato JSON. */
        // validamos que json.status sea = true
        if (json.status) { //true
            location.replace(base_url + 'new-user'); // Redirige al usuario a la página de nuevo usuario si el inicio de sesión es exitoso
        } else {
            alert(json.msg);  // Muestra un mensaje de error si el inicio de sesión falla
        }

    } catch (error) {
        console.log(error);
        

    }

}


