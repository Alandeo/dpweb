<div class="container">
    <div style="display: flex; justify-content: space-between; padding: 0.5rem 1rem; background-color: #ff7d49ff; align-items: center; border-radius: 0.5rem; border: 0.4rem solid black;">
    <h4 style="font-size: 2.5rem; font-weight: bold;">Lista de Productos</h4>
    <a href="<?= BASE_URL ?>new-product" class="btn btn-success">Nuevo +</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoria</th>
                <th>F.V.</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="content_products">

        </tbody>
    </table>
</div>
<script src="<?= BASE_URL ?>view/function/product.js"></script>
