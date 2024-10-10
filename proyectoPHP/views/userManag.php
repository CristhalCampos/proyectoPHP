<?php
  session_start();
  //Verificar que el usuario es administrador
  if (isset($_SESSION['email'])) {
    if ($_SESSION['role'] !== 'admin') {
      header("Location: home.php");
      exit();
    }
  }
  require_once '../controllers/userController.php';
  require_once '../controllers/authentController.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../resources/css/panel.css">
    <script src="../resources/js/user.js" defer></script>
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
      <h2>Gestión de Usuarios</h2>
      <h3>Lista de usuarios</h3>
      <?php
        $users = allUsers();
        if ($users) {
          $i = 1;
          foreach ($users as $user) {
            echo "<div>
			              <p>{$user['first_name']} {$user['last_name']} | Email: {$user['email']}</p>
                    <form method='POST' action='adminPanel.php'>
                      <input type='hidden' name='user_id' value='{$user['user_id']}'>
                      <button type='submit' name='delete'>Eliminar</button>
                      <a href='updateUser.php?id={$user['user_id']}'>
                        <button type='button'>Editar</button>
                      </a>
                    </form>
                  </div>";
            $i = $i + 1;
          }
        } else {
          echo "<div><p>No hay usuarios registrados</p></div>";
        }
        //Eliminar usuario
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
          $id = $_POST['user_id'];
          $response = deletUser($id);
          echo $response;
        }
      ?>
      <h3>Añadir un usuario</h3>
      <form name="form" method="POST">
        <input type="text" name="first-name" placeholder="Nombre" required>
        <input type="text" name="last-name" placeholder="Apellido" required>
        <input type="text" name="email" placeholder="Correo" required>
        <input type="text" name="password" placeholder="Contraseña" required>
        <button type="submit" name="add">Añadir</button>
        <span id="response"></span>
      </form>
      <?php
        //Añadir usuario
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'], $_POST['first-name'], $_POST['last-name'], $_POST['email'], $_POST['password'])) {
          $firstName = trim($_POST["first-name"]);
          $lastName = trim($_POST["last-name"]);
          $email = trim($_POST["email"]);
          $password = trim($_POST["password"]);
          $response = register($firstName, $lastName, $email, $password);
          echo $response;
        }
      ?>
    </main>
  </body>
</html>