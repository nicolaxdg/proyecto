<?php

  session_start();

  if (isset($_SESSION['idUsuario'])) {
    header('Location: /php-login');
  }
  require 'database.php';

  if (!empty($_POST['correoUsuario']) && !empty($_POST['contraUsuario'])) {
    $records = $conn->prepare('SELECT idUsuario, correoUsuario, contraUsuario FROM registro WHERE correoUsuario = :correoUsuario');
    $records->bindParam(':correoUsuario', $_POST['correoUsuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';


   


  }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">SignUp</a></span>

    <form action="login.php" method="POST">
      <input name="correoUsuario" type="text" placeholder="Enter your email" >
      <input name="contraUsuario" type="password" placeholder="Enter your Password" >
      <input type="submit" value="Submit" >
    </form>
  </body>
</html>