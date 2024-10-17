<?php
  //Controlador para gestión de productos
  require_once '../models/productModel.php';

  //Obtener todos los productos
  function allProducts() {
    try {
      $products = getAllProducts();
      if ($products) {
        return $products;
      } else {
        return null;
      }
    } catch (Exception $e) {
      return 'Caught exception: ' .  $e->getMessage();
    }
  }

  //Obtener un producto por su id
  function product($id) {
    try {
      $product = getProduct($id);
      if ($product) {
        return $product;
      } else {
        return null;
      }
    } catch (Exception $e) {
      return 'Caught exception: ' .  $e->getMessage();
    }
  }

  //Validación
  function validat($name, $description, $price, $image) {
    if ($name < 2) {
      return "El nombre del producto debe tener al menos 2 caracteres";
    } 
    if ($description < 5) {
      return "La descripción debe tener al menos 5 caracteres";
    } 
    if ($price <= 0) {
      return "El precio debe ser un número válido";
    } 
    if ($image == "") {
      return "Debe ingresar una URL de la imagen";
    }
  }

  //Añadir un producto
  function addProd($name, $description, $price, $image) {
    try {
      //Validación
      validat($name, $description, $price, $image);
      return addProduct($name, $description, $price, $image);
    } catch (Exception $e) {
      return 'Caught exception: ' .  $e->getMessage();
    }
  }

  //Actualizar datos de un producto
  function updateProd($id, $name, $description, $price, $image) {
    try {
      //Validación
      validat($name, $description, $price, $image);
      return updateProduct($id, $name, $description, $price, $image);
    } catch (Exception $e) {
      return 'Caught exception: ' .  $e->getMessage();
    }
  }

  //Eliminar un producto
  function deleteProd($id) {
    try {
      if (deleteProduct($id)) {
        return "Producto eliminado correctamente";
      } else {
        return "Error al eliminar producto";
      }
    } catch (Exception $e) {
      return 'Caught exception: ' .  $e->getMessage();
    }
  }
?>