<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z-KOM | Sklep internetowy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        a {
          text-decoration: none;
          color: black;
        }

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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
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
  </div>
</nav>

<div class="container mt-4">
    <?php
        $conn = mysqli_connect("localhost", "root", "", "xss_attack_db");

        $id = $_GET["id"] ?? -1;

        $added_to_basket_message = '';
        if ($_POST) {
            include "./helpers/jwt.php";
            $jwtHelper = new JWTHelper();
        
            $payload = $jwtHelper->GetPayload($_COOKIE["jwt"]);
        
            $user = $payload["data"];
            $userId = $user["id"];
            $productId = $_POST["id"];
        
            $id = $productId;
        
            $dodaj = "INSERT INTO shopping_cart VALUES ('$userId','$productId')";
            if (mysqli_query($conn, $dodaj)) {
                $added_to_basket_message = '<div class="alert alert-success" role="alert">Produkt został dodany do koszyka!</div>';
            } else {
                $added_to_basket_message = '<div class="alert alert-danger" role="alert">Błąd podczas dodawania produktu do koszyka.</div>';
            }
        }

        $q = "SELECT title, description, price, image FROM products WHERE id = '$id'";

        $result = mysqli_query($conn, $q);

        while ($row = mysqli_fetch_row($result)) {
            echo "
            <div class='col'>
                $added_to_basket_message
                <div class='product-card'>
                <h2 class='product-title'>$row[0]</h2>
                <img src='img/$row[3]' alt='$row[0]' class='product-image'>
                <p class='product-price'>$$row[2]</p>
                <p class='product-description'>$row[1]</p>
                </div>
                <form method='POST' action='product.php'>
                <input type='text' name='id' hidden value='$id'>
                <input type='submit' class='btn btn-primary' value='Dodaj do koszyka' />
                </form>
            </div>
            ";
        }

        $conn->close();
      ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
