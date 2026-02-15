<?php
session_start();
include 'db.php';
$isLoggedIn = isset($_SESSION['email']) ? true : false;
// echo isset($_SESSION['email']) ? "LOGGED IN" : "NOT LOGGED IN";
/*
$q = mysqli_query($conn, "SELECT * FROM products WHERE status='active'");
while ($p = mysqli_fetch_assoc($q)){ ?> 
    <div class="product">
        <img scr="asset/<?php echo $p['image']; ?>">
        <p>₹<?php echo $p['price']; ?> / <?php echo $p['unit']; ?></p>
    </div>
<?php } ?>

if (isset($_GET['action']) && $_GET['action'] === 'search'){
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    $sql = "SELECT * FROM products WHERE name LIKE '%$QUERY%' LIMIT 5";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='search-item'><strong>{$row['name']}</strong> - ₹{$row['price']}</div>";
        }
    } else {
        echo "<div class='no-result'>Oops! No Product found</div>";
    }
    exit;
} */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Big Basket Mart</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=login" /> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shopping_cart_checkout" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=login" />
    <link rel="stylesheet" href="style.css">
   
</head>
<body>
    <nav class="navbar">
        <h1><img src="asset/logo.jpg" alt="thumb_nail" class="logo"> Big Basket Mart</h1>
        <div class="nav-right">
            <?php if (isset($_SESSION['email'])) { ?>
            <!-- After Login -->
                <a href="user_profile.php"><span class="material-icons" style="color:white; font-size:32px;">account_circle</span>User Account</a>
                <a href="cart.php"><span class="material-icons" style="color:white; font-size:32px;">shopping_cart</span>Cart</a>
                <a href="logout.php"><span class="material-icons" style="color:white; font-size:32px;">logout</span>Logout</a>
            <?php } else { ?>
            <!-- Before login -->
                <a href="login.php">
                    <span class="material-icons" style="color:white; font-size:32px;">login</span>
                    Login/Register</a>
                <a href="cart.php">
                    <span class="material-icons" style="color:white; font-size:32px;">shopping_cart</span>
                    Cart</a>
            <?php } ?>
        </div>
    </nav>
   <header class="hero-header">
        <div class="hero-text">
            <h1>Fresh & Healthy Groceries</h1>
            <p>Delivered to your Footsteps!!</p>
            <div class="search-box">
                <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
                <span class="material-symbols-outlined">search</span>
                <input type="text" id="searchInput" placeholder="Search vegetables & fruits...">
                <div id="searchResults"></div>
            </div>
        </div>
   </header>
   <div id="productsContainer" class="product"></div>
   <div class="image-slider">
        <img src="asset/header10.jpg" class="active">
        <img src="asset/header2.jpg">
        <img src="asset/header3.jpg">
        <img src="asset/header4.jpg">
        <img src="asset/header5.jpg">
        <img src="asset/header6.jpg">
        <img src="asset/header7.jpg">
        <img src="asset/header8.jpg">
        <img src="asset/header9.jpg">
        <img src="asset/header.jpg">
   </div>
    <section>
        <h2>Vegetables</h2>
        <div class="grid" id="vegList"></div>
    </section>
    <section>
        <h2>Fruits</h2>
        <div class="grid" id="fruitList"></div>
    </section>
    <section>
        <h2>Diary Products</h2>
        <div class="grid" id="diaryList"></div>
    </section>
    <section>
        <h2>Breakfast Essentials</h2>
        <div class="grid" id="breakfastList"></div>
    </section>
    <section>
        <h2>Frozen Foods</h2>
        <div class="grid" id="frozenList"></div>
    </section>
    <section>
        <h2>Snacks</h2>
        <div class="grid" id="snacksList"></div>
    </section>
    <section>
        <h2>Beverages</h2>
        <div class="grid" id="beveragesList"></div>
    </section>
    <section>
        <h2>Sweets</h2>
        <div class="grid" id="sweetList"></div>
    </section>
    <section>
        <h2>Cooking Essentials</h2>
        <div class="grid" id="cookingList"></div>
    </section>

    <footer>
        <p>&copy; 2026 Big Basket Mart</p>
        <p> +91 9876543210 | support@bigbasketmart.com</p>
    </footer>

    <script> const isLoggedIn = <?= $isLoggedIn ? 'true' : 'false' ?>;</script>
    <script src="./main.js"></script>
</body>
</html>