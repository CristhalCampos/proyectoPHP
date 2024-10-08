<?php
  //Modelo para productos - base de datos
  require_once '../connection/db.php';
  function getAllProducts() {
    $connection = getConnection();
    $sql = "SELECT * FROM products";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
      $products = [];
      while ($product = $result->fetch_assoc()) {
          $products[] = $product;
      }
      return $products;
    } else {
      return null; 
    }
  }
  function getProduct($id) {
    $connection = getConnection();
    $sql = "SELECT * FROM products WHERE product_id = '$id'";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        //Retornar producto
        return $result->fetch_assoc(); 
    } else {
        return null; 
    }
  }
  // Añadir un producto
  function addProduct($name, $description, $price, $image) {
    $connection = getConnection();
    $name = $connection->real_escape_string($name);
    $description = $connection->real_escape_string($description);
    $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', $price, '$image')";
    if ($connection->query($sql) === true) {
      return "Producto añadido correctamente";
    } else {
      return "Error al añadir producto";
    }
  }
  //Eliminar producto por ID
  function deleteProduct($id) {
    $connection = getConnection();
    $sql = "DELETE FROM products WHERE id = $id";
    return $connection->query($sql);
  }
  //Actualizar producto por ID
  function updateProduct($id, $name, $description, $price, $image) {
    $connection = getConnection();
    $name = $connection->real_escape_string($name);
    $description = $connection->real_escape_string($description);
    $sql = "UPDATE products SET name = '$name', description = '$description', price = $price, image = '$image' WHERE id = $id";
    if ($connection->query($sql) === true) {
      return "Producto actualizado correctamente";
    } else {
      return "Error al actualizar producto";
    }
  }
?>