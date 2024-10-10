<?php
  session_start();
  //Verificar que el usuario es administrador
  if (isset($_SESSION['email'])) {
    if ($_SESSION['role'] !== 'admin') {
      header("Location: home.php");
      exit();
    }
  }
   if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }
  require_once '../controllers/productController.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../resources/css/panel.css">
    <script src="../resources/js/validProd.js" defer></script>
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
      <h3>Editar datos del producto</h3>
      <form name="form" method="POST">
        <input type="text" name="name" placeholder="Nombre del producto" required>
        <textarea name="description" cols='50' rows='5' placeholder="Descripcion del producto" required></textarea>
        <input type="number" name="price" placeholder="Precio" required>
        <input type="text" name="image" placeholder="URL de la imagen" required>
        <button type="submit" name="update">Actualizar</button>
      </form>
      <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['image'])) {
          $name = trim($_POST['name']);
          $description = trim($_POST['description']);
          $price = trim($_POST['price']);
          $image = trim($_POST['image']);
          $response = updateProd($id, $name, $description, $price, $image);
          echo $response;
          header("Location: productManag.php"); //Redireccionar para actualizar la lista
          exit();
        }
      ?>
    </main>
  </body>
</html>