<div class="container-fluid mt-4 row">
    <div class="col-8">
        <div class="card">
            <div class="card-body ">
                <h5 class="card-title text-center">Busqueda de Productos</h5>
                <div class="search-box d-flex mb-3">
                    <input type="text" class="form-control col-md-12" placeholder="buscar producto por codigo o nombre" id="busqueda_venta" onkeyup="viewProductosVendedor();">
                    <input type="hidden" id="id_producto_venta">
                    <input type="hidden" id="producto_precio_venta">
                    <input type="hidden" id="producto_cantidad_venta" value="1">
                </div>
                <div class="overflow-auto" style="height: 75vmin;">
                    <div class="row container-fluid" id="productos-container">
                        <!-- Productos se cargan aquí dinámicamente -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Lista de Compra</h5>
                <div class="row" style="min-height: 500px;">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="lista_compra">
                                <!-- Productos agregados se cargarán aquí dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <h4>Subtotal : <label id="subtotal_general"></label></h4>
                        <h4>Igv : <label id="igv_general"></label></h4>
                        <h4>Total : <label id="total"></label></h4>
                        <button class="btn btn-success">Realizar Venta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= BASE_URL ?>view/function/products.js"></script>
<script src="<?= BASE_URL ?>view/function/venta.js"></script>
<script>
    let input = document.getElementById("busqueda_venta");
        input.addEventListener('keydown', (event)=>{
        if (event.key == 'Enter') {
            agregar_producto_temporal();
        }
    });
    listar_temporales();
</script>