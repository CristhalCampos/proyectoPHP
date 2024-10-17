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
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
    <link rel="stylesheet" href="../resources/css/details.css">
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
      <h1>Detalles del producto</h1>
      <?php
        require_once '../controllers/productController.php';
        $product =  product($id);
        if ($product) {
          echo "<div>
                  <img src='{$product['image']}'>
                  <h3>Nombre del producto: {$product['name']}</h3>
                  <p>Precio: {$product['price']} $</p>
                  <p>Descripción: {$product['description']}</p>
                </div>";
        } else {
          echo "<div><p>No se encontró el producto</p></div>";
        }
      ?>
    </main>
  </body>
</html>