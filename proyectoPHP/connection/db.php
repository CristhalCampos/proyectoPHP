<?php
  //Conexión a la base de datos
  function getConnection() {
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "ecommerce_db";
    $connection = new mysqli($host, $user, $password, $database);
    if($connection->connect_error){
      die("Error: " . $connection->connect_error);
    }
    return $connection;
  }
?>