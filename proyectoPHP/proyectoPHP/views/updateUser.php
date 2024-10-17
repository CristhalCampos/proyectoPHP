<?php
  session_start();
  if (isset($_SESSION['email'])) {
    $role = $_SESSION['role'];
  } else {
    $role = 'user';
  }
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }
  require_once '../controllers/userController.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../resources/css/panel.css">
    <script src="../resources/js/validUser.js" defer></script>
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
      <h3>Editar datos del usuario</h3>
      <form name="form" method="POST">
        <input type="text" name="first-name" placeholder="Nombre" required>
        <input type="text" name="last-name" placeholder="Apellido" required>
        <input type="text" name="email" placeholder="Correo" required>
        <button type="submit" name="update">Actualizar</button>
      </form>
      <span id="response"></span>
      <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'], $_POST['first-name'], $_POST['last-name'], $_POST['email'])) {
          $firstName = trim($_POST['first-name']);
          $lastName = trim($_POST['last-name']);
          $email = trim($_POST['email']);
          $response = updatUser($id, $firstName, $lastName, $email);
          echo $response;
        }
      ?>
    </main>
  </body>
</html>