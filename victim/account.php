<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z-KOM | Sklep internetowy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    </style>
</head>
<body>
<?php

if(!isset($_COOKIE["jwt"])) {
    header("Location: /XSS_example/victim/login.php");
}

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/XSS_example/victim">Z-KOM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/XSS_example/victim/products.php">Produkty</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/XSS_example/victim/cart.php">Koszyk</a>
        </li>
        <?php
          include "./helpers/jwt.php";
          $jwtHelper = new JWTHelper();
          $payload = $jwtHelper->GetPayload($_COOKIE["jwt"]);

          $user = $payload["data"];

          if ($user["role"] == "admin") {
              echo "
              <li class='nav-item'>
              <a class='nav-link' href='/XSS_example/victim/admin.php'>Admin Panel</a>
            </li>";
          }
        ?>
      </ul>
    </div>
    <?php
    
    if (!isset($_COOKIE["jwt"])) {
      echo "
      <div class='ml-auto'>
        <a class='btn btn-outline-light' href='/XSS_example/victim/login.php'>Zaloguj</a>
      </div>
      ";
    }
    else {
      echo "
      <div class='ml-auto'>
        <a class='btn btn-outline-light' href='/XSS_example/victim/account.php'>Konto</a>
      </div>
      ";
    }

    ?>

  </div>
</nav>

<div class="container mt-4">
    <?php
        $jwtHelper = new JWTHelper();
        $payload = $jwtHelper->GetPayload($_COOKIE["jwt"]);

        $user = $payload["data"];

        $username = $user["username"];

        echo "Username: ".$user["username"];
        echo "<br>Role: ".$user["role"];
    ?>

    <div class="mt-4">
      <form action="changePassword.php" method="POST">
        
          <div class="mb-3">
            <label for="password">Zmień hasło</label>
            <input type="password" name="password" id="password" placeholder="haslo...">

            <input type="text" name="username" id="" value=<?php echo "'$username'" ?> hidden />
          </div>
          <div class="mb-3">
            <input class="btn btn-primary" value="Zmien haslo" type="submit" />
          </div>

      </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php

    if ($_POST) {
      unset($_COOKIE['jwt']); 
      setcookie('jwt', '', -1, '/'); 
    }

?>
</html>