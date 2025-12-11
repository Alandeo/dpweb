function validar_form(tipo) {
    let codigo = document.getElementById("codigo").value;
    let nombre = document.getElementById("nombre").value;
    let detalle = document.getElementById("detalle").value;
    let precio = document.getElementById("precio").value;
    let stock = document.getElementById("stock").value;
    let id_categoria = document.getElementById("id_categoria").value;
    let fecha_vencimiento = document.getElementById("fecha_vencimiento").value;
    //let imagen = document.getElementById("imagen").value;
    let id_proveedor = document.getElementById("id_proveedor").value;
    if (codigo == "" || nombre == "" || detalle == "" || precio == "" || stock == "" || id_categoria == "" || fecha_vencimiento == "" || id_proveedor == "") {
        Swal.fire({
            title: "Error campos vacios!",
            icon: "Error",
            draggable: true
        });
        return;
    }
    if (tipo == "nuevo") {
        registrarProducto();
    }
    if (tipo == "actualizar") {
        actualizarProducto();
    }
}

if (document.querySelector('#frm_product')) {
    let frm_product = document.querySelector('#frm_product');
    frm_product.onsubmit = function (e) {
        e.preventDefault();
        validar_form("nuevo");
    }
}

// Registrar Producto
async function registrarProducto() {
    try {
        const datos = new FormData(frm_product);
        let respuesta = await fetch(base_url + 'control/ProductoController.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        let json = await respuesta.json();
        if (json.status) {
            alert(json.msg);
            document.getElementById('frm_product').reset();
        } else {
            alert(json.msg);
        }
    } catch (e) {
        console.log("Error al registrar Producto:" + e);
    }
}

// Cargar Categorias
async function cargar_categorias() {
    let respuesta = await fetch(base_url + 'control/CategoriaController.php?tipo=ver_categorias', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache'
    });
    let json = await respuesta.json();
    let contenido = '<option value="">Seleccione Categoria</option>';
    json.data.forEach(categoria => {
        contenido += '<option value="' + categoria.id + '">' + categoria.nombre + '</option>';
    });
    document.getElementById("id_categoria").innerHTML = contenido;
}

// Cargar Proveedores
async function cargar_proveedores() {
    let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=ver_proveedores', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache'
    });
    let json = await respuesta.json();
    let contenido = '<option value="">Seleccione Proveedor</option>';
    json.data.forEach(proveedor => {
        contenido += '<option value="' + proveedor.id + '">' + proveedor.razon_social + '</option>';
    });
    document.getElementById("id_proveedor").innerHTML = contenido;
}

// Ver Productos
async function view_products() {
    try {
        let respuesta = await fetch(base_url + 'control/ProductoController.php?tipo=ver_productos', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });
        json = await respuesta.json();
        contenidot = document.getElementById('content_products');
        if (json.status) {
            let cont = 1;
            json.data.forEach(producto => {
                let nueva_fila = document.createElement("tr");
                nueva_fila.id = "fila" + producto.id;
                nueva_fila.className = "filas_tabla";
                nueva_fila.innerHTML = `<td>${cont}</td>
                                        <td>${producto.codigo}</td>
                                        <td>${producto.nombre}</td>
                                        <td>${producto.detalle}</td>
                                        <td>${producto.precio}</td>
                                        <td>${producto.stock}</td>
                                        <td>${producto.categoria}</td>
                                        <td>${producto.fecha_vencimiento}</td>
                                        <td><svg id="barcode${producto.id}"></svg></td>
                                        <td>${producto.proveedor}</td>
                                        <td>
                                          <a class="btn btn-primary" href="`+ base_url + `edit-product/` + producto.id + `">Editar</a>
                                          <button class="btn btn-danger" onclick="fn_eliminar(` + producto.id + `);">Eliminar</button>
                                        </td>`;
                cont++;
                contenidot.appendChild(nueva_fila);
                JsBarcode("#barcode" + producto.id, "" + producto.codigo, {
                  format: "code128",
                  lineColor: "rgba(0, 0, 0, 1)",
                  width: 1,
                  height: 30,
                  displayValue: false
                });
            });
        }
    } catch (error) {
        console.log('error en mostrar producto ' + e);
    }
}
if (document.getElementById('content_products')) {
    view_products();
}

// Editar Producto
async function edit_producto() {
    try {
        let id_producto = document.getElementById('id_producto').value;
        const datos = new FormData();
        datos.append('id_producto', id_producto);
        let respuesta = await fetch(base_url + 'control/ProductoController.php?tipo=ver', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (!json.status) {
            alert(json.msg);
            return;
        }
        document.getElementById('codigo').value = json.data.codigo;
        document.getElementById('nombre').value = json.data.nombre;
        document.getElementById('detalle').value = json.data.detalle;
        document.getElementById('precio').value = json.data.precio;
        document.getElementById('stock').value = json.data.stock;
        document.getElementById('id_categoria').value = json.data.id_categoria;
        document.getElementById('fecha_vencimiento').value = json.data.fecha_vencimiento;
        document.getElementById('id_proveedor').value = json.data.id_proveedor;
    } catch (error) {
        console.log('oops, ocurrió un error ' + error);
    }
}
if (document.querySelector('#frm_edit_producto')) {
    let frm_user = document.querySelector('#frm_edit_producto');
    frm_user.onsubmit = function (e) {
        e.preventDefault();
        validar_form("actualizar");
    }
}

// Actualizar Producto
async function actualizarProducto() {
    const datos = new FormData(frm_edit_producto);
    let respuesta = await fetch(base_url + 'control/ProductoController.php?tipo=actualizar', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    });
    json = await respuesta.json();
    if (!json.status) {
        alert("Oooooops, ocurrio un error al actualizar, intentelo nuevamente");
        console.log(json.msg);
        return;
    } else {
        alert(json.msg);
    }
}

// Eliminar Producto
async function fn_eliminar(id) {
    if (window.confirm("Confirmar eliminar?")) {
        eliminar(id);
    }
}
async function eliminar(id) {
    let datos = new FormData();
    datos.append('id_producto', id);
    let respuesta = await fetch(base_url + 'control/ProductoController.php?tipo=eliminar', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    });
    json = await respuesta.json();
    if (!json.status) {
        alert("Oooooops, ocurrio un error al eliminar producto, intentelo mas tarde");
        console.log(json.msg);
        return;
    } else {
        alert(json.msg);
        location.replace(base_url + 'products');
    }
}

// Ver Productos vista Cliente
async function viewProductosClients() {
  try {
    let respuesta = await fetch(base_url + 'control/ProductoController.php?tipo=ver_productos', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache'
    });

    let json = await respuesta.json();
    let container = document.getElementById('productos-container');
    container.innerHTML = ''; // Limpia antes de insertar
    if (json.status) {
      json.data.forEach(prod => {
        let card = document.createElement("div");
        card.classList.add("col-12", "col-md-6", "col-lg-3", "mb-4");
        card.innerHTML=`<div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <img src="${base_url}${prod.imagen}" class="card-img-top img-fluid" alt="${prod.nombre}" style="height:200px; object-fit:cover;">
                            <div class="card-body d-flex flex-column">
                              <h5 class="card-title fw-bold">${prod.nombre}</h5>
                              <p class="card-text text-truncate" style="height:40px;">${prod.detalle}</p>
                              <p class="text-primary fw-bold fs-5">S/ ${prod.precio}</p>
                              <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-outline-primary btn-sm px-3 custom-btn"><i class="bi bi-eye me-1"></i>Detalle</a>
                                <a href="#" class="btn btn-primary btn-sm px-3 custom-btn"><i class="bi bi-cart-plus me-1"></i>Agregar</a>
                              </div>
                            </div>
                        </div>`;
        container.appendChild(card);
      });
    }
  } catch (error) {
    console.log('Error al cargar productos: ' + error);
  }
}

if (document.getElementById('productos-container')) {
    viewProductosClients();
}

// Ver Productos vista Vendedor
async function viewProductosVendedor() {
  try {
    let dato = document.getElementById('busqueda_venta').value;
    const datos = new FormData();
    datos.append('dato', dato);
    let respuesta = await fetch(base_url + 'control/ProductoController.php?tipo=buscar_producto_venta', {
      method: 'POST',
      mode: 'cors',
      cache: 'no-cache',
      body: datos
    });

    let json = await respuesta.json();
    let container = document.getElementById('productos-container');
    container.innerHTML = ''; // Limpia antes de insertar
    if (json.status) {
        json.data.forEach(prod => {
        let card = document.createElement("div");
        card.classList.add("col-12", "col-md-6", "col-lg-3", "mb-4");
        card.innerHTML=`<div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                            <img src="${base_url}${prod.imagen}" class="card-img-top img-fluid" alt="${prod.nombre}" style="height:200px; object-fit:cover;">
                            <div class="card-body d-flex flex-column">
                              <h5 class="card-title fw-bold">${prod.nombre}</h5>
                              <p class="card-text text-truncate" style="height:40px;">${prod.detalle}</p>
                              <p class="text-primary fw-bold fs-5">S/ ${prod.precio}</p>
                              <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-outline-primary btn-sm px-3 custom-btn"><i class="bi bi-eye me-1"></i>Detalle</a>
                                <a href="#" class="btn btn-primary btn-sm px-3 custom-btn"><i class="bi bi-cart-plus me-1"></i>Agregar</a>
                              </div>
                            </div>
                        </div>`;
        container.appendChild(card);
        let id = document.getElementById('id_producto_venta');
        let precio = document.getElementById('producto_precio_venta');
        let cantidad = document.getElementById('producto_cantidad_venta');
        id.value = prod.id;
        precio.value = prod.precio;
        cantidad.value = 1;
      });
    }
    
  } catch (error) {
    console.log('Error al cargar productos: ' + error);
  }
}

if (document.getElementById('productos-container')) {
    viewProductosClients();
}