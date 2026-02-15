<?php
session_start();
require 'db.php';
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
if(!isset($_POST['product_id'])){
    die("Invalid request");
}
$email = $_SESSION['email'];
$product_id = (int)($_POST['product_id']);
$quantity = isset($_POST['quantity']) ? (int)($_POST['quantity']) :1;

if($quantity <= 0){
    $quantity = 1;
}
$productSql = "SELECT name, price FROM products WHERE id = ?";
$productStmt = $conn->prepare($productSql);
$productStmt->bind_param("i", $product_id);
$productStmt->execute();
$productResult = $productStmt->get_result();

if($productResult->num_rows === 0){
    die("Product not found");
}
$product = $productResult->fetch_assoc();
$product_name = $product['name'];
$price = $product['price'];

$checkSql = "SELECT id, quantity FROM cart WHERE email=? AND product_id=?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("si", $email, $product_id);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();
if ($checkResult->num_rows > 0){
    $row = $checkResult->fetch_assoc();
    $newQty = $row['quantity'] + $quantity;

    $updateSql = "UPDATE cart SET quantity = ? WHERE id=?";
    $updateSql = $conn->prepare($updateSql);
    $updateSql->bind_param("ii", $newQty, $row['id']);
    $updateSql->execute();
} else {
    $insertSql = "INSERT INTO cart (email, product_id, product_name, quantity) VALUES (?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param("sisi", $email, $product_id, $product_name, $quantity);
    $insertStmt->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Added</title>
    <style>
        html , body{
            height: 100%;
            margin:0;
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url(asset/login_background.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .box{
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .box h2{
            color: green;
        }
        .box a{
            display: inline-block;
            margin-top: 15px;
            padding:10px 20px;
            background: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .box a:hover {
            background: #218838;
        }
        </style>
</head>
<body>
    <div class="box">
        <h2>Item added to cart</h2>
        <p>Your item has been successfully added.</p>
        <a href="cart.php">Proceed to Cart for Payment</a>

        <h2>Want to buy more items</h2>
        <p>Go to Home page if you want to buy more items..</p>
        <a href="index.php">Go to Home</a>
    </div>    
</body>
</html>