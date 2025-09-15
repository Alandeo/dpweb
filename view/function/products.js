const frm_product = document.querySelector('#frm_product');
const previewImagen = document.getElementById("preview_imagen");
const inputFile = document.getElementById("imagen_file");
const inputURL = document.getElementById("imagen_url");
const contentProducts = document.getElementById("content_products");

// Previsualización tipo iPhone
function mostrarPrevisualizacion() {
    let src = "";
    if(inputFile && inputFile.files[0]) {
        src = URL.createObjectURL(inputFile.files[0]);
    } else if(inputURL && inputURL.value) {
        src = inputURL.value;
    }
    if(previewImagen) {
        previewImagen.innerHTML = src ? `<img src="${src}" style="width:100%; height:100%; object-fit:cover;">` : `<span style="color:#aaa;">Vista previa</span>`;
    }
}

if(inputFile) inputFile.addEventListener("change", mostrarPrevisualizacion);
if(inputURL) inputURL.addEventListener("input", mostrarPrevisualizacion);

// Validación formulario
function validar_form_producto() {
    const codigo = document.getElementById("codigo").value;
    const nombre = document.getElementById("nombre").value;
    const detalle = document.getElementById("detalle").value;
    const precio = document.getElementById("precio").value;
    const stock = document.getElementById("stock").value;

    if(codigo=="" || nombre=="" || detalle=="" || precio=="" || stock==""){
        Swal.fire({icon:"error", title:"Error", text:"Completa todos los campos"});
        return false;
    }
    return true;
}

// Registrar Producto
async function registrarProducto() {
    if(!validar_form_producto()) return;
    const datos = new FormData(frm_product);
    if(inputFile && inputFile.files[0]){
        datos.set("imagen_file", inputFile.files[0]);
        datos.delete("imagen_url");
    }
    try{
        const resp = await fetch(base_url+'control/ProductsControler.php?tipo=registrar',{method:'POST',body:datos});
        const json = await resp.json();
        Swal.fire({icon: json.status ? "success":"error", title: json.msg});
        if(json.status){
            frm_product.reset();
            mostrarPrevisualizacion();
            cargarProductos();
        }
    }catch(e){console.error(e);}
}

// Cargar productos
async function cargarProductos(){
    try{
        const resp = await fetch(base_url+'control/ProductsControler.php?tipo=listar');
        const data = await resp.json();
        let html = "";
        data.forEach((p,i)=>{
            html+=`<tr>
                <td>${i+1}</td>
                <td>${p.codigo}</td>
                <td>${p.nombre}</td>
                <td>${p.detalle}</td>
                <td>${p.precio}</td>
                <td>${p.stock}</td>
                <td>${p.fecha_vencimiento||""}</td>
                <td>${p.imagen?`<img src="${p.imagen}" width="50">`:""}</td>
                <td>
                    <a class="btn btn-primary" href="${base_url}edit-products/${p.id}">Editar</a>
                    <button class="btn btn-danger" onclick="deleteProduct(${p.id})">Eliminar</button>
                </td>
            </tr>`;
        });
        if(contentProducts) contentProducts.innerHTML=html;
    }catch(e){console.error(e);}
}

document.addEventListener("DOMContentLoaded", cargarProductos);

// Editar producto
async function edit_product(){
    const id = document.getElementById("id_producto").value;
    try{
        const resp = await fetch(base_url+'control/ProductsControler.php?tipo=ver&id='+id);
        const data = await resp.json();
        document.getElementById("codigo").value = data.codigo;
        document.getElementById("nombre").value = data.nombre;
        document.getElementById("detalle").value = data.detalle;
        document.getElementById("precio").value = data.precio;
        document.getElementById("stock").value = data.stock;
        document.getElementById("fecha_vencimiento").value = data.fecha_vencimiento||"";
        document.getElementById("imagen_url").value = data.imagen||"";
        mostrarPrevisualizacion();

        frm_product.onsubmit = async e=>{
            e.preventDefault();
            const formData = new FormData(frm_product);
            formData.append("id", id);
            if(inputFile && inputFile.files[0]){
                formData.set("imagen_file", inputFile.files[0]);
                formData.delete("imagen_url");
            }
            const res = await fetch(base_url+'control/ProductsControler.php?tipo=actualizar',{method:"POST",body:formData});
            const result = await res.json();
            Swal.fire({icon: result.status?"success":"error", title:result.msg, showConfirmButton:false, timer:2000})
            .then(()=>{if(result.status) window.location.href=base_url+"products";});
        }

    }catch(e){console.error(e);}
}

// Eliminar producto
async function deleteProduct(id){
    Swal.fire({
        title:"¿Seguro?",
        text:"No se puede deshacer",
        icon:"warning",
        showCancelButton:true,
        confirmButtonColor:"#d33",
        cancelButtonColor:"#3085d6",
        confirmButtonText:"Sí, eliminar",
        cancelButtonText:"Cancelar"
    }).then(async (r)=>{
        if(r.isConfirmed){
            const datos = new FormData();
            datos.append("id",id);
            try{
                const resp = await fetch(base_url+'control/ProductsControler.php?tipo=eliminar',{method:'POST',body:datos});
                const json = await resp.json();
                Swal.fire({icon: json.status?"success":"error", title:json.msg});
                if(json.status) cargarProductos();
            }catch(e){console.error(e);}
        }
    });
}

// Manejo de submit para registrar
if(frm_product && !document.getElementById("id_producto")){
    frm_product.onsubmit = e=>{
        e.preventDefault();
        registrarProducto();
    }
}