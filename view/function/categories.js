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

if (document.querySelector('#frm_category')) {
    let frm_category = document.querySelector('#frm_category');
    frm_category.onsubmit = function (e) {
        e.preventDefault();
        validar_form_categoria();
    }
}

async function registrarCategoria() {
    try {
        const datos = new FormData(frm_category);
        let respuesta = await fetch(base_url + 'control/CategoriesControler.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        let json = await respuesta.json();

        if (json.status) {
            Swal.fire("Registrado", json.msg, "success");
            document.getElementById('frm_category').reset();
        } else {
            Swal.fire("Error", json.msg, "error");
        }

    } catch (error) {
        console.log("Error al registrar categoría: " + error);
    }
}