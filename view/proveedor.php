<div class="container">
    <div class="arriba">
        <h3 class="mt-3" style="color: white;">LISTA DE PROVEEDORES</h3>
        <h3 class="new-proveedor">
            <a class="nav-link" href="<?php echo BASE_URL; ?>new-proveedor">new proveedor</a>
        </h3>
        <h3 class="users">
            <a class="nav-link" href="<?php echo BASE_URL; ?>users">Usuarios</a>
        </h3>
        
    </div>
    <style>
        .arriba {
            gap: 5rem;
            display: flex;
            background-color: orange;
        }

        .new-proveedor {
            margin-top: 15px;
        }

        .nav-link {
            color: white;
        }

        .users {
            margin-top: 15px;
        }
       
    </style>

    <div class="responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th class="bg-white">Nro</th>
                    <th class="bg-white">DNI</th>
                    <th class="bg-white">Nombres y apellidos</th>
                    <th class="bg-white">Correo</th>
                    <th class="bg-white">Rol</th>
                    <th class="bg-white">Estado</th>
                    <th class="bg-white">Acciones</th>
                </tr>
            </thead>
            <tbody id="content_proveedor">

            </tbody>
        </table>
    </div>

</div>
<script src="<?php echo BASE_URL; ?>view/function/user.js"></script>
<!--
<script>view_users();</script>-->