<!-- Productos -->
    <div class="container">
      <div class="row" id="productos-container"></div>
    </div>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NO TE VAYAS😭</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>view/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>view/css/cliente.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script>
        const base_url = '<?php echo BASE_URL; ?>';
    </script>
    <?php
    if (isset($_GET["views"])) {
        $ruta = explode("/", $_GET["views"]);
        //echo $ruta[1];
    }
    ?>
</head>

<script src="<?php echo BASE_URL; ?>view/function/vistacliente.js"></script>
    <script src="<?php echo BASE_URL; ?>view/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo BASE_URL; ?>view/function/vistaC.js"></script>