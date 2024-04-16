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
    <h1>Witaj w sklepie internetowym Z-KOM!</h1>
    <p>Tutaj znajdziesz szeroki wybór produktów.</p>
</div>
<?php
$cookies = $_COOKIE["cookiesAccepted"] ?? "false";
if ($cookies == "false") {
  require_once("./cookies.php");
}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>