<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z-KOM Logowanie - Sklep internetowy</title>
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
    <div class="ml-auto">
        <a class="btn btn-outline-light" href="/XSS_example/victim/login.php">Zaloguj</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Logowanie</div>

                    <div class="card-body">
                    <form action="login.php" method="POST">

                            <div class="mb-3">
                                <label for="username" class="form-label">Nazwa użytkownika</label>
                                <input type="text" name="username" id="username" class="form-control" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Hasło</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Zaloguj sie">

                            <?php

                                function is_valid_user($username, $password) {
                                    $conn = mysqli_connect("localhost", "root", "", "xss_attack_db");
                                    $q = "SELECT username, password FROM users WHERE username = '$username'";

                                    $result = mysqli_query($conn, $q);

                                    while ($row = mysqli_fetch_row($result)) {
                                        return $username === $row[0]  && $password === $row[1];
                                    }

                                    $conn->close();
                                    return false;
                                }

                                function get_user_data($username) {
                                    $conn = mysqli_connect("localhost", "root", "", "xss_attack_db");
                                    $q = "SELECT username, role, id FROM users WHERE username = '$username'";

                                    $result = mysqli_query($conn, $q);

                                    while ($row = mysqli_fetch_row($result)) {
                                        if ($row[0] == $username) {
                                            return $row;
                                        }
                                    }
                                    
                                    $conn->close();
                                }

                                if ($_POST) {

                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
                                    
                                    if (is_valid_user($username, $password)) {
                                        $issued_at = time();
                                        $expiration_time = $issued_at + 3600 * 10;
                                    
                                        $header = [
                                            'alg' => 'HS256',
                                            'typ' => 'JWT'
                                        ];
                                    
                                        $user = get_user_data($username);

                                        $payload = [
                                            'iat' => $issued_at,
                                            'exp' => $expiration_time,
                                            'data' => [
                                                'id' => $user[2],
                                                'username' => $username,
                                                'role' => $user[1],
                                            ]
                                        ];
                                    
                                        include("./helpers/jwt.php");
                                        $jwtHelper = new JWTHelper($secret_key);

                                        $jwt = $jwtHelper->generate($payload);
                                    
                                        setcookie("jwt", $jwt, time() + 3600 * 10);
                                    
                                        header("Location: /XSS_example/victim");
                                    } else {
                                        http_response_code(404);
                                        echo "<div class='text-danger mt-2'> Zły login lub hasło </div>";
                                    }

                                }

                                ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>