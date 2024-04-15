<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z-KOM | Sklep internetowy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            transition: box-shadow 0.3s ease;
            cursor: pointer;
        }

        .product-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .product-title {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 16px;
            color: #007bff;
        }
    </style>
</head>
<?php

if(!$_COOKIE["jwt"]) {
  header("Location: http://localhost/XSS_example/victim/login.php");
}

?>
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
          <a class="nav-link" href="">Produkty</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Koszyk</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <h1>Wpisz aby wyszukać produkty!</h1>

    <form class="d-flex ms-auto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <input class="form-control me-2" type="text" name="search" 
        value="<?php 
        if (isset($_GET['search']))  {
          echo $_GET['search'];
        }
        ?>" 
        placeholder="Wyszukaj" aria-label="Search" />

        <input type="submit" value="Szukaj">
      </form>

    <?php
      echo "<div class='row'>";
      if (isset($_GET['search'])) {
        echo "<p>Wyniki dla: " . "<span class='fw-bold'>" . $_GET['search'] . "</span>" . "</p>";

        $s = $_GET['search'];

        $conn = mysqli_connect("localhost", "root", "", "xss_attack_db");
        $q = "SELECT title, description, price, image FROM products WHERE title LIKE '%$s%' OR description LIKE '%$s%'";

        $result = mysqli_query($conn, $q);

        while ($row = mysqli_fetch_row($result)) {
          echo "        
          <div class='col-md-4'>
            <div class='product-card'>
              <h2 class='product-title'>$row[0]</h2>
              <img src='img/$row[3]' alt='$row[0]' class='product-image'>
              <p class='product-price'>$$row[2]</p>
              <p class='product-description'>$row[1]</p>
            </div>
          </div>";
        }

        $conn->close();
        echo "</div>";
      }
      ?>

    <h4 class="mt-4">Lista wszystkich produktów znaduje sie poniżej: </h4>
    <div class="row">
      <?php
      
      $conn = mysqli_connect("localhost", "root", "", "xss_attack_db");
      $q = "SELECT title, description, price, image FROM products";

      $result = mysqli_query($conn, $q);

      while ($row = mysqli_fetch_row($result)) {
        echo "        
        <div class='col-md-4'>
          <div class='product-card'>
            <h2 class='product-title'>$row[0]</h2>
            <img src='img/$row[3]' alt='$row[0]' class='product-image'>
            <p class='product-price'>$$row[2]</p>
            <p class='product-description'>$row[1]</p>
          </div>
        </div>";
      }

      $conn->close();

      ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
