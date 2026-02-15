<?php
session_start();
include "db.php";
$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeform = $_SESSION['active_form'] ?? 'login';

function showError($error){
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}
function isActiveForm($formName , $activeForm){
    return $formName === $activeForm ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="form-box active" id="login_form">
        <form action="login_register.php" method="post">
            <h2>Login</h2>

            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">login</button>
            <!-- <p>Don't have an account? <a href="#">Register</a></p> -->
             <p> Don't have an account? <button type="button" class="link-btn" onclick="showRegister()">Register</button></p>
        </form>
        </div>

        <div class="form-box" id="register_form">
        <form action="login_register.php" method="post">
            <h2>Register</h2>
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="">--Select Role--</option>
                <option value="user">User</option>
                <!--
                <option value="admin">Admin</option> -->
            </select>
            <button type="submit" name="register">Register</button>
            <!-- <p>Already have an account? <a href="#">Login</a></p> -->
            <p> Already have an account? <button type="button" class="link-btn" onclick="showLogin()">Login</button></p>

        </form>
        </div>
    </div>   

    <script src="login.js"></script>
</body>
</html>