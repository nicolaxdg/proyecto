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

    if (count($results) > 0 && password_verify($_POST['contraUsuario'], $results['contraUsuario'])) {
        $_SESSION['idUsuario'] = $results['idUsuario'];
        header("Location: /php-login");
      } else {
        $message = 'Sorry, those credentials do not match';
      }
   


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
      <input name="correoUsuario" type="text" placeholder="Enter your email" required>
      <input name="contraUsuario" type="password" placeholder="Enter your Password" required>
            <p class="message"><a href="#">Cambiar clave</a></p>
      <input type="submit" value="Submit" >
    </form>
  </body>
</html>
