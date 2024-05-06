<?php
$db_name = "mysql:host=localhost;dbname=testing";
$user_name = "root";
$password = "";

try {
    $conn = new PDO($db_name, $user_name, $password);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
