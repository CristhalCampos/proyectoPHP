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
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../resources/css/register.css">
    <script src="../resources/js/validatLogin.js" defer></script>
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
        <h1>Inicio de sesión</h1>
        <form name="form" method="POST">
          <div>
            <label for="email">Correo:</label>
            <input type="email" name="email" id="email" required>
            <span id="valid1"></span>
          </div>
          <div>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            <span id="valid2"></span>
          </div>
          <div id="div-login"><button type="submit" name="login" id="login" disabled>Iniciar sesión</button><span id="response"></span></div>
        </form>
        <?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'], $_POST['email'], $_POST['password'])) {
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            $user = login($email, $password);
            if ($user) {
              session_start();
              $_SESSION['first_name'] = $user['first_name'];
              $_SESSION['last_name'] = $user['last_name'];
              $_SESSION['email'] = $user['email'];
              $_SESSION['role'] = $user['role']; 
              $_SESSION['id'] = $user['user_id'];  
              //Redirigir
              if ($user['role'] === 'admin') {
                header("Location: adminPanel.php");
                exit();
              } else {
                header("Location: home.php");
              exit();
              }
            } else {
              echo "<span>Datos incorrectos</span>";
            }
          }
        ?>
      </div>
      <div>
        <p>Si olvidaste la contraseña, <a href="resetPassword.php">restablecer aquí</a></p>
      </div>
    </main>
  </body>
</html>