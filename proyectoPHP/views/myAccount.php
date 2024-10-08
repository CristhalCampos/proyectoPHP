<?php
  session_start();
  if (isset($_SESSION['email'])) {
    $firstName = $_SESSION['first_name'];
    $lastName = $_SESSION['last_name'];
    $email = $_SESSION['email'];
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
    <title>Mi Cuenta</title>
    <link rel="stylesheet" href="../resources/css/account.css">
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
      <h1>Mi cuenta</h1>
      <div>
        <h3>Mis datos</h3>
        <?php
          if (isset($_SESSION['email'])) {
            echo "<p>Nombre: <span>" . $firstName . "</span></p>";
            echo "<p>Apellido: <span>" . $lastName . "</span></p>";
            echo "<p>Email: <span>" . $email . "</p>";
            echo "<br><a href='../controllers/logout.php'>Cerrar sesión</a>";
          } else {
            echo "<p><a href='login.php'>Inicia sesión</a> para cargar tus datos</p>";
          }
        ?>
      </div>
    </main>
  </body>
</html>