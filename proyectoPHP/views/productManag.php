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
          $i = 1;
          foreach ($products as $product) {
            echo "<div>
                    <form name='form-products' id='form-products' method='POST'>
                      <span>{$i}</span>
                      <input type='hidden' name='product_id' value='{$product['product_id']}'>
                      <input type='text' name='name' value='{$product['name']}' placeholder='Nombre del producto' readonly>
                      <textarea name='description' maxlength='250' cols='50' rows='5' placeholder='Descripcion del producto' readonly>{$product['description']}</textarea>
                      <input type='number' name='price' value='{$product['price']}' placeholder='Precio' readonly>
                      <input type='text' name='image' value='{$product['image']}' placeholder='URL de la imagen' readonly>
                      <button type='submit' name='delete-product'>Eliminar producto</button>
                      <button type='submit' name='edit'>Editar datos</button>
                      <button type='submit' name='save' disabled>Guardar</button>
                    </form>
                  </div>";
            $i = $i + 1;
          }
        } else {
          echo "<div><p>No hay productos disponibles</p></div>";
        }
        //Eliminar producto
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_product'])) {
          $id = $_POST['product_id'];
          $response = deleteProd($id);
          if ($response == "Producto eliminado correctamente") {
            echo $response;
            header("Location: productManag.php"); //Actualizar la lista
            exit();
          } else {
            echo $response;
          }
        }
        //Modificar producto
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['image'])) {
          $id = $_POST['product_id'];
          $name = trim($_POST['name']);
          $description = trim($_POST['description']);
          $price = trim($_POST['price']);
          $image = trim($_POST['image']);
          $response = updateProd($id, $name, $description, $price, $image);
          if ($response == "Producto actualizado correctamente") {
            echo $response;
            header("Location: productManag.php"); //Actualizar la lista
            exit();
          } else {
            echo $response;
          }
        }
      ?>
      <h3>Añadir un producto</h3>
      <form name="form" method="POST">
        <input type="text" name="name" placeholder="Nombre del producto" required>
        <textarea name="description" cols='50' rows='5' placeholder="Descripcion del producto" required></textarea>
        <input type="number" name="price" placeholder="Precio" required>
        <input type="text" name="image" placeholder="URL de la imagen" required>
        <button type="submit" name="add_product">Añadir</button>
      </form>
      <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['image'])) {
          $name = trim($_POST['name']);
          $description = trim($_POST['description']);
          $price = trim($_POST['price']);
          $image = trim($_POST['image']);
          $response = addProd($name, $description, $price, $image);
          if ($response == "Producto añadido correctamente") {
            echo $response;
            header("Location: productManage.php"); //Actualizar la lista
            exit();
          } else {
            echo $response;
          }
        }
      ?>
    </main>
  </body>
</html>