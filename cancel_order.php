<?php
session_start();
require 'db.php';
if(!isset($_SESSION['email'])){
    header("Location :login.php");
    exit();
}
$order_id = $_GET['order_id'];
$email = $_SESSION['email'];

$sql = "UPDATE orders SET order_status='Cancelled' WHERE order_id =? AND email=? ";
$stmt = $conn->prepare($sql);
if (!$stmt){
    die("SQL Error: " . $conn->error);
}
$stmt->bind_param("is", $order_id, $email);
$stmt->execute();

header("Location: user_profile.php");
exit();