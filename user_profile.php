<?php
session_start();
include 'db.php';
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
$email = $_SESSION['email'];
$sql = "SELECT full_name, address FROM orders WHERE email=? ORDER BY order_id DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();
if (!$profile){
    echo "No order found yet";
    exit;
}

$orderSql = "SELECT * FROM orders WHERE email=? ORDER BY order_id DESC";
$orderStmt = $conn->prepare($orderSql);
if(!$orderStmt) {
    die("Prepare failed: " . $conn->error);
}
$orderStmt->bind_param("s", $email);
if(!$orderStmt->execute()){
    die("Execute failed: " . $orderStmt->error);
}
$orderStmt->execute();
$orders = $orderStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 20px;
            background: url(asset/user_background.jpg);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 100vh;
            padding: 20px;
        }
        .container{
            max-width: 900px;
            margin:auto;
            background: #fff;
            padding:20px;
        }
        .box{
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom:20px;
        }
        textarea{
            width: 100%;
            padding: 8px;
        }
        button{
            padding:6px 12px;
            background: green;
            color:#fff;
            border:none;
        }
        .logout{
            background: red;
            color: #aaa;
        }
        h3{
           margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <h3>User Details</h3>
            <!--<p><strong>Name:</strong><?= $user['full_name'] ?? 'Not Available'?></p> -->
            <p><strong>Name:</strong><?= htmlspecialchars($profile['full_name'])?></p>
            <p><strong>Email:</strong><?= $email ?></p>
            <p><strong>Address:</strong><?= htmlspecialchars($profile['address'])?></p>
            <!-- <p><strong>Address:</strong><?= $user['address'] ?? 'Not Available' ?></p> -->
            <form action="logout.php" method="post">
                <button class="logout">Logout</button>
            </form>
        </div>
        <div class="box">
            <h3>Order History</h3>
            <?php while ($order = $orders->fetch_assoc()): ?>
                <div style="border-bottom: 1px solid #ccc; padding-bottom:10px; margin-bottom:15px;">
                    <p><strong>Order ID: </strong><?= $order['order_id'] ?></p>
                    <p><strong>Date: </strong><?= $order['order_date'] ?></p>
                    <p><strong>Total Amount: </strong> ₹<?= $order['total_amount'] ?></p>
                    <p><strong>Payment: </strong><?= $order['payment_method'] ?>: Successful</p>

                    <p><strong>Status:</strong><span style="color:<?= ($order['order_status']=='Cancelled')?'red':(($order['order_status']=='Delivered')?'green':'orange') ?>"><?= $order['order_status'] ?></span></p>

                    <ul>
                    <?php $itemSql = "SELECT oi.quantity, p.name FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id=?";
                    $itemStmt = $conn->prepare($itemSql);
                    $itemStmt->bind_param("i", $order['order_id']);
                    $itemStmt->execute();
                    $items = $itemStmt->get_result();
                    
                    while ($item = $items->fetch_assoc()): ?>
                    <li><?= $item['name'] ?> * <?= $item['quantity'] ?></li>
                    <?php endwhile; ?>
                    </ul>
                    <?php if($order['order_status'] != 'Delivered' && $order['order_status'] != 'Cancelled'):?>
                        <a href="cancel_order.php?order_id=<?= $order['order_id'] ?>"
                        onclick="return confirm('Are you sure !! you want to cancel this order?')">
                        <button style="background: red;">Cancel Order</button>
                        </a>
                    <?php endif; ?>
                    <form method="post">
                        <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                        <textarea name="review" placeholder="Write your review..."  required></textarea>
                        <button>Submit Review</button>
                    </form>
                </div>
                <?php endwhile; ?>

                <?php if ($orders->num_rows == 0):?>
                    <p>No Orders found</p>
                <?php endif; ?>
        </div>   
    </div>

    <script>
        function logout(){
            localStorage.removeItem("user");
            window.location.href = "login.php";
        }
    </script>
    
</body>
</html>