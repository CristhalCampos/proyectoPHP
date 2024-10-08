<?php
  //Controlador para gestión de productos
  require_once '../models/productModel.php';

  //Obtener todos los productos
  function allProducts() {
    $products = getAllProducts();
    if ($products) {
      return $products;
    } else {
      return null;
    }
  }

  //Obtener un producto por su id
  function product($id) {
    $product = getProduct($id);
    if ($product) {
      return $product;
    } else {
      return null;
    }
  }

  //Añadir un producto
  function addProd($name, $description, $price, $image) {
    //Validación
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
    return addProduct($name, $description, $price, $image);
  }

  //Actualizar datos de un producto
  function updateProd($id, $name, $description, $price, $image) {
    //Validación
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
    return updateProduct($id, $name, $description, $price, $image);
  }

  //Eliminar un producto
  function deleteProd($id) {
    if (deleteProduct($id)) {
      return "Producto eliminado correctamente";
    } else {
      return "Error al eliminar producto";
    }
  }
?>