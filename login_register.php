<?php
error_reporting(E_ALL);
ini_set('display_errors' , 1);
session_start();
require_once "db.php";
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $check = $conn->query("SELECT id FROM user WHERE email='$email'");

    if ($check->num_rows > 0 ){
        $_SESSION['register_error'] = "Email already registered!";
        $_SESSION['active_form'] = "register";
    } else{
        $insert = $conn->query("INSERT INTO user (name , email , password , role)VALUES('$name', '$email', '$password', '$role')");
        if(!$insert){
            die("Insert error:". $conn->error);
        }
    }
    header("Location: login.php");
    exit();
}
if (isset($_POST['login'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT name , email , password , role FROM user WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if($result && mysqli_num_rows($result) === 1){
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password , $user['password'])){
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] === 'admin'){
                header("Location: admin.php");
            } else{
                header("Location: index.php");
            }
            exit();
        }
    }
    $_SESSION['login_error'] = "Invalid email or password";
    header("Location: login.php"); 
    exit();
}
?>