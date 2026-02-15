<?php
session_start();
require 'db.php';
if (!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
$email = $_SESSION['email'];
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    die("Invalid request");
}
$full_name = trim($_POST['fullname'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$pincode = trim($_POST['pincode'] ?? '');
$payment_method = trim($_POST['payment_method'] ?? '');
if (
    empty($_POST['fullname']) ||
    empty($_POST['phone']) ||
    empty($_POST['address']) ||
    empty($_POST['pincode']) ||
    empty($_POST['payment_method'])
){
    die("All fields are required");
}
$cartSql = "SELECT c.product_id, c.quantity, p.name AS product_name, p.price FROM cart c JOIN products p ON c.product_id = p.id WHERE c.email = ?";
$cartStmt = $conn->prepare($cartSql);
if (!$cartStmt) {
    die("Cart prepare failed: " . $conn->error);
}
$cartStmt->bind_param("s", $email);
$cartStmt->execute();
$cartResult = $cartStmt->get_result();

if($cartResult->num_rows === 0){
    die("Cart is empty");
}
$total_amount = 0;
$cartItems = [];
while($row = $cartResult->fetch_assoc()){
    $total_amount += $row['price']*$row['quantity'];
    $cartItems[] = $row;
}
$orderSql = "INSERT INTO orders (email, full_name, phone, address, pincode, payment_method, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?)";
$orderStmt = $conn->prepare($orderSql);
if (!$orderStmt) {
    die("Order Prepare failed: " . $conn->error);
}
$orderStmt->bind_param("ssssssi", $email, $full_name, $phone, $address, $pincode, $payment_method, $total_amount);
$orderStmt->execute();
$order_id = $conn->insert_id;

$itemSql = "INSERT INTO order_items (order_id, product_id, product_name, price, quantity) VALUES (?, ?, ?, ?, ?)";
$itemStmt = $conn->prepare($itemSql);
foreach($cartItems as $item){
    $itemStmt->bind_param("iisdi", $order_id, $item['product_id'], $item['product_name'], $item['price'], $item['quantity']);
    $itemStmt->execute();
}
$clearSql = "DELETE FROM cart WHERE email=?";
$clearStmt = $conn->prepare($clearSql);
$clearStmt->bind_param("s", $email);
$clearStmt->execute();

header("Location: payment.php?success=1&order_id=".$order_id);
exit();
?>