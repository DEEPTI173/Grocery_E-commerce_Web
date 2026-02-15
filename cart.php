<?php
session_start();
include "db.php";
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
$email = $_SESSION['email'] ?? null;
$total = 0;
$cartItems = [];

$sql = "SELECT c.product_id, c.product_name, c.quantity, p.price FROM cart c JOIN products p ON c.product_id = p.id WHERE c.email =?";
$stmt = $conn->prepare($sql);
if(!$stmt){
    die("SQL prepare failed:" . $conn->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()){
    $itemTotal = $row['price'] * $row['quantity'];
    $total += $itemTotal;

    $cartItems[] = [
        'product_id' => $row['product_id'],
        'product_name' => $row['product_name'],
        'price' => $row['price'],
        'quantity' => $row['quantity'],
        'item_total' => $itemTotal
    ];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Big Basket Mart</title>
    <style>
        html, body{
            height: 95%;
        }
        body{
            font-family: Arial, Helvetica, sans-serif;
            background:url(asset/cart2.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100%;
            margin: 0;
        }
        .cart-box{
            width: 60%;
            margin: 20px;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 12px;
        }
        .item{
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .total{
            font-size: 20px;
            font-weight: bold;
            text-align: right;
            margin-top: 15px;
        }
        .pay-btn{
            display: block;
            width:100%;
            padding: 12px;
            background: green;
            color: white;
            border: none;
            font-size: 18px;
            margin-top: 20px;
            cursor:pointer;
        }
    </style>
</head>
<body>
        <div class="cart-box">
        <h2>My Cart</h2>
        <?php if(count($cartItems) > 0): ?>
        <?php foreach($cartItems as $item): ?>
            <div class="item" style="display: flex; justify-content:space-between; align-items:center;">
                <div>
                    <strong><?= $item['product_name'] ?></strong><br>
                    Price: ₹<?= $item['price'] ?><br>
                    Quantity: <?= $item['quantity'] ?><br>
                    Item Total: ₹<?= $item['item_total'] ?>

                </div>
                <div>
                    ₹<?= $item['item_total'] ?>
                    <form action="remove_from_cart.php" method="post" style="display: inline;">
                        <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                        <button type="submit" style="color:red; border:none; background:none; cursor:pointer;">Remove Item</button>
                    </form>
                </div>

            </div>
        <?php endforeach; ?>
        <h3>Total:₹<?= $total ?></h3>
        <?php if($total > 0): ?>
            <form action="payment.php" method="post">
                <input type="hidden" name="total" value="<?= $total ?>">
                <button class="pay-btn">Proceed to Payment</button>
            </form>
        <?php endif; ?>
        <?php else: ?>
            <p>Your cart is empty</p>
        <?php endif; ?>
        </div>      
</body>
</html>