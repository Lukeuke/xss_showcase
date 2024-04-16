<?php

if (!$_POST) return;

$password = $_POST["password"];
$username = $_POST["username"];

$q = "UPDATE users SET password = '$password' WHERE username = '$username';";

$conn = mysqli_connect("localhost", "root", "", "xss_attack_db");
mysqli_query($conn, $q);

echo "Hasło zostało zmienione.";

?>