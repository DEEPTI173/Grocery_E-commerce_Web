<?php
session_start();
include "db.php";

if (!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
if (isset($_POST['product_id'])){
    $email = $_SESSION['email'];
    $product_id = $_POST['product_id'];

    $stmt = $conn->prepare("DELETE FROM cart WHERE email=? AND product_id=?");
    $stmt->bind_param("si", $email, $product_id);
    $stmt->execute();
}
header("Location:cart.php");
exit();