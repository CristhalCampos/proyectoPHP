<?php
  session_start();
  //Verificar que el usuario es administrador
  if (isset($_SESSION['email'])) {
    if ($_SESSION['role'] !== 'admin') {
      header("Location: home.php");
      exit();
    }
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
    <script src="../resources/js/product.js" defer></script>
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
      <h2>Gestión de Productos</h2>
      <h3>Lista de productos</h3>
      <?php
        $products = allProducts();
        if ($products) {
          foreach ($products as $product) {
            echo "<div>
			              <p>{$product['name']} | Precio: $ {$product['price']}</p> 
                    <p>Descripción: {$product['description']}</p> 
                    <p>URL de la imagen: {$product['image']}</p>
                    <form method='POST'>
                      <input type='hidden' name='id' value='{$product['product_id']}'>
                      <button type='submit' name='delete'>Eliminar</button>
                      <a href='updateProd.php?id={$product['product_id']}'>
                        <button type='button'>Editar</button>
                      </a>
                  	</form>
                  </div>";
          }
        } else {
          echo "<div><p>No hay productos disponibles</p></div>";
        }
        //Eliminar producto
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
          $id = $_POST['id'];
          $response = deleteProd($id);
          echo $response;
          header("Location: productManag.php"); //Redireccionar para actualizar la lista
          exit();
        }
      ?>
      <h3>Añadir un producto</h3>
      <form name="form" method="POST">
        <input type="text" name="name" placeholder="Nombre del producto" required>
        <textarea name="description" cols='50' rows='5' placeholder="Descripcion del producto" required></textarea>
        <input type="number" name="price" placeholder="Precio" required>
        <input type="text" name="image" placeholder="URL de la imagen" required>
        <button type="submit" name="add">Añadir</button>
      </form>
      <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['image'])) {
          $name = trim($_POST['name']);
          $description = trim($_POST['description']);
          $price = trim($_POST['price']);
          $image = trim($_POST['image']);
          $response = addProd($name, $description, $price, $image);
          echo $response;
          header("Location: productManag.php"); //Redireccionar para actualizar la lista
          exit();
        }
      ?>
    </main>
  </body>
</html>