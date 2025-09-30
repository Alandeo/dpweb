<div class="container">
    <div style="display: flex; justify-content: space-between; padding: 0.5rem 1rem; background-color: #8cff49ff; align-items: center; border-radius: 0.5rem; border: 0.4rem solid black;">
    <h4 style="font-size: 2.5rem; font-weight: bold;">Lista de Usuarios</h4>
    <a href="<?= BASE_URL ?>new-user" class="btn btn-success">Nuevo +</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nro</th>
                <th>DNI</th>
                <th>Nombres y Apellidos</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="content_users">

        </tbody>
    </table>
</div>
<script src="<?= BASE_URL ?>view/function/user.js"></script>
