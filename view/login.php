<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #74ebd5, #acb6e5);
      font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
      width: 100%;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-box {
      background: white;
      padding: 40px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      border-radius: 10px;
      width: 300px;
    }

    .login-box h2 {
      margin-bottom: 20px;
      text-align: center;
      color: #333;
    }

    .login-box input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .login-box button {
      width: 100%;
      padding: 10px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    .login-box button:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <h2>Iniciar Sesión</h2>
      <form>
        <input type="text" placeholder="Usuario" required>
        <input type="password" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
      </form>
    </div>
  </div>
</body>
</html>
