<div class="container mt-4">
  <h3>Registrar Producto</h3>
  <form action="guardar_producto.php" method="POST" enctype="multipart/form-data">
    
    <!-- Código -->
    <div class="mb-3">
      <label for="codigo" class="form-label">Código</label>
      <input type="text" class="form-control" id="codigo" name="codigo" required>
    </div>

    <!-- Nombre -->
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>

    <!-- Detalle -->
    <div class="mb-3">
      <label for="detalle" class="form-label">Detalle</label>
      <textarea class="form-control" id="detalle" name="detalle" rows="3"></textarea>
    </div>

    <!-- Precio -->
    <div class="mb-3">
      <label for="precio" class="form-label">Precio</label>
      <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
    </div>

    <!-- Stock -->
    <div class="mb-3">
      <label for="stock" class="form-label">Stock</label>
      <input type="number" class="form-control" id="stock" name="stock" required>
    </div>

    <!-- Categoría (FK) -->
    <div class="mb-3">
      <label for="id_categoria" class="form-label">Categoría</label>
      <select class="form-select" id="id_categoria" name="id_categoria" required>
        <option value="">Seleccione una categoría</option>
        <!-- Aquí se cargan dinámicamente las categorías desde la BD -->
      </select>
    </div>

    <!-- Fecha de vencimiento -->
    <div class="mb-3">
      <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
      <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento">
    </div>

    <!-- Imagen -->
    <div class="mb-3">
      <label for="imagen" class="form-label">Imagen</label>
      <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
    </div>

    <!-- Proveedor (FK) -->
    <div class="mb-3">
      <label for="id_proveedor" class="form-label">Proveedor</label>
      <select class="form-select" id="id_proveedor" name="id_proveedor" required>
        <option value="">
