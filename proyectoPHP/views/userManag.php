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
                    <form name='form-users' method='POST'>
                      <span>{$i}</span>
                      <input type='hidden' name='id' value='{$user['user_id']}'>
                      <input type='text' name='first-name' value='{$user['first_name']}' placeholder='Nombre' readonly>
                      <input type='text' name='last-name' value='{$user['last_name']}' placeholder='Apellido' readonly>
                      <input type='text' name='email' value='{$user['email']}' placeholder='Correo' readonly>
                      <button type='submit' name='delete-user'>Eliminar usuario</button>
                      <button type='submit' name='edit'>Editar datos</button>
                      <button type='submit' name='save' disabled>Guardar</button>
                    </form>
                  </div>";
            $i = $i + 1;
          }
        } else {
          echo "<div><p>No hay usuarios registrados</p></div>";
        }
        //Eliminar usuario
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete-user'])) {
          $id = $_POST['id'];
          $response = deletUser($id);
          if ($response == "Usuario eliminado correctamente") {
            echo $response;
            header("Location: userManag.php"); //Actualizar la lista
            exit();
          } else {
            echo $response;
          }
        }
        //Modificar usuario
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'], $_POST['first-name'], $_POST['last-name'], $_POST['email'])) {
          $id = $_POST['id'];
          $firstName = trim($_POST['first-name']);
          $lastName = trim($_POST['last-name']);
          $email = trim($_POST['email']);
          $response = updatUser($id, $firstName, $lastName, $email);
          if ($response == "Usuario actualizado correctamente") {
            echo $response;
            header("Location: userManag.php"); //Actualizar la lista
            exit();
          } else {
            echo $response;
          }
        }
      ?>
      <h3>Añadir un usuario</h3>
      <form name="form" method="POST">
        <input type="text" name="first-name" placeholder="Nombre" required>
        <input type="text" name="last-name" placeholder="Apellido" required>
        <input type="text" name="email" placeholder="Correo" required>
        <input type="text" name="password" placeholder="Contraseña" required>
        <button type="submit" name="add-user">Añadir</button>
        <span id="response"></span>
      </form>
      <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-user'], $_POST['first-name'], $_POST['last-name'], $_POST['email'], $_POST['password'])) {
          $firstName = trim($_POST["first-name"]);
          $lastName = trim($_POST["last-name"]);
          $email = trim($_POST["email"]);
          $password = trim($_POST["password"]);
          $response = register($firstName, $lastName, $email, $password);
          if ($response == "Usuario registrado correctamente") {
            echo $response;
            header("Location: userManag.php"); //Actualizar la lista
            exit();
          } else {
            echo $response;
          }
        }
      ?>
    </main>
  </body>
</html>