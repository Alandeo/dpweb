<div class="container">
    <div class="p-2 pt-1 pb-1" style="justify-content: space-between; display: flex; background-color: rgba(87, 123, 255, 1); border:solid 5px #000;">
        <h1 style="font-weight:900; font-family: Arial;">Lista de Productos</h1>
        <button style="font-weight:700" type="button" class="btn btn-success">
            <a class="nav-link" href="<?php echo BASE_URL; ?>new-products">Nuevo Producto</a>
        </button>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Fecha Vencimiento</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="content_products">
            <!-- Productos cargados dinámicamente -->
        </tbody>
    </table>
</div>

<script src="<?php echo BASE_URL; ?>view/function/Products.js"></script>