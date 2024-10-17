<?php
    //Modelo para usuarios - base de datos
    require_once '../connection/db.php';
    function registerUser($firstName, $lastName, $email, $password) {
        $connection = getConnection();
        //Verificar si el correo está registrado
        $result = emailVerif($email);
        if ($result) {
            return "El correo ya está registrado";
        } else {
            //Encriptar la contraseña
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            //Insertar los datos en la base de datos
            $firstName = $connection->real_escape_string($firstName); //Escapar el nombre para evitar inyecciones SQL
            $lastName = $connection->real_escape_string($lastName); //Escapar el apellido para evitar inyecciones SQL
            $sql2 = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$firstName', '$lastName', '$email', '$hashPassword')";
            if ($connection->query($sql2) === true) {
                return "Usuario registrado correctamente";
            } else {
                return "Error al registrar: " . $connection->error;
            }
        }
    }
    function emailVerif($email) {
        $connection = getConnection();
        //Verificar si el correo está registrado
        $email = $connection->real_escape_string($email); //Escapar el correo para evitar inyecciones SQL
        $sql1 = "SELECT * FROM users WHERE email = '$email'";
        $result = $connection->query($sql1);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); 
        } else {
            return null; 
        }
    }
    function addPass($password, $email) {
        $connection = getConnection();
        $password = $connection->real_escape_string($password); //Escapar la contraseña para evitar inyecciones SQL
        $email = $connection->real_escape_string($email); //Escapar el correo para evitar intecciones SQL
        //Encriptar la contraseña
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = '$hashPassword' WHERE email = $email";
        if ($connection->query($sql) === true) {
            return "Contraseña actualizada correctamente";
        } else {
            return "Error al actualizar contraseña";
        }
    }
    function getUser($email) {
        $connection = getConnection();
        $email = $connection->real_escape_string($email); //Escapar el correo para evitar inyecciones SQL
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            //Retornar usuario
            return $result->fetch_assoc(); 
        } else {
            return null; 
        }
    } 
    function getAllUsers() {
        $connection = getConnection();
        $sql = "SELECT user_id, first_name, last_name, email FROM users WHERE role = 'user'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            $users = [];
            while ($user = $result->fetch_assoc()) {
                $users[] = $user;
            }
            return $users;
        } else {
            return null; 
        }
    }
    // Eliminar usuario por ID
    function deleteUser($id) {
        $connection = getConnection();
        $sql = "DELETE FROM users WHERE user_id = $id";
        return $connection->query($sql);
    }

    // Actualizar usuario por ID
    function updateUser($id, $firstName, $lastName, $email) {
        $connection = getConnection();
        $firstName = $connection->real_escape_string($firstName); //Escapar el nombre para evitar intecciones SQL
        $lastName = $connection->real_escape_string($lastName); //Escapar el apellido para evitar intecciones SQL
        $email = $connection->real_escape_string($email); //Escapar el correo para evitar intecciones SQL
        $sql = "UPDATE users SET first_name = '$firstName', last_name = '$lastName', email = '$email' WHERE user_id = $id";
        if ($connection->query($sql) === true) {
            return "Usuario actualizado correctamente";
        } else {
            return "Error al actualizar usuario";
        }
    }
?>