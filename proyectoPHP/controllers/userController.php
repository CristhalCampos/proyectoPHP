<?php
  //Controlador para gestión de usuarios
  require_once '../models/userModel.php';

  //Obtener todos los usuarios
  function allUsers() {
    try {
      $users = getAllUsers();
      if ($users) {
        return $users;
      } else {
        return null;
      }
    } catch (Exception $e) {
      return 'Caught exception: ' .  $e->getMessage();
    }
  }

  //Actualizar los datos de un usuario
  function updatUser($id, $firstName, $lastName, $email) {
    try {
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
    } catch (Exception $e) {
      return 'Caught exception: ' .  $e->getMessage();
    }
  }

  //Eliminar usuario
  function deletUser($id) {
    try {
      if (deleteUser($id)) {
          return "Usuario eliminado correctamente";
      } else {
          return "Error al eliminar usuario";
      }
    } catch (Exception $e) {
      return 'Caught exception: ' .  $e->getMessage();
    }
  }
?>