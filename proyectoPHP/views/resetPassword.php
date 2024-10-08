<?php
  session_start();
  if (isset($_SESSION['email'])) {
    $role = $_SESSION['role'];
  } else {
    $role = 'user';
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <script src="../resources/js/validatEmail.js" defer></script>
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
      <form name="form" method="POST">
        <label for="email">Ingresa tu correo aquí</label>
        <input type="email" name="email" required>
        <button type="submit" name="reset" disabled>Recibir correo de restablecimiento</button>
      </form>
      <?php
        require_once '../controllers/authentController.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset'], $_POST['email'])) {
          $email = trim($_POST['email']);
          $response = resetPass($email);
          echo $response;
        }
      ?>
    </main>
  </body>
</html>