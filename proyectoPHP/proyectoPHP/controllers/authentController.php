<?php
  require_once '../models/userModel.php';
  //Controlador para autenticación

  //Registrar un usuario
  function register($firstName, $lastName, $email, $password) {
    try {
      //Validar datos
      $regex1 = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,}$/";
      $regex2 = "/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9.]+$/";
      $regex3 = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}$/";
      if (!preg_match($regex1, $firstName)) {
        return "El nombre debe tener al menos 2 letras";
      } 
      if (!preg_match($regex1, $lastName)) {
        return "El apellido debe tener al menos 2 letras";
      } 
      if (!preg_match($regex2, $email)) {
        return "El formato del correo no es válido";
      } 
      if (!preg_match($regex3, $password)) {
        return "La contraseña debe tener al menos 8 caracteres";
      } 
      return registerUser($firstName, $lastName, $email, $password);
    } catch (Exception $e) {
      return 'Caught exception: ' .  $e->getMessage();
    }
  }

  //Iniciar sesión
  function login($email, $password) {
    $user = getUser($email);
    if ($user) {
      // Verificar la contraseña
      if (password_verify($password, $user['password'])) {
          return $user;
      } else {
          return null;
      }
    } else {
        return null; 
    }
  }

  //Email para restablecer contraseña
  function resetPass($email) {
    try {
      $regex = "/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9.]+$/";
      if (!preg_match($regex, $email)) {
        return "El formato del correo no es válido";
      } 
      if (emailVerif($email)) {
        //Enviar email
        $to = $email;
        $subject = "Restablecer contraseña";
        $message = "Ve al enlace para crear una nueva contraseña http://localhost/proyectoPHP/views/newPass.php?email={$to}";
        $headers = 'From: camposcristhal@gmail.com' . "\r\n";
        if (mail($to, $subject, $message, $headers)) {
          return "Te hemos enviado un enlace de restablecimiento a " . $to;
        } else {
          return "No se pudo enviar el enlace de restablecimiento";
        }
      } else {
        return "El correo no está registrado";
      }
    } catch (Exception $e) {
      return 'Caught exception: ' .  $e->getMessage();
    }
  }

  //Actualizar contraseña
  function newPass($password, $email) {
    try {
      $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}$/";
      if (!preg_match($regex, $password)) {
        return "La contraseña debe tener al menos 8 caracteres";
      } 
      return addPass($password, $email);
    } catch (Exception $e) {
      return 'Caught exception: ' .  $e->getMessage();
    }
  }
?>