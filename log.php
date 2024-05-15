<?php 
require 'connex.php';
$p = new crud('phblog', 'localhost', 'root', '', 3307); // Separate the host and port
if(isset($_POST['login-button'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $p->loginSession($email,$password);
   header('location:Home.php');
    } else {
        echo 'Please provide both email and password.';
    }
}
?>
