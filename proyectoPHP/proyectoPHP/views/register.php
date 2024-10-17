<?php
  session_start();
  if (isset($_SESSION['email'])) {
    $role = $_SESSION['role'];
  } else {
    $role = 'user';
  }
  require_once '../controllers/authentController.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../resources/css/register.css">
    <script src="../resources/js/validatRegister.js" defer></script>
  </head>
  <body>
    <nav>
      <a href="home.php"><button>Inicio</button></a>
      <?php if ($role === 'admin'): ?>
        <a href="adminPanel.php"><button class="panel">Panel de Administración</button></a>
      <?php endif; ?>
      <a href="myAccount.php"><button>Mi Cuenta</button></a>
      <a href="register.php"><button>Registrarse</button></a>
    </nav>
    <main>
      <div>
        <h1>Registro de usuario</h1>
        <form name="form" method="POST">
          <div>
            <label for="first-name">Nombre:</label>
            <input type="text" name="first-name" id="first-name" placeholder="Juan" required>
            <span id="valid1">El nombre debe tener al menos 2 letras, no puede tener números</span>
          </div>
          <div>
            <label for="last-name">Apellido:</label>
            <input type="text" name="last-name" id="last-name" placeholder="Rodriguez" required>
            <span id="valid2">El apellido debe tener al menos 2 letras, no puede tener números</span>
          </div>
          <div>
            <label for="email">Correo:</label>
            <input type="email" name="email" id="email" placeholder="juanrodriguez@gmail.com" required>
            <span id="valid3">El correo debe tener un formato valido, no puede faltar el @</span>
          </div>
          <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            <span id="valid4">La contraseña debe tener al menos 8 caracteres, con letras, números y un caracter especial $ ! % * ? &</span>
          </div>
          <div id="div-register">
            <button type="submit" name="register" id="register" disabled>Registrar</button>
            <span id="response"></span>
          </div>
        </form>
        <?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'], $_POST['first-name'], $_POST['last-name'], $_POST['email'], $_POST['password'])) {
            $firstName = trim($_POST["first-name"]);
            $lastName = trim($_POST["last-name"]);
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            $response = register($firstName, $lastName, $email, $password);
            echo "<span>" . $response . "</span>";
          }
        ?>
      </div>
      <div>
        <p>Si ya estás registrado, <a href="login.php">inicia sesión aquí</a></p>
      </div>
    </main>
  </body>
</html>