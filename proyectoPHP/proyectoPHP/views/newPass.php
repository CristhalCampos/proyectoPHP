<?php
  session_start();
  if (isset($_SESSION['email'])) {
    $role = $_SESSION['role'];
  } else {
    $role = 'user';
  }
  if (isset($_GET['email'])) {
    $email = $_GET['email'];
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <script src="../resources/js/validatPass.js" defer></script>
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
      <h1>Restablecer contraseña</h1>
      <h3>Crear una nueva contraseña</h3>
      <form name="form" method="POST">
        <label for="password">Ingresa tu nueva contraseña aquí:</label>
        <input type="password" name="password" required>
        <button type="submit" name="new-password">Actualizar contraseña</button>
    </form>
    <?php
      require_once '../controllers/authentController.php';
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_password'], $_POST['password'])) {
        $password = trim($_POST['password']);
        $reponse = newPass($password, $email);
        echo $response;
      }
    ?>
    </main>
  </body>
</html>