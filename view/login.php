<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #0d6efd, #6610f2);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Segoe UI", sans-serif;
    }
    .login-box {
      background: #ffffff;
      border-radius: 20px;
      padding: 2.5rem;
      box-shadow: 0 10px 25px rgba(0,0,0,0.25);
      width: 100%;
      max-width: 420px;
      position: relative;
      overflow: hidden;
    }
    .login-header {
      background: linear-gradient(135deg, #1f79ffff, #91cdffff);
      padding: 1rem;
      color: white;
      border-radius: 15px;
      margin: -2.5rem -2.5rem 2rem -2.5rem;
      text-align: center;
      font-weight: bold;
      font-size: 1.3rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .logo {
      width: 70px;
      margin-bottom: 0.8rem;
    }
    .form-control {
      border-radius: 12px;
      padding: 0.7rem;
    }
    .btn-custom {
      border-radius: 12px;
      font-weight: bold;
      padding: 0.8rem;
      transition: all 0.3s ease;
    }
    .btn-custom:hover {
      background: #520dc2;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(82, 13, 194, 0.4);
    }
    .footer-text {
      margin-top: 1.5rem;
      font-size: 0.85rem;
      color: #6c757d;
    }
  </style>
  <script>
    const base_url = '<?= BASE_URL; ?>';
  </script>
</head>
<body>

<div class="login-box">
  <div class="login-header">
<img src="<?= BASE_URL; ?>view/img/hola.png" alt="Logo" class="logo d-block mx-auto">
    <span>INICIAR SESION</span>
  </div>
  
  <form id="frm_login" class="mt-3">
    <div class="mb-3">
      <label for="username" class="form-label">Usuario</label>
      <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese su usuario" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Contraseña</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
    </div>
    <button type="button" class="btn btn-primary w-100 btn-custom" onclick="iniciar_sesion();">Ingresar</button>
  </form>

  <p class="footer-text text-center">© 2025 Sistema de Ventas | Todos los derechos reservados</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL; ?>view/function/user.js"></script>
</body>
</html>
