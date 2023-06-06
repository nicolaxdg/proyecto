<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['correoUsuario']) && !empty($_POST['contraUsuario'])) {
    $sql = "INSERT INTO registro (correoUsuario, nombreUsuario, contraUsuario) VALUES (:correoUsuario, :nombreUsuario, :contraUsuario)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':correoUsuario', $_POST['correoUsuario']);
    $stmt->bindParam(':nombreUsuario', $_POST['nombreUsuario']);

  }
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registro</h1>
    <span>o <a href="login.php">Ingresar</a></span>

    <form action="signup.php" method="POST">
      <input name="correoUsuario" type="text" placeholder="Ingrese su correo">
      <input name="nombreUsuario" type="text" placeholder="Ingrese su nombre">
      <input name="contraUsuario" type="password" placeholder="Ingrese su contraseña">
      <input type="submit" value="Registrar">
    </form>

  </body>
</html>