function validar_form() {
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



async function iniciar_sesion() {
    let usuario = document.getElementById("usuario").value;
    let password = document.getElementById("password").value;
    if (usuario == "" || password == "") {
        alert("Error, campos vacios!");
        return;

    }
    try {
        const datos = new FormData(frm_login);
         let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=iniciar_sesion', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        
    } catch (error) {
        console.log(error);
        

    }

}


