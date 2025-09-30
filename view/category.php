<div class="container">
    <div style="display: flex; justify-content: space-between; padding: 0.5rem 1rem; background-color: #ffce49ff; align-items: center; border-radius: 0.5rem; border: 0.4rem solid black;">
        <h4 style="font-size: 2.5rem; font-weight: bold;">Lista de Categorias</h4>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCategoria">
            Nuevo +
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
        <tbody id="content_categorias">

        </tbody>
    </table>
</div>

<!-- Modal para Registrar Categoría -->
<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="modalCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #ffce49ff; border-bottom: 2px solid black;">
                <h5 class="modal-title fw-bold" id="modalCategoriaLabel">Registro de Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <form id="frm_category" action="" method="post">
                    <div class="mb-3 row">
                        <label for="nombre" class="col-sm-4 col-form-label">Nombre :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="detalle" class="col-sm-4 col-form-label">Detalle :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="detalle" name="detalle" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-2">Registrar</button>
                        <button type="reset" class="btn btn-info me-2">Limpiar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="<?= BASE_URL ?>view/function/category.js"></script>