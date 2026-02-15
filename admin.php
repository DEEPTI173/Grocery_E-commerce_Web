<?php
session_start();
include 'db.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
$page = $_GET['page'] ?? 'dashboard';
// Dashboard Counts 
$totalUsers = $conn->query("SELECT COUNT(*) total FROM user WHERE role='user'")->fetch_assoc()['total'];

$totalOrders = $conn->query("SELECT COUNT(*) total FROM orders")->fetch_assoc()['total'];

$totalProducts = $conn->query("SELECT COUNT(*) total FROM products")->fetch_assoc()['total'];

$revenue = $conn->query("SELECT SUM(total_amount) total FROM orders WHERE order_status='Delivered'")->fetch_assoc()['total'] ?? 0;

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "asset/.$image");
    mysqli_query($conn, "INSERT INTO products (name, price, quantity, image) VALUES ('$name', '$price', '$quantity', '$image')");

    echo "<p style='color:green'>Product added successfully</p>";
}   
if (isset($_POST['update'])){
    $id = $_POST['order_id'];
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    
    if(!empty($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "../asset/" . $image);

        $stmt = $conn->prepare("UPDATE products SET name=?, price=?, quantity=?, image=? WHERE id=?");
        $stmt->bind_param("siidi", $name, $price, $quantity, $image, $id);
    } else {
        $stmt = $conn->prepare("UPDATE products SET name=?, price=?, quantity=? WHERE id=?");
        $stmt->bind_param("siii", $name, $price, $quantity, $id);
    }
    $stmt->execute();
    echo "<script>alert('Product updated Successfully');</script>";
}
$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php if ($page == 'dashboard') { ?>
        <h1>Admin Dashboard</h1>
        <div class="dashboard">
            <a href="admin.php?page=users">
                <div class="card">
                    <strong>Total Users</strong><br>
                    <?= $totalUsers ?>
                </div>
            </a>
            <a href="admin.php?page=orders">
                <div class="card">
                    <strong>Total Orders</strong><br>
                    <?= $totalOrders ?>
                </div>
            </a>
            <div class="card">
                <strong>Total Products</strong><br>
                <?= $totalProducts ?>
            </div>
            <div class="card">
                <strong>Revenue</strong><br>
                <?= $revenue ?>
            </div>
        </div>
        <h1>Admin Panel</h1>
    <?php } ?>

    <?php if ($page == 'users') { ?>
    <h2>Users List</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        <?php 
        $result = $conn->query("SELECT id, name, email FROM user"); 
        if ($result && $result->num_rows > 0){
            while ($u = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= $u['name'] ?></td>
                <td><?= $u['email'] ?></td>
            </tr>
        <?php }
        } else {
            echo "<tr><td>colspan='3'>No users found</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="admin.php"><- Back to Dashboard</a>
    <?php } ?>

    <?php if($page == 'orders') { ?>
    <?php 
    if (isset($_POST['update'])) {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];
        $conn->query("UPDATE orders SET order_status='$status' WHERE order_id='$order_id'");
    } ?>
    <h2>Orders List</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Order ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Payment</th>
            <th>Items</th>
            <th>Total</th>
            <th>Status</th>
            <th>Update</th>
        </tr>
        <?php 
        $orders = $conn->query("SELECT * FROM orders");
        if ($orders && $orders->num_rows > 0){
            while ($o = $orders->fetch_assoc()) { ?>
            <tr>
                <td><?= $o['order_id'] ?></td>
                <td><?= $o['full_name'] ?></td>
                <td><?= $o['phone'] ?></td>
                <td><?= $o['address'] ?></td>
                <td><?= $o['payment_method'] ?></td>
                <td>
                    <?php 
                    $order_id =$o['order_id'];
                    $items = $conn->query("SELECT * FROM order_items WHERE order_id = $order_id");
                    while ($item = $items->fetch_assoc()){
                        echo $item['product_name']."(Qty:".$item['quantity'].", ₹".$item['price'] . ")<br>";
                    } ?>
                </td>
                <td><?= $o['total_amount']; ?></td>
    
                <td>
                    <form method="post">
                        <input type="hidden" name="order_id" value="<?= $o['order_id'] ?>">
                        <select name="status">
                            <option <?= $o['order_status']=="Pending"?"selected":""?>>Pending</option>
                            <option <?= $o['order_status']=="Confirmed"?"selected":""?>>Confirmed</option>
                            <option <?= $o['order_status']=="Delivered"?"selected":""?>>Delivered</option>
                            <option <?= $o['order_status']=="Cancelled"?"selected":""?>>Cancelled</option>
                        </select>
                </td>
                <td>
                    <input type="hidden" name="order_id" value="<?= $o['order_id']; ?>">
                    <button type="submit" name="update">Save</button>
                    </form>
                </td>
            </tr>
        <?php }
        } else {
            echo "<tr><td>colspan='8'>No orders found</td></tr>";
        } ?>
    </table>
    <br>
    <a href="admin.php"><- Back to Dashboard</a>
    <?php } ?>

    <!-- ADD PRODUCTS -->
    <div class="form-box">
            <h3>Add Products</h3>
            <form method="post" enctype="multipart/form-data" style="background:#fff; padding:15px; width:300px;">
            <input name="name" placeholder="Product Name" required>
            <input name="price" placeholder="Price" required>
            <input name="quantity" placeholder="Quantity" required>
            <input name="image" placeholder="Image" required><br><br>
            <button name="add">Add Product</button>
    </form>
    </div>
    <hr>
    <!-- UPDATE PRODUCTS -->
    <h3>Manage Products</h3>
    <div class="product">
        <?php while ($p = $products->fetch_assoc()): ?>
        <form method="post" style="border:1px solid #ccc; padding:10px; margin:10px">
            <strong><?= htmlspecialchars($p['name']) ?></strong><br>
            Price: ₹<?= htmlspecialchars($p['price']) ?><br>

            <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <label>Quantity:</label>
            <input type="number" name="quantity" value="<?= htmlspecialchars($p['quantity']) ?>">
            <button name="update">Update Quantity</button>
            <label>Price:</label>
            <input type="number" name="price" value="<?= htmlspecialchars($p['price']) ?>">
            <button name="update">Update Price</button>
        </form>
    <?php endwhile; ?>
    </div>
</body>
</html>


