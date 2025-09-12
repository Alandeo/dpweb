<div class="container">
    <div class="p-2 pt-1 pb-1" style="justify-content: space-between; display: flex; background-color: #90ee90; border:solid 5px #000;">
        <h1 style="font-weight:900; font-family: Arial;">Lista de Categorías</h1>
        <button style="font-weight:700" type="button" class="btn btn-success">
            <a class="nav-link" href="<?php echo BASE_URL; ?>new-categories">Nueva Categoría</a>
        </button>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nro</th>
                <th>Nombre</th>
                <th>Detalle</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="content_categories">
            <!-- Aquí se cargan las categorías dinámicamente -->
        </tbody>
    </table>
</div>

<!-- Script para manejar las categorías -->
<script src="<?php echo BASE_URL; ?>view/function/categories.js"></script>