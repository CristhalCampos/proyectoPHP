<?php
  session_start();
  if (isset($_SESSION['email'])) {
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
      <title>Inicio</title>
      <link rel="stylesheet" href="../resources/css/home.css">
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
      <?php
        if (isset($_SESSION['email'])) {
          echo "<p>Bienvenido " . $email . "</p>";
        } 
      ?>
      <h1>Productos</h1>
      <?php
        require_once '../controllers/productController.php';
        $products = allProducts();
        if ($products) {
          foreach ($products as $product) {
            echo "<div>
                    <img src='{$product['image']}'>
                    <h3>{$product['name']}</h3>
                    <p>{$product['price']} $</p>
                    <a href='productDetails.php?id={$product['product_id']}'>
                      <button>Ver detalles</button>
                    </a>
                  </div>";
          }
        } else {
          echo "<div><p>No hay productos disponibles</p></div>";
        }
      ?>
    </main>
  </body>
</html>