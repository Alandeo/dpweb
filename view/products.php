<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center p-3 mb-3 rounded shadow" style="background: linear-gradient(90deg, #0d6efd, #6610f2);">
        <h1 class="text-white fw-bold m-0" style="font-family: 'Verdana'; font-size: 1.8rem;">Lista de Productos</h1>
        <a href="<?php echo BASE_URL; ?>new-products" class="btn btn-outline-light fw-bold">
            <i class="bi bi-plus-circle"></i> Nuevo Producto
        </a>
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