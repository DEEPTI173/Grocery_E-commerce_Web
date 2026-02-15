<?php
session_start();
include 'db.php';
if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit();
}
$email = $_SESSION['email'];

$full_name = "";
$phone = "";
$address = "";
$pincode = "";
$showSuccess = false;
$orderId = null;

$stmt = $conn->prepare("SELECT full_name, phone, address, pincode FROM orders WHERE email = ? ORDER BY order_id DESC LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $full_name = $row['full_name'];
    $phone = $row['phone'];
    $address = $row['address'];
    $pincode = $row['pincode'];
}
$stmt->close();

if(isset($_POST['pay_now'])){
    $full_name = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];

    $stmt = $conn->prepare("INSERT INTO orders (email, full_name, phone, address, pincode) VALUES (?, ?, ?, ?, ?) ");
    $stmt->bind_param("sssss", $email, $full_name, $phone, $address, $pincode);
    $stmt->execute();
    $stmt->close();

    $orderId = rand(100000, 999999);
    $showSuccess = true;
}    
$total_amount = 0;

$sql = "SELECT c.quantity, p.price FROM cart c JOIN products p ON c.product_id = p.id WHERE c.email = ?";
$stmt = $conn->prepare($sql);
if(!$stmt){
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()){
    $total_amount += $row['quantity'] * $row['price'];
}
if(isset($_GET['success'])){
    $showSuccess = "true";
    $orderId = $_GET['order_id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment | Big Basket Mart</title>
    <style>
        html , body {
            height: 100%;
            margin:0;
        }
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url(asset/login_background.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        h2 , h3{
            text-align: center;
            color: #2e7d32;
        }
        .section{
            margin-top:20px;
        }
        input , textarea{
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        label{
            margin: 10px 0;
            cursor: pointer;
            font-size: 16px;
        }
        input{
            width: 100%;
            padding: 10px;
            justify-content: space-between;
        }
        .order-summary{
            background: #f8f8f8;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 18px;
        }
        button{
            width: 100%;
            padding: 12px;
            background: #28a745;
            color:white;
            border:none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        button:hover{
            background:#1b5e20;
        }
        /*
        #successScreen{
            display: none;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.4);
            display: flex;
            justify-content: center;
            z-index: 999;
            background: url(asset/background5.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .success-box{
            background: #e6ffe6;
            border: 1px solid #2ecc71;
            padding: 20px;
            margin: 40px auto;
            width: 80%;
            text-align: center;
            color:#2c662d;
            border-radius: 6px;
        }
            */
        #payscreen{
            height :60%;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: none;
        }
        .payment-box{
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            width: 90%;
            max-width: 500px;
            background: white;
            margin: 30px auto;
            padding: 25px;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
        }
        #payment-footer {
            margin-top: 25px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        
    </style>
</head>
<body>
    <?php if (!$showSuccess){ ?>
        <div class="container" id="payscreen">
            <div class="payment-box">
                <h2>Checkout</h2>
            <div class="section">
            <h3>Delivery Address</h3>
            <form action="place_order.php" method="post" id="paymentForm">
                <input type="text" name="fullname" id="fullname" value="<?= htmlspecialchars($full_name) ?>" placeholder="Full Name" required>
                <input type="text" name="phone" value="<?= htmlspecialchars($phone) ?>"placeholder="Phone Number" required>
                <textarea name="address" id="address" rows="2" placeholder="Full Address" required><?= htmlspecialchars($address) ?></textarea>
                <input type="text" name="pincode" value="<?= htmlspecialchars($pincode) ?>" placeholder="Pincode" required>
                
                <div class="section">
                    <h3>Payment Method</h3>
                    <label>
                        <input type="radio" name="payment_method" value="COD" checked>Cash on Delivery
                    </label><br>
                    <label>
                        <input type="radio" name="payment_method" value="UPI">UPI / Card / Net Banking
                    </label><br><br>
                </div>
                <div class="order-summary">
                    <h3>Order Summary</h3>
                    <p><strong>Total Amount:</strong>₹<?php echo $total_amount;?></p>
                </div>
                <button type="submit" name="pay_now" id="payBtn">Pay Now</button>
            </form>
            <div id ="payment-footer">
                &copy;  2026 Big Basket Mart | contact: support@bigbasket.com
            </div>
        </div>
    <?php } ?>
    
    <?php if ($showSuccess && $orderId !== null) {?>
        <div style="background:#fff; justify-content:center; align-items:center; border: 1px solid #2ecc71; padding:20px; margin:40px auto; width:40%; color:2c662d; border-radius:6px;">
            <h2> Order Successful</h2>
            <p><strong>Order ID:</strong><?php echo htmlspecialchars($orderId); ?></p>
            <p> Your groceries will be delivered soon. </p>
            <button onclick="window.location.href='index.php'">Go to Home</button>
        </div>
     <?php } ?>
    <script>
        const form = document.getElementById("paymentForm");
        const payBtn = document.getElementById("payBtn");

        function checkInputs(){
            const full_name = document.getElementById("fullname").value.trim();
            const phone = document.getElementById("phone").value.trim();
            const address = document.getElementById("address").value.trim();
            const pincode = documnet.getElementById("pincode").value.trim();

            let paymentChecked = document.querySelector('input[name="payment_method"]:checked');

            if(full_name === "" || phone === "" || address === "" || pincode === "" || !paymentCheckeds){
                alert("Please fill all delivery details");
                e.preventDefault();
                return;
            }
            if (phone.length !== 10 || isNaN(phone)){
                alert("Enter valid 10-digit mobile number");
                e.preventDefault();
                return;
            }
            if (pincode.length !== 6 || isNaN(pincode)){
                alert("Enter valid pincode");
                e.preventDefault();
                return;
            }
            if (full_name && phone && address && pincode){
                payBtn.disabled = false;
            } else {
                payBtn.disabled = true;
            }
        }
        form.addEventListener("input", checkInputs);
        /*
        function payNow(){
            document.getElementById('payscreen').style.display ="none";
            document.getElementById('successScreen').style.display = "block";

        }
        */
        function goHome(){
            alert("Redirect to Home Page");
            window.location.href = "index.php";
        }
        
    </script>
    
</body>
</html>