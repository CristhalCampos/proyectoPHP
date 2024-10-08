<?php
  //Controlador para gestión de usuarios
  require_once '../models/userModel.php';

  //Obtener todos los usuarios
  function allUsers() {
    $users = getAllUsers();
    if ($users) {
      return $users;
    } else {
      return null;
    }
  }

  //Actualizar los datos de un usuario
  function updatUser($id, $firstName, $lastName, $email) {
    //Validar datos
    $regex1 = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,}$/";
    $regex2 = "/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9.]+$/";
    if (!preg_match($regex1, $firstName)) {
      return "El nombre debe tener al menos 2 letras";
    } 
    if (!preg_match($regex1, $lastName)) {
      return "El apellido debe tener al menos 2 letras";
    } 
    if (!preg_match($regex2, $email)) {
      return "El formato del correo no es válido";
    }
    return updateUser($id, $firstName, $lastName, $email);
  }

  //Eliminar usuario
  function deletUser($id) {
    if (deleteUser($id)) {
        return "Usuario eliminado correctamente";
    } else {
        return "Error al eliminar usuario";
    }
  }
?>