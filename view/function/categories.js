function validar_form_categoria() {
    let nombre = document.getElementById("nombre").value;
    let detalle = document.getElementById("detalle").value;

    if (nombre == "" || detalle == "") {
        Swal.fire({
            icon: "error",
            title: "Error: Campos vacíos",
            text: "Por favor, completa todos los campos.",
        });
        return;
    }

    registrarCategoria();
}

if (document.querySelector('#frm_category')) { /* Verifica si existe el formulario con ID frm_category en la página. */
    let frm_category = document.querySelector('#frm_category');
    frm_category.onsubmit = function (e) {
        e.preventDefault();
        validar_form_categoria();
    }
}

async function registrarCategoria() {  /*Función asincrónica que envía los datos al servidor .*/
    try {
        const datos = new FormData(frm_category); /* Crea un objeto FormData con todos los datos del formulario (nombre, detalle...). */
        let respuesta = await fetch(base_url + 'control/CategoriesControler.php?tipo=registrar', {
            method: 'POST',  /*Significa que vas a enviar información al servidor */
            mode: 'cors',  /*permite que tu navegador diga: "Sí, está bien, deja que se envíe esta información aunque venga desde otra ruta". */
            cache: 'no-cache',  /*Obliga al navegador a pedir siempre datos nuevos al servidor, no reutilizar respuestas viejas. */
            body: datos  /*Este es el contenido que quieres enviar al servidor. */
        });
        let json = await respuesta.json();
  /* Si la propiedad "status" es true, muestra un mensaje de éxito y limpia el formulario. */
        if (json.status) {
            Swal.fire("Registrado", json.msg, "success");
            document.getElementById('frm_category').reset();
        } else {
            Swal.fire("Error", json.msg, "error"); /* Si hubo error, muestra un mensaje de error usando el texto del servidor. */
        }

    } catch (error) {   /*Si ocurre un problema con la conexión o el servidor, lo muestra en la consola para los desarrolladores. */
        console.log("Error al registrar categoría: " + error);
    }
}



// Obtener todas las categorías
document.addEventListener("DOMContentLoaded", function() {
    cargarCategorias();
});

async function cargarCategorias() {
    try {
        const response = await fetch(base_url + 'control/CategoriesControler.php?tipo=listar');
        const data = await response.json();
        const tbody = document.getElementById("content_categories");
        let html = "";

        data.forEach((category, index) => {
            html += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${category.nombre}</td>
                    <td>${category.detalle}</td>
                    <td>
                        <button class="btn btn-primary" onclick="editCategory(${category.id})">Editar</button>
                        <button class="btn btn-danger" onclick="deleteCategory(${category.id})">Eliminar</button>
                    </td>
                </tr>
            `;
        });

        tbody.innerHTML = html;
    } catch (error) {
        console.error("Error al cargar categorías:", error);
    }
}