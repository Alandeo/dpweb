function validar_form(tipo) {
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
        Swal.fire({   /*Se llama a Swal.fire() que es parte de la librería SweetAlert2 (una forma más bonita de mostrar alertas). */
            icon: "error",
            title: "Oops...",
            text: "campos vacíos ",
        });
        return;  /*Al llegar aquí, la función se detiene y no continúa con el registro */
    }
    if (tipo == "nuevo") {
        registrarUsuario();
    }
    if (tipo == "actualizar") {
        actualizarUsuario();
    }


}

if (document.querySelector('#frm_user')) {  /* Si ese formulario existe en la página, entonces ejecuta lo que está dentro del if */
    //evita que se envie el formulario
    let frm_user = document.querySelector('#frm_user'); /* Aquí se guarda el formulario en una variable llamada frm_user, para poder usarlo más abajo. */
    frm_user.onsubmit = function (e) {
        e.preventDefault();  /*Esto detiene el envío automático del formulario. */
        validar_form("nuevo");  /*Llama a la función validar_form() para verificar si todos los campos están llenos. */
    }
}

async function registrarUsuario() {
    try {
        // capturar campos de formulario(HTML)
        const datos = new FormData(frm_user);   /* Crea un objeto FormData a partir del formulario HTML (frm_user).  */
        // enviar datos a controlador
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=registrar', {  //fetch() es una función para hacer solicitudes HTTP (como GET o POST) desde JavaScript.
            method: 'POST',
            mode: 'cors',  // Significa que el navegador permitirá que esta solicitud se haga entre diferentes dominios o puertos, si el servidor lo permite.
            cache: 'no-cache',  // Le dice al navegador: no guardes esta solicitud en caché.
            body: datos
        });
        let json = await respuesta.json();  /*Convierte la respuesta que devuelve el archivo PHP a formato JSON. */
        //validadamos que json.status sea = true
        if (json.status) { //true  ... Si json.status es true, significa que el usuario se registró correctamente.
            alert(json.msg);
            document.getElementById('frm_user').reset();    // Luego reinicia el formulario (borra los campos).
        } else {
            alert(json.msg);   // Si json.status es false, muestra el mensaje de error enviado por PHP
        }


    } catch (error) {       //  Si algo falla (por ejemplo, no hay conexión, o fetch no funciona), muestra el error en la consola para depuración.
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

        let json = await respuesta.json();  /*Espera la respuesta en formato JSON. */
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

async function view_users() {
    try {
        // Enviar datos al controlador
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=ver_Usuarios', {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache'
        });
        let json = await respuesta.json();
        if (json && json.length > 0) {
            let html = '';
            json.forEach((user, index) => {
                html += `<tr>
                <td>${index + 1}</td>
                <td>${user.nro_identidad || ''}  </td>
                <td>${user.razon_social || ''}  </td>
                <td>${user.correo || ''}</td>
                <td>${user.rol || ''}</td>
                <td>${user.estado || ''} </td>
                <td>
                <a href="`+ base_url + `edit-user/` + user.id + ` ">Editar</a>
                <button onclick=" delete_user(${user.id})" >eliminar</button> 
                </td>
                </tr>`;
            })
            document.getElementById('content_users').innerHTML = html;
        } else {
            document.getElementById('content_users').innerHTML = '<tr><td colspan="6"> No hay usuarios disponibles</td></tr>';
        }
    } catch (error) {
        console.log(error);
        document.getElementById('content_users').innerHTML = '<tr><td colspan="6">Error al cargar los usuarios</td></tr>';
    }
}

if (document.getElementById('content_users')) {
    view_users();
}

async function edit_user() {
    try {
        let id_persona = document.getElementById('id_persona').value;
        const datos = new FormData();
        datos.append('id_persona', id_persona);

        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=ver', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        let json = await respuesta.json();
        if (!json.status) {
            alert(json.msg);
            return;
        }
        document.getElementById('nro_identidad').value = json.data.nro_identidad;
        document.getElementById('razon_social').value = json.data.razon_social;
        document.getElementById('telefono').value = json.data.telefono;
        document.getElementById('correo').value = json.data.correo;
        document.getElementById('departamento').value = json.data.departamento;
        document.getElementById('provincia').value = json.data.provincia;
        document.getElementById('distrito').value = json.data.distrito;
        document.getElementById('cod_postal').value = json.data.cod_postal;
        document.getElementById('direccion').value = json.data.direccion;
        document.getElementById('rol').value = json.data.rol;

    } catch (error) {
        console.log('oops, ocurrió un error' + error);

    }

}

if (document.querySelector('#frm_edit_user')) {
    //evita que se envie el formulario
    let frm_user = document.querySelector('#frm_edit_user');
    frm_user.onsubmit = function (e) {
        e.preventDefault();
        validar_form("actualizar");
    }
}

//actualizar 
async function actualizarUsuario() {
    const datos = new FormData(frm_edit_user);
    let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=actualizar', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    });
    json = await respuesta.json();
    if (!json.status) {
        alert("Ooooooops,  ocurrio un error al actualizar, intentelo nuevamente");
        console.log(json.msg);
        return;
    }else{
        alert(json.msg);
    }
}

// eliminar usuario
async function delete_user(id) {
    if (!confirm("¿Seguro que deseas eliminar este usuario?")) {
        return;
    }

    const datos = new FormData();
    datos.append("id_persona", id);

    let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=eliminar', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    });

    let json = await respuesta.json();

    if (!json.status) {
        alert("Ooooops, ocurrió un error al eliminar");
        console.log(json.msg);
        return;
    } else {
        alert(json.msg);
        if (typeof view_users === "function") {
            view_users(); // refrescar lista
        }
    }
}







