<?php
session_start();
//Verificar que el usuario es administrador
if (isset($_SESSION['email'])) {
  if ($_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../resources/css/panel.css">
  </head>
  <body>
    <nav>
      <a href="home.php"><button>Inicio</button></a>
      <a href="adminPanel.php"><button>Panel de Administración</button></a>
      <a href="myAccount.php"><button>Mi Cuenta</button></a>
      <a href="register.php"><button>Registrarse</button></a>
    </nav>
    <main>
      <h1>Panel de administración</h1>
      <div>
        <a href="userManag.php"><button>Gestionar usuarios</button></a>  
        <a href="productManag.php"><button>Gestionar productos</button></a>  
      </div>
    </main>
  </body>
</html>